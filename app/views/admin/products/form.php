<div class="admin-card" style="max-width: 900px; margin: 0 auto;">
    <div class="admin-card-header">
        <div>
            <h3><?= !empty($product) ? 'Edit Produk: ' . htmlspecialchars($product['title']) : 'Tambah Produk Baru' ?></h3>
            <p style="color: var(--admin-text-muted); font-size: 13px; margin: 4px 0 0 0;">
                Isi form di bawah ini untuk memperbarui informasi katalog produk.
            </p>
        </div>
        <a href="<?= BASEURL ?>admin/products" class="btn-admin btn-secondary-admin">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <?php if (!empty($error)): ?>
    <div class="flash-alert flash-error">
        <span>&#9888;</span>
        <span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>

    <form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 20px;">
        
        <!-- Section 1: Informasi Dasar -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 22px;">
            <h4 style="color: #0f172a; font-size: 15px; font-weight: 700; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                <span style="color: var(--admin-accent);">1.</span> Informasi Utama
            </h4>
            
            <div style="display: grid; grid-template-columns: 2fr 1.2fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Judul Produk *</label>
                    <input type="text" name="title" class="form-control" required value="<?= htmlspecialchars($product['title'] ?? '') ?>" placeholder="Misal: Ivory Pearl Classic Shell Lamp">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Kategori Produk *</label>
                    <select name="category_id" class="form-control">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ((int)($product['category_id'] ?? 1) === (int)$cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="1">Lampu Cangkang Keramik</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Badge Label</label>
                    <input type="text" name="badge" class="form-control" value="<?= htmlspecialchars($product['badge'] ?? 'Terlaris') ?>" placeholder="Misal: Terlaris, Edisi Mistik">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Harga Jual (Rp) *</label>
                    <input type="number" name="price" class="form-control" required value="<?= (int)($product['price'] ?? 289000) ?>">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Harga Coret / Asli (Rp)</label>
                    <input type="number" name="original_price" class="form-control" value="<?= (int)($product['original_price'] ?? 399000) ?>">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Label Diskon</label>
                    <input type="text" name="discount" class="form-control" value="<?= htmlspecialchars($product['discount'] ?? '25% OFF') ?>" placeholder="Misal: 28% OFF">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Rating (1.0 - 5.0)</label>
                    <input type="number" step="0.1" name="rating" class="form-control" value="<?= (float)($product['rating'] ?? 5.0) ?>">
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Jumlah Ulasan Pembeli</label>
                    <input type="number" name="reviews_count" class="form-control" value="<?= (int)($product['reviews_count'] ?? 100) ?>">
                </div>
            </div>
        </div>

        <!-- Section 2: Foto & Galeri Produk -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 22px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                <h4 style="color: #0f172a; font-size: 15px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <span style="color: var(--admin-accent);">2.</span> Foto & Galeri Thumbnail
                </h4>
                <span style="font-size: 12px; color: var(--admin-accent); font-weight: 600; background: #e0f2fe; padding: 3px 10px; border-radius: 20px;">
                    Upload Langsung dari HP / Laptop
                </span>
            </div>

            <div style="display: grid; grid-template-columns: 240px 1fr; gap: 20px; align-items: start; margin-bottom: 20px;">
                <!-- Kotak Pratinjau Foto Utama -->
                <div style="text-align: center; background: #ffffff; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 16px; min-height: 220px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                    <?php 
                        $curImg = !empty($product['main_image']) ? $product['main_image'] : 'images/pearl-white.png';
                        $curSrc = (strpos($curImg, 'http') === 0) ? $curImg : (BASEURL . $curImg);
                    ?>
                    <img id="mainImagePreview" src="<?= htmlspecialchars($curSrc) ?>" alt="Pratinjau Foto" style="max-height: 160px; max-width: 100%; object-fit: contain; border-radius: 8px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.1));">
                    <span id="previewLabel" style="font-size: 11.5px; color: #64748b; margin-top: 10px; font-weight: 600; line-height: 1.4;">
                        Foto Utama Produk
                    </span>
                </div>

                <!-- Input Pilihan Upload & File -->
                <div>
                    <!-- 1. Upload File Utama -->
                    <div style="margin-bottom: 16px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                        <label style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">
                            <span>Pilih Foto Baru dari Perangkat</span>
                            <span style="font-size: 11px; color: var(--admin-accent); font-weight: 600;">(JPG, PNG, WEBP)</span>
                        </label>
                        <input type="file" name="image_file" id="imageFileInput" accept="image/png, image/jpeg, image/jpg, image/webp, image/gif" class="form-control" style="padding: 9px 12px; cursor: pointer; background: #f8fafc;" onchange="previewSelectedImage(this)">
                        <div style="margin-top: 6px; color: #64748b; font-size: 12px;">
                            Cukup klik tombol di atas untuk memilih foto produk Anda dari galeri HP atau laptop. Foto otomatis tampil di pratinjau kiri.
                        </div>
                    </div>

                    <!-- 2. Pilihan Cepat Mutiara Bawaan -->
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px;">Atau Gunakan Contoh Foto Mutiara Siap Pakai:</label>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <button type="button" class="btn-preset-img" onclick="pickPresetImage('images/pearl-white.png')"><span class="preset-color-dot" style="background: #f1f5f9; border: 1px solid #cbd5e1; width: 10px; height: 10px; border-radius: 50%; display: inline-block;"></span> Mutiara Putih</button>
                            <button type="button" class="btn-preset-img" onclick="pickPresetImage('images/pearl-gold.png')"><span class="preset-color-dot" style="background: #eab308; width: 10px; height: 10px; border-radius: 50%; display: inline-block;"></span> Mutiara Emas</button>
                            <button type="button" class="btn-preset-img" onclick="pickPresetImage('images/pearl-ocean.png')"><span class="preset-color-dot" style="background: #0284c7; width: 10px; height: 10px; border-radius: 50%; display: inline-block;"></span> Samudra Mistik</button>
                            <button type="button" class="btn-preset-img" onclick="pickPresetImage('images/pearl-natural.png')"><span class="preset-color-dot" style="background: #a8a29e; width: 10px; height: 10px; border-radius: 50%; display: inline-block;"></span> Kerang Alami</button>
                        </div>
                    </div>

                    <!-- Input path disembunyikan dalam opsi lanjutan -->
                    <details style="font-size: 12px; color: #64748b; margin-top: 10px;">
                        <summary style="cursor: pointer; color: var(--admin-accent); font-weight: 600;">Opsi Teknis Lanjutan (Ketik Link / Lokasi Gambar Manual)</summary>
                        <div style="margin-top: 8px;">
                            <input type="text" name="main_image" id="mainImagePathInput" class="form-control" value="<?= htmlspecialchars($product['main_image'] ?? 'images/pearl-white.png') ?>" placeholder="Misal: images/pearl-white.png atau https://..." oninput="updatePreviewFromPath(this.value)">
                        </div>
                    </details>
                </div>
            </div>

            <!-- Galeri Foto Tambahan -->
            <div style="border-top: 1px solid var(--admin-border); padding-top: 18px; margin-top: 10px;">
                <label style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; font-size: 13px; font-weight: 700; color: #0f172a;">
                    <span style="display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        Galeri Foto Tambahan (Tampak Samping / Sudut Lain)
                    </span>
                    <span style="font-size: 11px; color: #64748b; font-weight: 400;">(Foto-foto kecil yang bisa diklik pembeli)</span>
                </label>

                <!-- Pratinjau Visual Foto-Foto Galeri Tambahan -->
                <div id="galleryPreviewsContainer" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 12px; align-items: center;">
                    <?php if (!empty($product['thumbnails']) && is_array($product['thumbnails'])): ?>
                        <?php foreach ($product['thumbnails'] as $tIdx => $tImg): 
                            $tSrc = (strpos($tImg, 'http') === 0) ? $tImg : (BASEURL . $tImg);
                        ?>
                        <div style="width: 68px; height: 68px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; padding: 4px; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.06);" title="<?= htmlspecialchars($tImg) ?>">
                            <img src="<?= htmlspecialchars($tSrc) ?>" alt="Thumb" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 4px;">
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Tombol Pilih Foto Galeri dari HP/Laptop -->
                <div style="margin-bottom: 12px;">
                    <label style="cursor: pointer; display: inline-flex; align-items: center; gap: 8px; background: #ffffff; border: 1px solid #cbd5e1; padding: 9px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; color: #334155; transition: all 0.2s;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>+ Tambah Foto Galeri dari HP / Komputer</span>
                        <input type="file" name="extra_images[]" id="extraImagesInput" multiple accept="image/png, image/jpeg, image/jpg, image/webp" style="display: none;" onchange="handleExtraImagesSelected(this)">
                    </label>
                    <span id="extraFilesCountText" style="font-size: 12px; color: var(--admin-accent); font-weight: 600; margin-left: 10px;"></span>
                </div>

                <!-- Teks Teknis disembunyikan dalam dropdown lanjutan agar tidak membingungkan -->
                <details style="font-size: 12px; color: #64748b; margin-top: 8px;">
                    <summary style="cursor: pointer; color: var(--admin-accent); font-weight: 600;">Opsi Teknis Lanjutan (Daftar File / Link Manual)</summary>
                    <div style="margin-top: 8px;">
                        <p style="margin: 0 0 6px 0; font-size: 11.5px;">Jika Anda seorang developer yang ingin mengetik link URL gambar eksternal secara manual (1 baris per link):</p>
                        <?php
                        $thumbsText = '';
                        if (!empty($product['thumbnails']) && is_array($product['thumbnails'])) {
                            $thumbsText = implode("\n", $product['thumbnails']);
                        } else {
                            $thumbsText = "images/pearl-white.png\nimages/pearl-ocean.png\nimages/pearl-gold.png\nimages/pearl-natural.png";
                        }
                        ?>
                        <textarea name="thumbnails" id="thumbnailsTextarea" class="form-control" rows="3" style="font-family: monospace; font-size: 12px;"><?= htmlspecialchars($thumbsText) ?></textarea>
                    </div>
                </details>
            </div>
        </div>

        <!-- Section 3: Varian & Ukuran -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 22px;">
            <h4 style="color: #0f172a; font-size: 15px; font-weight: 700; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                <span style="color: var(--admin-accent);">3.</span> Varian Warna & Ukuran
            </h4>
            
            <!-- Pilihan Varian Warna -->
            <div style="margin-bottom: 22px;">
                <label style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="font-weight: 700; color: #0f172a; font-size: 13.5px; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a14.5 14.5 0 0 0 0 20 10 10 0 0 0 9.5-6.5A10 10 0 0 0 12 2z"></path></svg>
                        Pilihan Varian Warna Produk
                    </span>
                    <span style="font-size: 11.5px; color: #64748b;">(Klik kotak warna untuk memilih visual warna secara bebas)</span>
                </label>

                <?php
                $colorsList = $product['colors'] ?? [];
                if (empty($colorsList)) {
                    $colorsList = [
                        ['name' => 'Ivory White', 'hex' => '#f8f5ee'],
                        ['name' => 'Ocean Abyss', 'hex' => '#1e3a5f']
                    ];
                }
                ?>
                <div id="colorVariantsList" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 12px;">
                    <?php foreach ($colorsList as $cIdx => $c): ?>
                    <div class="color-variant-row" style="display: flex; gap: 10px; align-items: center; background: #ffffff; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                        <div style="display: flex; align-items: center; gap: 8px;" title="Klik untuk ubah warna visual">
                            <input type="color" name="color_hex[]" value="<?= htmlspecialchars($c['hex'] ?? '#f8f5ee') ?>" style="width: 38px; height: 38px; border: 2px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 0; background: none; -webkit-appearance: none;">
                        </div>
                        <div style="flex: 1;">
                            <input type="text" name="color_name[]" class="form-control" value="<?= htmlspecialchars($c['name'] ?? '') ?>" placeholder="Nama varian warna (contoh: Putih Mutiara, Gold, Pink)">
                        </div>
                        <button type="button" onclick="this.closest('.color-variant-row').remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 6px; border-radius: 6px; display: flex; align-items: center; justify-content: center;" title="Hapus varian ini">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Tombol Aksi Warna & Preset Cepat -->
                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; justify-content: space-between; background: #ffffff; padding: 10px 14px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    <button type="button" onclick="addColorVariantRow()" class="btn-admin" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <span>+ Tambah Varian Warna</span>
                    </button>
                    <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span style="font-size: 11px; color: #64748b; font-weight: 600;">Pilihan cepat:</span>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Ivory White', '#f8f5ee')"><span class="preset-color-dot" style="background: #f8f5ee; border: 1px solid #cbd5e1;"></span> Putih</button>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Champagne Gold', '#e5c158')"><span class="preset-color-dot" style="background: #e5c158;"></span> Gold</button>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Natural Bronze', '#8c7853')"><span class="preset-color-dot" style="background: #8c7853;"></span> Bronze</button>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Ocean Blue', '#1e3a5f')"><span class="preset-color-dot" style="background: #1e3a5f;"></span> Navy</button>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Rose Pink', '#f472b6')"><span class="preset-color-dot" style="background: #f472b6;"></span> Rose</button>
                        <button type="button" class="btn-chip" onclick="addColorVariantPreset('Silver Grey', '#cbd5e1')"><span class="preset-color-dot" style="background: #cbd5e1;"></span> Silver</button>
                    </div>
                </div>
            </div>

            <!-- Pilihan Ukuran -->
            <div>
                <label style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="font-weight: 700; color: #0f172a; font-size: 13.5px; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 8.7l-6-6a1 1 0 0 0-1.4 0l-11 11a1 1 0 0 0 0 1.4l6 6a1 1 0 0 0 1.4 0l11-11a1 1 0 0 0 0-1.4z"></path><path d="M14.5 4.5l2 2"></path><path d="M11.5 7.5l2 2"></path><path d="M8.5 10.5l2 2"></path><path d="M5.5 13.5l2 2"></path></svg>
                        Pilihan Ukuran Produk
                    </span>
                    <span style="font-size: 11.5px; color: #64748b;">(Ketik ukuran atau klik tag ukuran cepat di bawah)</span>
                </label>
                <?php
                $sizesText = !empty($product['sizes']) && is_array($product['sizes']) 
                    ? implode(', ', $product['sizes']) 
                    : 'S (14 cm), M (17 cm), L (20 cm)';
                ?>
                <input type="text" name="sizes" id="sizesInput" class="form-control" value="<?= htmlspecialchars($sizesText) ?>" placeholder="Misal: S (14 cm), M (17 cm), L (20 cm)" style="margin-bottom: 8px;">
                <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                    <span style="font-size: 11px; color: #64748b; font-weight: 600;">Klik untuk menambah ukuran:</span>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('Standar')">+ Standar</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('15 cm')">+ 15 cm</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('16 cm')">+ 16 cm</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('18 cm')">+ 18 cm</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('20 cm')">+ 20 cm</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('S')">+ S</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('M')">+ M</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('L')">+ L</button>
                    <button type="button" class="btn-chip" onclick="appendSizeTag('All Size')">+ All Size</button>
                </div>
            </div>
        </div>

        <!-- Section 4: Deskripsi & Spesifikasi -->
        <div style="background: #f8fafc; border: 1px solid var(--admin-border); border-radius: 10px; padding: 22px;">
            <h4 style="color: #0f172a; font-size: 15px; font-weight: 700; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                <span style="color: var(--admin-accent);">4.</span> Deskripsi, Fitur & Spesifikasi
            </h4>
            
            <div style="margin-bottom: 22px;">
                <label style="display: block; font-weight: 700; color: #0f172a; font-size: 13.5px; margin-bottom: 6px; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Deskripsi Singkat Produk
                </label>
                <textarea name="description" class="form-control" rows="3" placeholder="Jelaskan keunggulan dan cerita produk ini..."><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
            </div>

            <!-- Keunggulan Utama / Bullets -->
            <div style="margin-bottom: 22px;">
                <label style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="font-weight: 700; color: #0f172a; font-size: 13.5px; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        Keunggulan Utama / Poin Sorotan
                    </span>
                    <span style="font-size: 11.5px; color: #64748b;">(Poin-poin penting yang memikat calon pembeli di halaman produk)</span>
                </label>
                <?php
                $bulletsList = !empty($product['bullets']) && is_array($product['bullets']) 
                    ? $product['bullets'] 
                    : [
                        'Cangkang kerang porselen glasir premium',
                        'Cahaya Warm LED 2700K relaksasi mata',
                        'Baterai Lithium Rechargeable Type-C'
                    ];
                ?>
                <div id="bulletsList" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 10px;">
                    <?php foreach ($bulletsList as $bText): ?>
                    <div class="bullet-row" style="display: flex; gap: 8px; align-items: center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <input type="text" name="bullet_item[]" class="form-control" value="<?= htmlspecialchars($bText) ?>" placeholder="Tulis satu poin keunggulan..." style="flex: 1;">
                        <button type="button" onclick="this.closest('.bullet-row').remove()" style="background: none; border: none; color: #94a3b8; cursor: pointer; padding: 4px 8px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#94a3b8'" title="Hapus poin">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; justify-content: space-between; background: #ffffff; padding: 10px 14px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    <button type="button" onclick="addBulletRow()" class="btn-admin" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <span>+ Tambah Poin Keunggulan</span>
                    </button>
                    <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span style="font-size: 11px; color: #64748b; font-weight: 600;">Saran cepat:</span>
                        <button type="button" class="btn-chip" onclick="addBulletPreset('Cangkang porselen glasir mewah berstandar kurasi')">+ Porselen Mewah</button>
                        <button type="button" class="btn-chip" onclick="addBulletPreset('Cahaya warm ambient ramah mata dan hemat energi')">+ Lampu LED Warm</button>
                        <button type="button" class="btn-chip" onclick="addBulletPreset('Pengisian daya modern USB Type-C tahan hingga 12 jam')">+ Baterai Type-C</button>
                    </div>
                </div>
            </div>

            <!-- Spesifikasi Teknis -->
            <div style="margin-bottom: 22px;">
                <label style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span style="font-weight: 700; color: #0f172a; font-size: 13.5px; display: inline-flex; align-items: center; gap: 6px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        Spesifikasi Teknis Produk
                    </span>
                    <span style="font-size: 11.5px; color: #64748b;">(Tabel rincian produk: Cukup isi Nama & Keterangannya tanpa simbol khusus)</span>
                </label>
                <?php
                $specsList = !empty($product['specs']) && is_array($product['specs']) 
                    ? $product['specs'] 
                    : [
                        ['label' => 'Material Utama', 'val' => 'Fine Glazed Ceramic'],
                        ['label' => 'Sumber Cahaya', 'val' => 'Warm LED (Dimmable)'],
                        ['label' => 'Dimensi Produk', 'val' => '17 x 15 x 16 cm']
                    ];
                ?>
                <div id="specsList" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 10px;">
                    <?php foreach ($specsList as $sp): ?>
                    <div class="spec-row" style="display: flex; gap: 10px; align-items: center; background: #ffffff; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                        <div style="flex: 1;">
                            <input type="text" name="spec_label[]" class="form-control" value="<?= htmlspecialchars($sp['label'] ?? '') ?>" placeholder="Nama Spesifikasi (misal: Material Utama)">
                        </div>
                        <div style="color: #94a3b8; font-weight: 700;">:</div>
                        <div style="flex: 1.5;">
                            <input type="text" name="spec_val[]" class="form-control" value="<?= htmlspecialchars($sp['val'] ?? '') ?>" placeholder="Keterangan / Nilai (misal: Fine Glazed Ceramic)">
                        </div>
                        <button type="button" onclick="this.closest('.spec-row').remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 6px; border-radius: 6px; display: flex; align-items: center; justify-content: center;" title="Hapus baris spesifikasi">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; justify-content: space-between; background: #ffffff; padding: 10px 14px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    <button type="button" onclick="addSpecRow()" class="btn-admin" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <span>+ Tambah Baris Spesifikasi</span>
                    </button>
                    <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span style="font-size: 11px; color: #64748b; font-weight: 600;">Tambah label cepat:</span>
                        <button type="button" class="btn-chip" onclick="addSpecPreset('Material Utama', '')">+ Material</button>
                        <button type="button" class="btn-chip" onclick="addSpecPreset('Sumber Cahaya', 'Warm LED')">+ Sumber Cahaya</button>
                        <button type="button" class="btn-chip" onclick="addSpecPreset('Kapasitas Baterai', '2000 mAh')">+ Baterai</button>
                        <button type="button" class="btn-chip" onclick="addSpecPreset('Dimensi', '')">+ Dimensi</button>
                        <button type="button" class="btn-chip" onclick="addSpecPreset('Garansi', '1 Tahun')">+ Garansi</button>
                    </div>
                </div>
            </div>

            <!-- Penjelasan Material & Sertifikasi -->
            <div style="margin-bottom: 22px;">
                <label style="display: block; font-weight: 700; color: #0f172a; font-size: 13.5px; margin-bottom: 6px; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Penjelasan Material & Keaslian
                </label>
                <textarea name="materials" class="form-control" rows="3" placeholder="Informasi keaslian mutiara/material dan panduan..."><?= htmlspecialchars($product['materials'] ?? '') ?></textarea>
            </div>

            <!-- ID Rekomendasi Terkait (Disembunyikan, dikelola otomatis) -->
            <input type="hidden" name="related_ids" value="<?= htmlspecialchars($product['related_ids'] ?? '1,2,3,4') ?>">
            
            <div style="background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; display: flex; align-items: center; gap: 12px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"></path><path d="M10 22h4"></path><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"></path></svg>
                <div style="font-size: 12.5px; color: #475569; line-height: 1.4;">
                    <strong>Rekomendasi Produk Serupa:</strong> Ditampilkan secara otomatis oleh sistem berdasarkan kategori produk agar pembeli tertarik menjelajahi produk lainnya.
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 10px;">
            <a href="<?= BASEURL ?>admin/products" class="btn-admin btn-secondary-admin" style="padding: 12px 24px;">Batal</a>
            <button type="submit" class="btn-admin btn-primary-admin" style="padding: 12px 32px; font-size: 14px;">
                Simpan Produk &rarr;
            </button>
        </div>

    </form>
</div>

<style>
.btn-preset-img {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-preset-img:hover {
    border-color: var(--admin-accent);
    color: var(--admin-accent);
    background: #f0f9ff;
    transform: translateY(-1px);
}
.btn-chip {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 4px 10px;
    font-size: 11.5px;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-chip:hover {
    border-color: var(--admin-accent);
    color: var(--admin-accent);
    background: #f0f9ff;
    transform: translateY(-1px);
}
</style>

<script>
function previewSelectedImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('mainImagePreview').src = e.target.result;
            document.getElementById('previewLabel').innerHTML = 'Foto Baru Dipilih:<br><strong style="color: var(--admin-accent);">' + file.name + '</strong> (' + (file.size / 1024).toFixed(1) + ' KB)';
        };
        reader.readAsDataURL(file);
    }
}

