<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Masuk Akun | Lumina Pearl') ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>style.css">
    <style>
        body.auth-body {
            background: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .auth-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            max-width: 440px;
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
        .auth-title {
            text-align: center;
            font-size: 22px;
            color: #0f172a;
            font-weight: 800;
            margin: 0 0 6px 0;
        }
        .auth-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13.5px;
            margin: 0 0 24px 0;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 16px;
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
            transition: background 0.2s, transform 0.1s;
            margin-top: 8px;
        }
        .btn-submit:hover {
            background: #0369a1;
            transform: translateY(-1px);
        }
        .alert-box {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }
        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #059669;
        }
        .auth-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        .auth-footer a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 700;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .demo-accounts {
            margin-top: 20px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 12px;
            color: #475569;
        }
        .demo-btn {
            background: #e2e8f0;
            color: #0284c7;
            border: none;
            border-radius: 4px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            margin-left: 6px;
            transition: background 0.2s;
        }
        .demo-btn:hover {
            background: #cbd5e1;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
        }
        .back-link:hover {
            color: #0284c7;
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

        <h1 class="auth-title">Selamat Datang</h1>
        <p class="auth-subtitle">Masuk sebagai Penjual atau Pembeli</p>

        <?php if (!empty($error)): ?>
        <div class="alert-box alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert-box alert-error">
            <?= htmlspecialchars($_SESSION['flash_error']) ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_message'])): ?>
        <div class="alert-box alert-success">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

        <form action="<?= BASEURL ?>auth/login" method="POST">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required autofocus value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" class="btn-submit">Masuk Sekarang &rarr;</button>
        </form>

        <div class="demo-accounts">
            <div style="font-weight: 600; color: #cbd5e1; margin-bottom: 6px;">Akun Coba Cepat:</div>
            <div style="margin-bottom: 4px; display: flex; justify-content: space-between; align-items: center;">
                <span>Mitra Penjual: seller@lumina.com</span>
                <button type="button" class="demo-btn" onclick="fillLogin('seller@lumina.com', 'seller123')">Isi</button>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>Pembeli: buyer@lumina.com</span>
                <button type="button" class="demo-btn" onclick="fillLogin('buyer@lumina.com', 'buyer123')">Isi</button>
            </div>
        </div>

        <div class="auth-footer">
            Belum punya akun? <a href="<?= BASEURL ?>auth/register">Daftar Akun Baru</a>
        </div>

        <a href="<?= BASEURL ?>" class="back-link">&larr; Kembali ke Beranda Katalog</a>
    </div>

    <script>
        function fillLogin(email, pass) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }
    </script>

</body>
</html>
