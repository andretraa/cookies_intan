<?php $__env->startSection('title', 'Kelola Katalog & Foto Menu'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
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

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        background: linear-gradient(135deg, var(--orange) 0%, var(--brown) 100%);
        color: white;
        text-decoration: none;
        border-radius: var(--radius-full);
        font-size: 0.92rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(232, 137, 42, 0.35);
        transition: var(--transition);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(232, 137, 42, 0.45);
        color: white;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        border: 1px solid rgba(200, 149, 108, 0.2);
        border-radius: var(--radius-md);
        padding: 16px 20px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .stat-icon.orange { background: #FFF4E5; color: var(--orange); }
    .stat-icon.green  { background: #ECFDF5; color: var(--success); }
    .stat-icon.brown  { background: #F5EDE0; color: var(--brown); }

    .stat-info .num {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--brown-darker);
        line-height: 1.1;
    }

    .stat-info .label {
        font-size: 0.78rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 2px;
    }

    /* Filter & Search Bar */
    .filter-bar {
        background: white;
        border: 1px solid rgba(200, 149, 108, 0.2);
        border-radius: var(--radius-md);
        padding: 14px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        box-shadow: var(--shadow-sm);
    }

    .filter-pills {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-pill {
        padding: 6px 14px;
        border-radius: var(--radius-full);
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        color: var(--brown-dark);
        background: var(--cream);
        border: 1px solid rgba(200, 149, 108, 0.2);
        transition: var(--transition);
    }

    .filter-pill:hover {
        background: var(--cream-dark);
        border-color: var(--brown-light);
    }

    .filter-pill.active {
        background: var(--brown-dark);
        color: white;
        border-color: var(--brown-dark);
    }

    .search-box {
        display: flex;
        align-items: center;
        position: relative;
        min-width: 240px;
    }

    .search-box input {
        width: 100%;
        padding: 8px 12px 8px 34px;
        border: 1.5px solid rgba(200, 149, 108, 0.25);
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-family: inherit;
        background: #FFFDFB;
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--orange);
    }

    .search-icon {
        position: absolute;
        left: 12px;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* Catalog Table Card */
    .catalog-card {
        background: white;
        border: 1px solid rgba(200, 149, 108, 0.2);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .catalog-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .catalog-table th {
        background: #FAF4ED;
        padding: 14px 18px;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--brown-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid rgba(200, 149, 108, 0.2);
    }

    .catalog-table td {
        padding: 16px 18px;
        border-bottom: 1px solid rgba(200, 149, 108, 0.12);
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .catalog-table tr:last-child td {
        border-bottom: none;
    }

    .catalog-table tr:hover td {
        background-color: #FFFDFB;
    }

    /* Photo Thumbnail */
    .thumb-wrap {
        width: 72px;
        height: 72px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        background: var(--cream-dark);
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        flex-shrink: 0;
    }

    .thumb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .thumb-wrap:hover .thumb-img {
        transform: scale(1.1);
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .product-title-text {
        font-weight: 600;
        color: var(--brown-darker);
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .product-desc-snippet {
        font-size: 0.8rem;
        color: var(--text-muted);
        max-width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Badges */
    .badge-category {
        display: inline-block;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
        background: #F5EDE0;
        color: var(--brown);
        text-transform: capitalize;
    }

    .badge-promo {
        display: inline-block;
        padding: 3px 8px;
        border-radius: var(--radius-full);
        font-size: 0.7rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--orange), #FF6B4A);
        color: white;
    }

    .price-text {
        font-weight: 700;
        color: var(--brown-darker);
        font-size: 0.98rem;
    }

    .price-unit {
        font-size: 0.78rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    /* Status toggle badge */
    .status-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: var(--radius-full);
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: var(--transition);
    }

    .status-btn.active {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .status-btn.inactive {
        background: #F3F4F6;
        color: #6B7280;
        border: 1px solid #E5E7EB;
    }

    .status-btn:hover {
        opacity: 0.85;
    }

    /* Action buttons */
    .actions-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action-edit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #EFF6FF;
        color: #1D4ED8;
        border: 1px solid #BFDBFE;
        border-radius: var(--radius-full);
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-action-edit:hover {
        background: #1D4ED8;
        color: white;
        border-color: #1D4ED8;
    }

    .btn-action-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        background: #FFF1F0;
        color: #CF1322;
        border: 1px solid #FFA39E;
        border-radius: 50%;
        font-size: 0.82rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-action-delete:hover {
        background: #CF1322;
        color: white;
        border-color: #CF1322;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 3rem;
        color: var(--brown-light);
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--brown-dark);
        margin-bottom: 6px;
    }

    .empty-sub {
        font-size: 0.88rem;
        color: var(--text-muted);
        margin-bottom: 20px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Katalog & Foto Menu</h1>
            <p class="page-sub">Tambah menu baru, perbarui foto katalog, harga, atau ubah urutan menu website Cookies Intan.</p>
        </div>
        <a href="<?php echo e(route('admin.catalog.create')); ?>" class="btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Menu / Foto Baru
        </a>
    </div>

    <!-- Quick Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fa-solid fa-cookie-bite"></i></div>
            <div class="stat-info">
                <div class="num"><?php echo e($counts['total']); ?></div>
                <div class="label">Total Menu</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="stat-info">
                <div class="num"><?php echo e($counts['active']); ?></div>
                <div class="label">Aktif di Web</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon brown"><i class="fa-solid fa-layer-group"></i></div>
            <div class="stat-info">
                <div class="num">5 Kategori</div>
                <div class="label">Varian Menu</div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="filter-bar">
        <div class="filter-pills">
            <a href="<?php echo e(route('admin.catalog.index', ['search' => request('search')])); ?>" 
               class="filter-pill <?php echo e(!request('category') || request('category') === 'all' ? 'active' : ''); ?>">
                Semua (<?php echo e($counts['total']); ?>)
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $catLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.catalog.index', ['category' => $catKey, 'search' => request('search')])); ?>" 
                   class="filter-pill <?php echo e(request('category') === $catKey ? 'active' : ''); ?>">
                    <?php echo e($catLabel); ?> (<?php echo e($counts[$catKey] ?? 0); ?>)
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <form action="<?php echo e(route('admin.catalog.index')); ?>" method="GET" class="search-box">
            <?php if(request('category')): ?>
                <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
            <?php endif; ?>
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama menu..." onchange="this.form.submit()">
        </form>
    </div>

    <!-- Catalog Table Card -->
    <div class="catalog-card">
        <?php if($products->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fa-solid fa-cookie"></i></div>
                <h3 class="empty-title">Belum ada menu yang sesuai</h3>
                <p class="empty-sub">Tidak ada menu yang ditemukan dengan filter ini. Mulai tambahkan menu baru sekarang.</p>
                <a href="<?php echo e(route('admin.catalog.create')); ?>" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Menu Baru
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="catalog-table">
                    <thead>
                        <tr>
                            <th style="width: 320px;">Foto & Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Badge Promo</th>
                            <th>Status Tampil</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <!-- Photo & Title -->
                                <td>
                                    <div class="product-meta">
                                        <div class="thumb-wrap">
                                            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" class="thumb-img" loading="lazy">
                                        </div>
                                        <div>
                                            <div class="product-title-text"><?php echo e($product->name); ?></div>
                                            <div class="product-desc-snippet" title="<?php echo e($product->description); ?>"><?php echo e($product->description ?: 'Tidak ada deskripsi'); ?></div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td>
                                    <span class="badge-category"><?php echo e($categories[$product->category] ?? ucfirst($product->category)); ?></span>
                                </td>

                                <!-- Price -->
                                <td>
                                    <div class="price-text"><?php echo e($product->formatted_price); ?></div>
                                    <span class="price-unit"><?php echo e($product->price_unit); ?></span>
                                </td>

                                <!-- Badge -->
                                <td>
                                    <?php if($product->badge): ?>
                                        <span class="badge-promo"><?php echo e($product->badge); ?></span>
                                    <?php else: ?>
                                        <span style="color: #bbb; font-size: 0.8rem;">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Status Toggle -->
                                <td>
                                    <form action="<?php echo e(route('admin.catalog.toggle', $product)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="status-btn <?php echo e($product->is_active ? 'active' : 'inactive'); ?>" title="Klik untuk mengubah status">
                                            <i class="fa-solid <?php echo e($product->is_active ? 'fa-circle-check' : 'fa-circle-xmark'); ?>"></i>
                                            <?php echo e($product->is_active ? 'Aktif' : 'Nonaktif'); ?>

                                        </button>
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="actions-wrap" style="justify-content: flex-end;">
                                        <a href="<?php echo e(route('admin.catalog.edit', $product)); ?>" class="btn-action-edit" title="Ubah foto katalog & data menu">
                                            <i class="fa-solid fa-pen-to-square"></i> Ubah Foto / Data
                                        </a>

                                        <form action="<?php echo e(route('admin.catalog.destroy', $product)); ?>" method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu \'<?php echo e($product->name); ?>\'? Foto dan data menu ini akan dihapus permanen.');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn-action-delete" title="Hapus menu ini">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\.gemini\antigravity-ide\scratch\barbershop\resources\views/admin/catalog/index.blade.php ENDPATH**/ ?>