function pickPresetImage(path) {
    document.getElementById('mainImagePathInput').value = path;
    document.getElementById('mainImagePreview').src = '<?= BASEURL ?>' + path;
    document.getElementById('previewLabel').innerHTML = 'Pilihan Cepat:<br><code>' + path + '</code>';
    const fileInput = document.getElementById('imageFileInput');
    if (fileInput) fileInput.value = '';
}

function updatePreviewFromPath(val) {
    if (val && val.trim() !== '') {
        const src = (val.startsWith('http://') || val.startsWith('https://')) ? val : ('<?= BASEURL ?>' + val.trim());
        document.getElementById('mainImagePreview').src = src;
        document.getElementById('previewLabel').innerHTML = 'Link Manual:<br><code style="word-break: break-all;">' + val + '</code>';
    }
}

function handleExtraImagesSelected(input) {
    if (input.files && input.files.length > 0) {
        const countText = document.getElementById('extraFilesCountText');
        if (countText) {
            countText.innerText = input.files.length + ' foto baru dipilih siap disimpan!';
        }
        const container = document.getElementById('galleryPreviewsContainer');
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const card = document.createElement('div');
                card.style.cssText = 'width: 68px; height: 68px; border-radius: 8px; border: 2px solid var(--admin-accent); background: #ffffff; padding: 4px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(2,132,199,0.15); position: relative;';
                card.innerHTML = '<img src="' + e.target.result + '" alt="New Thumb" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 4px;"><span style="position: absolute; top: -6px; right: -6px; background: var(--admin-accent); color: #fff; font-size: 9px; font-weight: 800; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">+</span>';
                container.appendChild(card);
            };
            reader.readAsDataURL(file);
        }
    }
}

