<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Tampilkan form pengaturan teks halaman depan.
     */
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Simpan pembaruan pengaturan teks dan gambar.
     */
    public function update(Request $request)
    {
        // Validasi file gambar jika diunggah
        $request->validate([
            'hero_image'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'about_image_main'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'about_image_secondary' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ], [
            'hero_image.image'            => 'File foto Hero Banner harus berupa gambar.',
            'hero_image.mimes'            => 'Format foto Hero Banner: JPG, JPEG, PNG, WEBP.',
            'hero_image.max'              => 'Ukuran foto Hero Banner maksimal 5MB.',
            'about_image_main.image'      => 'File foto Utama Tentang Kami harus berupa gambar.',
            'about_image_main.mimes'      => 'Format foto Utama: JPG, JPEG, PNG, WEBP.',
            'about_image_main.max'        => 'Ukuran foto Utama maksimal 5MB.',
            'about_image_secondary.image' => 'File foto Sekunder Tentang Kami harus berupa gambar.',
            'about_image_secondary.mimes' => 'Format foto Sekunder: JPG, JPEG, PNG, WEBP.',
            'about_image_secondary.max'   => 'Ukuran foto Sekunder maksimal 5MB.',
        ]);

        $imageKeys = ['hero_image', 'about_image_main', 'about_image_secondary'];

        // Handle File Uploads
        foreach ($imageKeys as $imgKey) {
            if ($request->hasFile($imgKey)) {
                $oldVal = SiteSetting::where('key', $imgKey)->value('value');
                FileUploadService::deleteImage($oldVal);

                $uploadedPath = FileUploadService::uploadImage($request->file($imgKey), 'site');

                $group = str_starts_with($imgKey, 'hero_') ? 'hero' : 'about';
                SiteSetting::updateOrCreate(
                    ['key' => $imgKey],
                    ['value' => $uploadedPath, 'group' => $group]
                );
            }
        }

        // Handle Text Inputs
        $data = $request->except(array_merge(['_token', '_method'], $imageKeys));

        foreach ($data as $key => $value) {
            // Tentukan grup setting secara dinamis berdasarkan prefix
            $group = 'general';
            if (str_starts_with($key, 'hero_') || str_starts_with($key, 'stat_')) {
                $group = 'hero';
            } elseif (str_starts_with($key, 'feature_')) {
                $group = 'features';
            } elseif (str_starts_with($key, 'menu_')) {
                $group = 'menu';
            } elseif (str_starts_with($key, 'about_')) {
                $group = 'about';
            } elseif (str_starts_with($key, 'order_')) {
                $group = 'order';
            } elseif (str_starts_with($key, 'testimonial_')) {
                $group = 'testimonials';
            } elseif (str_starts_with($key, 'faq_')) {
                $group = 'faq';
            } elseif (str_starts_with($key, 'contact_') || str_starts_with($key, 'footer_') || str_starts_with($key, 'final_cta_')) {
                $group = 'contact';
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        SiteSetting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan teks dan gambar halaman depan berhasil diperbarui!');
    }

    /**
     * Reset semua teks ke pengaturan default.
     */
    public function reset()
    {
        Artisan::call('db:seed', [
            '--class' => 'SiteSettingSeeder',
            '--force' => true,
        ]);

        SiteSetting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Semua teks halaman depan berhasil direset ke pengaturan bawaan!');
    }
}
