<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService
{
    /**
     * Upload an image file safely across local and serverless environments.
     *
     * In local development (writable public/), saves to public/uploads/{subfolder}.
     * In serverless (read-only public/), saves to /tmp/uploads and returns an optimized data URI
     * to guarantee persistence and zero 404s across ephemeral instances.
     */
    public static function uploadImage(UploadedFile $file, string $subfolder = 'products'): string
    {
        $cleanSubfolder = trim($subfolder, '/');
        $publicDir = public_path('uploads/' . $cleanSubfolder);

        // 1. Check if public directory is writable (local development)
        $isWritable = false;
        try {
            if (!file_exists($publicDir)) {
                @mkdir($publicDir, 0755, true);
            }
            $isWritable = is_dir($publicDir) && is_writable($publicDir);
        } catch (\Throwable $e) {
            $isWritable = false;
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $prefix = $cleanSubfolder ? rtrim($cleanSubfolder, 's') : 'file';
        $filename = $prefix . '_' . time() . '_' . uniqid() . '.' . $extension;

        if ($isWritable) {
            $file->move($publicDir, $filename);
            return 'uploads/' . $cleanSubfolder . '/' . $filename;
        }

        // 2. Read-only filesystem (Vercel Serverless)
        // Save to /tmp/uploads so direct URL serving works via route
        $tmpDir = '/tmp/uploads/' . $cleanSubfolder;
        if (!file_exists($tmpDir)) {
            @mkdir($tmpDir, 0755, true);
        }
        $tmpFilePath = $tmpDir . '/' . $filename;
        @copy($file->getRealPath(), $tmpFilePath);

        // Try to generate an optimized Base64 Data URI for self-contained persistence
        $dataUri = self::toOptimizedDataUri($file);
        if ($dataUri) {
            return $dataUri;
        }

        return 'uploads/' . $cleanSubfolder . '/' . $filename;
    }

    /**
     * Convert uploaded image to optimized Data URI (max 800px, 80% quality).
     */
    public static function toOptimizedDataUri(UploadedFile $file): ?string
    {
        $realPath = $file->getRealPath();
        if (!$realPath || !file_exists($realPath)) {
            return null;
        }

        $mime = $file->getMimeType() ?: 'image/jpeg';

        // If GD is available, resize & compress for lightweight storage (~30-80KB)
        if (extension_loaded('gd') && function_exists('imagecreatefromstring')) {
            try {
                $content = file_get_contents($realPath);
                $src = @imagecreatefromstring($content);
                if ($src !== false) {
                    $origWidth = imagesx($src);
                    $origHeight = imagesy($src);
                    $maxDim = 800;

                    if ($origWidth > $maxDim || $origHeight > $maxDim) {
                        if ($origWidth >= $origHeight) {
                            $newWidth = $maxDim;
                            $newHeight = (int) round(($origHeight / $origWidth) * $maxDim);
                        } else {
                            $newHeight = $maxDim;
                            $newWidth = (int) round(($origWidth / $origHeight) * $maxDim);
                        }

                        $dst = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($dst, false);
                        imagesavealpha($dst, true);
                        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                        imagedestroy($src);
                        $src = $dst;
                    }

                    ob_start();
                    if (function_exists('imagewebp')) {
                        imagewebp($src, null, 80);
                        $compressed = ob_get_clean();
                        imagedestroy($src);
                        if ($compressed) {
                            return 'data:image/webp;base64,' . base64_encode($compressed);
                        }
                    } else {
                        imagejpeg($src, null, 80);
                        $compressed = ob_get_clean();
                        imagedestroy($src);
                        if ($compressed) {
                            return 'data:image/jpeg;base64,' . base64_encode($compressed);
                        }
                    }
                }
            } catch (\Throwable $t) {
                // Fallback to raw below
            }
        }

        // Fallback: raw base64 if under 2MB
        if ($file->getSize() <= 2 * 1024 * 1024) {
            $raw = @file_get_contents($realPath);
            if ($raw) {
                return 'data:' . $mime . ';base64,' . base64_encode($raw);
            }
        }

        return null;
    }

    /**
     * Delete an uploaded image file safely.
     */
    public static function deleteImage(?string $path): void
    {
        if (empty($path) || str_starts_with($path, 'data:') || str_starts_with($path, 'http')) {
            return;
        }

        $publicFile = public_path($path);
        if (file_exists($publicFile) && is_file($publicFile)) {
            @unlink($publicFile);
        }

        if (str_starts_with($path, 'uploads/')) {
            $sub = substr($path, strlen('uploads/'));
            $tmpFile = '/tmp/uploads/' . $sub;
            if (file_exists($tmpFile) && is_file($tmpFile)) {
                @unlink($tmpFile);
            }
        }
    }
}