// 1. Helper Tambah Tag Ukuran Cepat
function appendSizeTag(tag) {
    const input = document.getElementById('sizesInput');
    if (!input) return;
    let current = input.value.trim();
    if (!current) {
        input.value = tag;
    } else {
        const items = current.split(',').map(s => s.trim());
        if (!items.includes(tag)) {
            items.push(tag);
            input.value = items.join(', ');
        }
    }
}

// 2. Helper Varian Warna Visual
function addColorVariantRow(name = '', hex = '#e5c158') {
    const container = document.getElementById('colorVariantsList');
    if (!container) return;
    const div = document.createElement('div');
    div.className = 'color-variant-row';
    div.style.cssText = 'display: flex; gap: 10px; align-items: center; background: #ffffff; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);';
    div.innerHTML = `
        <div style="display: flex; align-items: center; gap: 8px;" title="Klik untuk ubah warna visual">
            <input type="color" name="color_hex[]" value="${hex}" style="width: 38px; height: 38px; border: 2px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 0; background: none; -webkit-appearance: none;">
        </div>
        <div style="flex: 1;">
            <input type="text" name="color_name[]" class="form-control" value="${name}" placeholder="Nama varian warna (contoh: Putih Mutiara, Gold, Pink)">
        </div>
        <button type="button" onclick="this.closest('.color-variant-row').remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 6px; border-radius: 6px; display: flex; align-items: center; justify-content: center;" title="Hapus varian ini">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    `;
    container.appendChild(div);
    const input = div.querySelector('input[type="text"]');
    if (input && !name) input.focus();
}

