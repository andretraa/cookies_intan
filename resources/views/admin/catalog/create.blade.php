@extends('admin.layouts.app')

@section('title', 'Tambah Menu & Foto Baru')

@section('styles')
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
        grid-template-columns: 340px 1fr;
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

    /* Image Dropzone & Preview */
    .dropzone-wrap {
        border: 2px dashed rgba(200, 149, 108, 0.4);
        border-radius: var(--radius-md);
        padding: 24px 16px;
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
        font-size: 2.8rem;
        color: var(--brown-light);
        margin-bottom: 10px;
    }

    .dropzone-text {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--brown-dark);
        margin-bottom: 4px;
    }

    .dropzone-sub {
        font-size: 0.78rem;
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

    /* Live Preview Box */
    .preview-box {
        display: none;
        margin-top: 16px;
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 1px solid rgba(200, 149, 108, 0.3);
        box-shadow: var(--shadow-md);
        position: relative;
    }

    .preview-box img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
    }

    .preview-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
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
@endsection

@section('content')

    <!-- Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Tambah Menu & Foto Katalog</h1>
            <p class="page-sub">Unggah foto produk baru dan lengkapi rincian menu untuk ditampilkan di katalog Cookies Intan.</p>
        </div>
        <a href="{{ route('admin.catalog.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.catalog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-layout">
            <!-- Left: Image Upload & Preview -->
            <div class="form-card">
                <div class="form-card-title">
                    <i class="fa-regular fa-image" style="color: var(--orange);"></i> Foto Katalog Menu <span class="req" style="color:red">*</span>
                </div>

                <div class="dropzone-wrap" id="dropzoneWrap">
                    <input type="file" name="image" id="imageInput" class="file-input" accept="image/jpeg,image/png,image/jpg,image/webp" required>
                    <div class="dropzone-icon">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <div class="dropzone-text">Pilih atau Tarik Foto ke Sini</div>
                    <div class="dropzone-sub">Format JPG, PNG, WEBP (Maks 5MB)</div>
                </div>

                <!-- Live Image Preview Box -->
                <div class="preview-box" id="previewBox">
                    <img id="previewImg" src="#" alt="Pratinjau Foto">
                    <span class="preview-badge"><i class="fa-solid fa-check"></i> Foto Terpilih</span>
                </div>

                <div class="form-helper" style="margin-top: 12px; text-align: center;">
                    💡 Tips: Gunakan foto dengan pencahayaan hangat dan rasio persegi (1:1) atau 4:3 untuk hasil katalog terbaik.
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
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Double Choco Brownies" required>
                </div>

                <!-- Kategori & Badge -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="category">Kategori Menu <span class="req">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $catKey => $catLabel)
                                <option value="{{ $catKey }}" {{ old('category') === $catKey ? 'selected' : '' }}>
                                    {{ $catLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="badge">Badge Promo (Opsional)</label>
                        <input type="text" id="badge" name="badge" class="form-control" value="{{ old('badge') }}" placeholder="Contoh: Best Seller, Favorit, Baru">
                        <div class="form-helper">Label pita promo yang muncul di sudut foto</div>
                    </div>
                </div>

                <!-- Harga & Satuan -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="price">Harga (Rupiah) <span class="req">*</span></label>
                        <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" placeholder="Contoh: 45000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="price_unit">Satuan Harga <span class="req">*</span></label>
                        <input type="text" id="price_unit" name="price_unit" class="form-control" value="{{ old('price_unit', '/box') }}" placeholder="Contoh: /box, /pcs, /set, /cup" required>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi Singkat</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Tuliskan rasa, tekstur, atau keistimewaan menu ini...">{{ old('description') }}</textarea>
                </div>

                <!-- Urutan & Status Aktif -->
                <div class="form-row" style="align-items: center;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="sort_order">Urutan Tampilan</label>
                        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" placeholder="0">
                        <div class="form-helper">Angka lebih kecil tampil lebih dulu</div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Status Publikasi</label>
                        <label class="checkbox-wrap">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                            <span style="font-weight: 600; font-size: 0.88rem; color: var(--brown-dark);">Langsung Tampilkan di Website</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div style="margin-top: 28px; display: flex; gap: 14px; align-items: center;">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Menu & Foto
                    </button>
                    <a href="{{ route('admin.catalog.index') }}" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none;">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
<script>
    // Live image preview
    const imageInput = document.getElementById('imageInput');
    const previewBox = document.getElementById('previewBox');
    const previewImg = document.getElementById('previewImg');
    const dropzoneWrap = document.getElementById('dropzoneWrap');

    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImg.src = event.target.result;
                previewBox.style.display = 'block';
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
@endsection
