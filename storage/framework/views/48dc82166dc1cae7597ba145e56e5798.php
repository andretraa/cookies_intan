<?php $__env->startSection('title', 'Ubah Menu & Foto Katalog'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .page-header {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--brown-darker);
    }

    .page-sub {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        background: white;
        border: 1px solid rgba(200, 149, 108, 0.3);
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--brown-dark);
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-back:hover {
        background: var(--cream-dark);
        color: var(--brown);
    }

    .form-layout {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 28px;
        align-items: start;
    }

    .form-card {
        background: white;
        border: 1px solid rgba(200, 149, 108, 0.2);
        border-radius: var(--radius-lg);
        padding: 28px;
        box-shadow: var(--shadow-sm);
    }

    .form-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--brown-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid rgba(200, 149, 108, 0.15);
        padding-bottom: 12px;
    }

    /* Current Image Box */
    .current-image-wrap {
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 1.5px solid rgba(200, 149, 108, 0.3);
        box-shadow: var(--shadow-md);
        position: relative;
        margin-bottom: 18px;
        background: var(--cream-dark);
    }

    .current-image-wrap img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .current-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(44, 26, 14, 0.85);
        color: white;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 0.72rem;
        font-weight: 600;
    }

    /* Image Dropzone & Preview */
    .dropzone-wrap {
        border: 2px dashed rgba(200, 149, 108, 0.4);
        border-radius: var(--radius-md);
        padding: 20px 16px;
        text-align: center;
        background: #FFFDFB;
        cursor: pointer;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .dropzone-wrap:hover, .dropzone-wrap.dragover {
        border-color: var(--orange);
        background: #FFF8F0;
    }

    .dropzone-icon {
        font-size: 2.2rem;
        color: var(--brown-light);
        margin-bottom: 8px;
    }

    .dropzone-text {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--brown-dark);
        margin-bottom: 4px;
    }

    .dropzone-sub {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        z-index: 5;
    }

    /* New Image Preview Box */
    .new-preview-box {
        display: none;
        margin-top: 16px;
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 2px solid var(--orange);
        box-shadow: var(--shadow-md);
        position: relative;
    }

    .new-preview-box img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .new-preview-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--orange);
        color: white;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 0.72rem;
        font-weight: 600;
    }

    /* Form Inputs */
    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-label {
        display: block;
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--brown-dark);
        margin-bottom: 6px;
    }

    .form-label span.req {
        color: var(--danger);
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid rgba(200, 149, 108, 0.3);
        border-radius: 10px;
        font-size: 0.9rem;
        font-family: inherit;
        background: #FFFDFB;
        color: var(--text-dark);
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(232, 137, 42, 0.15);
        background: #fff;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .form-helper {
        font-size: 0.76rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 10px 14px;
        background: #FFF8F0;
        border: 1px solid rgba(200, 149, 108, 0.2);
        border-radius: 10px;
    }

    .checkbox-wrap input {
        accent-color: var(--orange);
        width: 18px;
        height: 18px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 28px;
        background: linear-gradient(135deg, var(--orange) 0%, var(--brown) 100%);
        color: white;
        border: none;
        border-radius: var(--radius-full);
        font-family: inherit;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(232, 137, 42, 0.35);
        transition: var(--transition);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(232, 137, 42, 0.45);
    }

    @media (max-width: 900px) {
        .form-layout {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Ubah Menu: <?php echo e($product->name); ?></h1>
            <p class="page-sub">Ganti foto katalog produk atau perbarui harga, kategori, dan deskripsi menu.</p>
        </div>
        <a href="<?php echo e(route('admin.catalog.index')); ?>" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="<?php echo e(route('admin.catalog.update', $product)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-layout">
            <!-- Left: Current & New Image -->
            <div class="form-card">
                <div class="form-card-title">
                    <i class="fa-regular fa-image" style="color: var(--orange);"></i> Foto Katalog Menu
                </div>

                <!-- Current Image -->
                <div class="current-image-wrap">
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" id="currentImg">
                    <span class="current-badge"><i class="fa-solid fa-camera"></i> Foto Saat Ini</span>
                </div>

                <!-- Upload replacement -->
                <div class="dropzone-wrap" id="dropzoneWrap">
                    <input type="file" name="image" id="imageInput" class="file-input" accept="image/jpeg,image/png,image/jpg,image/webp">
                    <div class="dropzone-icon">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </div>
                    <div class="dropzone-text">Pilih Foto Baru untuk Mengganti</div>
                    <div class="dropzone-sub">Biarkan kosong jika tidak ingin mengubah foto</div>
                </div>

                <!-- New Live Preview Box -->
                <div class="new-preview-box" id="newPreviewBox">
                    <img id="newPreviewImg" src="#" alt="Pratinjau Foto Baru">
                    <span class="new-preview-badge"><i class="fa-solid fa-sparkles"></i> Foto Baru Dipilih</span>
                </div>
            </div>

            <!-- Right: Details Form -->
            <div class="form-card">
                <div class="form-card-title">
                    <i class="fa-solid fa-file-lines" style="color: var(--brown);"></i> Informasi Menu
                </div>

                <!-- Nama Menu -->
                <div class="form-group">
                    <label class="form-label" for="name">Nama Menu Produk <span class="req">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo e(old('name', $product->name)); ?>" required>
                </div>

                <!-- Kategori & Badge -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategori Menu <span class="req">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $catLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($catKey); ?>" <?php echo e(old('category', $product->category) === $catKey ? 'selected' : ''); ?>>
                                    <?php echo e($catLabel); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="badge">Badge Promo (Opsional)</label>
                        <input type="text" id="badge" name="badge" class="form-control" value="<?php echo e(old('badge', $product->badge)); ?>" placeholder="Contoh: Best Seller, Favorit, Baru">
                        <div class="form-helper">Label pita promo di sudut foto</div>
                    </div>
                </div>

                <!-- Harga & Satuan -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="price">Harga (Rupiah) <span class="req">*</span></label>
                        <input type="number" id="price" name="price" class="form-control" value="<?php echo e(old('price', (int)$product->price)); ?>" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="price_unit">Satuan Harga <span class="req">*</span></label>
                        <input type="text" id="price_unit" name="price_unit" class="form-control" value="<?php echo e(old('price_unit', $product->price_unit)); ?>" placeholder="Contoh: /box, /pcs, /set, /cup" required>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi Singkat</label>
                    <textarea id="description" name="description" class="form-control"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>

                <!-- Urutan & Status Aktif -->
                <div class="form-row" style="align-items: center;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="sort_order">Urutan Tampilan</label>
                        <input type="number" id="sort_order" name="sort_order" class="form-control" value="<?php echo e(old('sort_order', $product->sort_order)); ?>">
                        <div class="form-helper">Angka lebih kecil tampil lebih dulu</div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Status Publikasi</label>
                        <label class="checkbox-wrap">
                            <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $product->is_active ? '1' : '0') == '1' ? 'checked' : ''); ?>>
                            <span style="font-weight: 600; font-size: 0.88rem; color: var(--brown-dark);">Tampilkan di Website</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div style="margin-top: 28px; display: flex; gap: 14px; align-items: center;">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    <a href="<?php echo e(route('admin.catalog.index')); ?>" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none;">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Live image preview for replacement photo
    const imageInput = document.getElementById('imageInput');
    const newPreviewBox = document.getElementById('newPreviewBox');
    const newPreviewImg = document.getElementById('newPreviewImg');
    const dropzoneWrap = document.getElementById('dropzoneWrap');

    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                newPreviewImg.src = event.target.result;
                newPreviewBox.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag & drop highlight
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzoneWrap.addEventListener(eventName, () => dropzoneWrap.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzoneWrap.addEventListener(eventName, () => dropzoneWrap.classList.remove('dragover'), false);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\.gemini\antigravity-ide\scratch\barbershop\resources\views/admin/catalog/edit.blade.php ENDPATH**/ ?>