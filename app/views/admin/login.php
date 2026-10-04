<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Login Admin | Lumina Pearl') ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body.admin-login-body {
            background: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            position: relative;
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 24px;
            text-decoration: none;
            color: #0f172a;
            font-weight: 800;
            font-size: 19px;
            letter-spacing: 0.5px;
        }
        .login-title {
            text-align: center;
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 6px 0;
        }
        .login-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13.5px;
            margin: 0 0 28px 0;
        }
        .form-group {
            margin-bottom: 20px;
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
            font-family: inherit;
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
            padding: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 10px;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);
        }
        .btn-submit:hover {
            background: #0369a1;
            transform: translateY(-1px);
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }
        .credentials-tip {
            margin-top: 24px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            font-size: 12px;
            color: #64748b;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #0284c7;
        }
    </style>
</head>
<body class="admin-login-body">

    <div class="login-card">
        <a href="<?= BASEURL ?>" class="login-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0284c7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2C6.5 2 2 6.5 2 12c0 4 2.5 7.5 6 9 1 .5 2 .8 4 .8s3-.3 4-.8c3.5-1.5 6-5 6-9 0-5.5-4.5-10-10-10z"></path>
                <circle cx="12" cy="13" r="3.5" fill="#0284c7"></circle>
            </svg>
            <span>LUMINA ADMIN</span>
        </a>

        <h1 class="login-title">Masuk ke Panel</h1>
        <p class="login-subtitle">Akses sistem manajemen produk dan pesanan</p>

        <?php if (!empty($error)): ?>
        <div class="alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="<?= BASEURL ?>admin/login" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required autofocus value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-submit">Masuk ke Dashboard &rarr;</button>
        </form>

        <div class="credentials-tip">
            Akun Default: <strong>admin</strong> &bull; Sandi: <strong>admin123</strong>
        </div>

        <a href="<?= BASEURL ?>" class="back-link">&larr; Kembali ke Katalog Toko</a>
    </div>

</body>
</html>
