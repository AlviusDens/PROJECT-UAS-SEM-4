<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Den Project</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3b8da1;
            --primary-hover: #2d6b7a;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --bg-color: #ffffff;
            --body-bg: #f8fafc;
            --input-border: #e2e8f0;
            --input-focus: #3b8da1;
            --font-family: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--body-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-dark);
            padding: 40px 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        /* Diperkecil lebarnya agar lebih pas untuk satu kolom */

        .login-card {
            background-color: var(--bg-color);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #edf2f7;
            text-align: center;
        }

        .login-card h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: #a0aec0;
            font-size: 14px;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 42px;
            border: 2px solid var(--input-border);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 141, 161, 0.15);
        }

        .toggle-password {
            left: auto !important;
            right: 16px;
            cursor: pointer;
            pointer-events: auto !important;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        .signup-prompt {
            margin-top: 25px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .signup-prompt a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Buat Akun Baru</h2>
            <p class="subtitle">Daftar sekarang untuk mulai meminjam buku.</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" name="email" placeholder="email@contoh.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>NIM</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-id-card"></i>
                        <input type="text" name="nim" placeholder="NIM Mahasiswa" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Jurusan</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <input type="text" name="jurusan" placeholder="Contoh: Informatika" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Semester</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-list-ol"></i>
                        <input type="number" name="semester" placeholder="Semester (1-14)" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Minimal 6 Karakter" required>
                        <i class="fa-solid fa-eye toggle-password" id="eyeIcon"></i>
                    </div>
                </div>

                <button type="submit" class="login-btn">Buat Akun</button>
            </form>

            <p class="signup-prompt">Sudah punya akun? <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>