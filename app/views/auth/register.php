<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Daftar Akun | Lumina Pearl') ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>style.css">
    <style>
        body.auth-body {
            background: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            box-sizing: border-box;
        }
        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            text-decoration: none;
            color: #0284c7;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        .role-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px;
            margin-bottom: 24px;
        }
        .role-btn {
            background: transparent;
            color: #64748b;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }
        .role-btn.active {
            background: #ffffff;
            color: #0284c7;
            font-weight: 700;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px 14px;
            color: #0f172a;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }
        .btn-submit {
            width: 100%;
            background: #0284c7;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #0369a1;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        .auth-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
        }
        .auth-footer a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 700;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="auth-body">

    <div class="auth-card">
        <a href="<?= BASEURL ?>" class="auth-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
            </svg>
            <span>LUMINA PEARL</span>
        </a>

        <div class="role-tabs">
            <button type="button" class="role-btn <?= ($defaultRole ?? 'buyer') === 'buyer' ? 'active' : '' ?>" id="btnTabBuyer" onclick="switchRole('buyer')">
                Daftar Pembeli
            </button>
            <button type="button" class="role-btn <?= ($defaultRole ?? '') === 'seller' ? 'active' : '' ?>" id="btnTabSeller" onclick="switchRole('seller')">
                Buka Toko (Penjual)
            </button>
        </div>

        <?php if (!empty($error)): ?>
        <div class="alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="<?= BASEURL ?>auth/register" method="POST">
            <input type="hidden" name="role" id="roleInput" value="<?= htmlspecialchars($defaultRole ?? 'buyer') ?>">

            <!-- Khusus Penjual: Nama Toko -->
            <div id="sellerFields" style="display: <?= ($defaultRole ?? 'buyer') === 'seller' ? 'block' : 'none' ?>;">
                <div class="form-group">
                    <label for="store_name">Nama Toko *</label>
                    <input type="text" id="store_name" name="store_name" class="form-control" placeholder="Misal: Samudra Mutiara Indah" value="<?= htmlspecialchars($_POST['store_name'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="store_description">Deskripsi Singkat Toko</label>
                    <textarea id="store_description" name="store_description" class="form-control" rows="2" placeholder="Jelaskan produk kerajinan/mutiara yang Anda jual..."><?= htmlspecialchars($_POST['store_description'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="name" id="nameLabel">Nama Lengkap *</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Masukkan nama Anda" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="email">Alamat Email *</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="nama@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="phone">Nomor Telepon / WhatsApp</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="0812-xxxx-xxxx" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="address">Alamat Pengiriman</label>
                <textarea id="address" name="address" class="form-control" rows="2" placeholder="Nama jalan, nomor rumah, kota..."><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi (Min. 6 Karakter) *</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Buat kata sandi aman">
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <?= ($defaultRole ?? 'buyer') === 'seller' ? 'Buka Toko Sekarang &rarr;' : 'Daftar Akun Pembeli &rarr;' ?>
            </button>
        </form>

        <div class="auth-footer">
            Sudah memiliki akun? <a href="<?= BASEURL ?>auth/login">Masuk ke Sini</a>
        </div>

        <a href="<?= BASEURL ?>" style="display: block; text-align: center; margin-top: 14px; color: #94a3b8; font-size: 13px; text-decoration: none;">&larr; Kembali ke Beranda</a>
    </div>

    <script>
        function switchRole(role) {
            document.getElementById('roleInput').value = role;
            const btnBuyer = document.getElementById('btnTabBuyer');
            const btnSeller = document.getElementById('btnTabSeller');
            const sellerFields = document.getElementById('sellerFields');
            const submitBtn = document.getElementById('submitBtn');
            const nameLabel = document.getElementById('nameLabel');

            if (role === 'seller') {
                btnSeller.classList.add('active');
                btnBuyer.classList.remove('active');
                sellerFields.style.display = 'block';
                submitBtn.innerText = 'Buka Toko Sekarang →';
                nameLabel.innerText = 'Nama Pemilik Toko *';
            } else {
                btnBuyer.classList.add('active');
                btnSeller.classList.remove('active');
                sellerFields.style.display = 'none';
                submitBtn.innerText = 'Daftar Akun Pembeli →';
                nameLabel.innerText = 'Nama Lengkap *';
            }
        }
    </script>

</body>
</html>
