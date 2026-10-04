<div class="container" style="padding: 40px 20px 80px 20px; max-width: 840px; margin: 0 auto; min-height: 75vh;">

    <!-- HEADER / USER GREETING & TABS -->
    <div style="margin-bottom: 28px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
        <div>
            <div style="font-size: 12px; font-weight: 700; color: #0284c7; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px;">
                Akun Pembeli Lumina
            </div>
            <h1 style="margin: 0 0 6px 0; font-size: 26px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">
                Profil & Alamat Pengiriman
            </h1>
            <p style="margin: 0; color: #64748b; font-size: 14px;">
                Kelola informasi identitas akun Anda dan alamat pengiriman default saat checkout.
            </p>
        </div>

        <!-- TABS -->
        <div style="display: flex; gap: 8px; background: #ffffff; padding: 5px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
            <a href="<?= BASEURL ?>user/orders" style="padding: 8px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 600; text-decoration: none; color: #64748b; transition: all 0.2s;">
                Pesanan Saya
            </a>
            <a href="<?= BASEURL ?>user/profile" style="padding: 8px 16px; border-radius: 8px; font-size: 13.5px; font-weight: 700; text-decoration: none; background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd;">
                Profil & Alamat
            </a>
        </div>
    </div>

    <!-- FLASH MESSAGES -->
    <?php if (!empty($_SESSION['flash_message'])): ?>
    <div style="padding: 14px 18px; border-radius: 10px; font-size: 14px; margin-bottom: 24px; background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; display: flex; align-items: center; gap: 10px;">
        <span>&#10004;</span>
        <span><?= htmlspecialchars($_SESSION['flash_message']) ?></span>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <!-- PROFILE FORM -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 32px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
        <form action="<?= BASEURL ?>user/profile" method="POST" style="display: flex; flex-direction: column; gap: 24px;">
            
            <div class="user-profile-grid">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Nama Lengkap *
                    </label>
                    <input type="text" name="name" required value="<?= htmlspecialchars($user['name'] ?? '') ?>" style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 11px 14px; color: #0f172a; font-size: 14px; outline: none; font-family: inherit;">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Alamat Email (Login)
                    </label>
                    <input type="email" disabled value="<?= htmlspecialchars($user['email'] ?? '') ?>" style="width: 100%; box-sizing: border-box; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 11px 14px; color: #64748b; font-size: 14px; cursor: not-allowed; font-family: inherit;">
                    <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Email terdaftar sebagai ID unik akun Anda.</span>
                </div>
            </div>

            <div class="user-profile-grid">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Nomor Handphone / WhatsApp
                    </label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Misal: 081234567890" style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 11px 14px; color: #0f172a; font-size: 14px; outline: none; font-family: inherit;">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                        Status Akun
                    </label>
                    <div style="display: flex; align-items: center; gap: 10px; height: 46px;">
                        <span style="background: #f0fdf4; color: #166534; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px; border: 1px solid #bbf7d0;">
                            ● Pembeli Aktif
                        </span>
                        <a href="<?= BASEURL ?>auth/logout" style="color: #ef4444; font-size: 12.5px; text-decoration: none; font-weight: 500;">
                            Keluar Akun
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 8px;">
                    Alamat Pengiriman Utama (Default Alamat Checkout)
                </label>
                <textarea name="address" rows="4" placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, dan kode pos untuk pengiriman paket..." style="width: 100%; box-sizing: border-box; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 12px 14px; color: #0f172a; font-size: 14px; line-height: 1.5; outline: none; font-family: inherit;"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                <span style="font-size: 11.5px; color: #64748b; margin-top: 4px; display: block;">Alamat ini otomatis terisi saat Anda menekan tombol Beli Sekarang atau Checkout Keranjang.</span>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 20px; margin-top: 8px; flex-wrap: wrap; gap: 14px;">
                <div style="font-size: 13px; color: #64748b;">
                    Ingin berjualan perhiasan mutiara? <a href="<?= BASEURL ?>auth/register" style="color: #0284c7; font-weight: 600; text-decoration: none;">Daftar sebagai Penjual &rarr;</a>
                </div>

                <button type="submit" style="background: #0284c7; color: #ffffff; border: none; padding: 12px 28px; font-size: 14px; font-weight: 700; border-radius: 8px; cursor: pointer; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);">
                    Simpan Perubahan Profil
                </button>
            </div>

        </form>
    </div>

</div>