function addColorVariantPreset(name, hex) {
    addColorVariantRow(name, hex);
}

// 3. Helper Poin Keunggulan (Bullets)
function addBulletRow(text = '') {
    const container = document.getElementById('bulletsList');
    if (!container) return;
    const div = document.createElement('div');
    div.className = 'bullet-row';
    div.style.cssText = 'display: flex; gap: 8px; align-items: center;';
    div.innerHTML = `
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <input type="text" name="bullet_item[]" class="form-control" value="${text}" placeholder="Tulis satu poin keunggulan..." style="flex: 1;">
        <button type="button" onclick="this.closest('.bullet-row').remove()" style="background: none; border: none; color: #94a3b8; cursor: pointer; padding: 4px 8px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#94a3b8'" title="Hapus poin">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    `;
    container.appendChild(div);
    const input = div.querySelector('input[type="text"]');
    if (input && !text) input.focus();
}

function addBulletPreset(text) {
    addBulletRow(text);
}

// 4. Helper Spesifikasi Teknis
function addSpecRow(label = '', val = '') {
    const container = document.getElementById('specsList');
    if (!container) return;
    const div = document.createElement('div');
    div.className = 'spec-row';
    div.style.cssText = 'display: flex; gap: 10px; align-items: center; background: #ffffff; padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);';
    div.innerHTML = `
        <div style="flex: 1;">
            <input type="text" name="spec_label[]" class="form-control" value="${label}" placeholder="Nama Spesifikasi (misal: Jenis Mutiara)">
        </div>
        <div style="color: #94a3b8; font-weight: 700;">:</div>
        <div style="flex: 1.5;">
            <input type="text" name="spec_val[]" class="form-control" value="${val}" placeholder="Keterangan / Nilai (misal: South Sea Asli)">
        </div>
        <button type="button" onclick="this.closest('.spec-row').remove()" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 6px; border-radius: 6px; display: flex; align-items: center; justify-content: center;" title="Hapus baris spesifikasi">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    `;
    container.appendChild(div);
    const valInput = div.querySelectorAll('input[type="text"]')[1];
    const lblInput = div.querySelectorAll('input[type="text"]')[0];
    if (label && valInput) {
        valInput.focus();
    } else if (lblInput) {
        lblInput.focus();
    }
}

function addSpecPreset(label, val = '') {
    addSpecRow(label, val);
}
</script>
