<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Variabel Warna Tema QuickStart */
        :root {
            --primary-color: #3b8da1;
            /* Warna tombol utama */
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
        }

        /* Container Card Login */
        .login-container {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        .login-card {
            background-color: var(--bg-color);
            padding: 250px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            text-align: center;
            border: 1px solid #edf2f7;
        }

        /* Tipografi */
        .login-card h2 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        /* Form & Input */
        form {
            text-align: left;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .label-row label {
            margin-bottom: 0;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--primary-color);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
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
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 12px 12px 42px;
            border: 2px solid var(--input-border);
            border-radius: 8px;
            font-size: 14px;
            font-family: var(--font-family);
            outline: none;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 141, 161, 0.15);
        }

        /* Ikon untuk toggle password */
        .toggle-password {
            position: absolute;
            right: 16px;
            /* Posisi di sebelah kanan */
            cursor: pointer;
            color: #a0aec0;
            font-size: 14px;
            z-index: 10;
        }

        .toggle-password:hover {
            color: var(--primary-color);
        }

        /* Tombol */
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
            transition: background-color 0.3s ease;
            margin-top: 10px;
            font-family: var(--font-family);
        }

        .login-btn:hover {
            background-color: var(--primary-hover);
        }

        /* Teks Bawah */
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

        .signup-prompt a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Log In to Your Account</h2>
            <p class="subtitle">Quickly access your dashboard and manage your projects.</p>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="text" id="email" name="email" placeholder="Email Or NIM" required>
                    </div>
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="password">Password</label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <i class="fa-solid fa-eye toggle-password" id="eyeIcon"></i>
                    </div>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="signup-prompt">Don't have an account? <a href="#">Sign Up</a></p>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        eyeIcon.addEventListener('click', function() {
            // Cek tipe input saat ini
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ganti ikon mata (eye / eye-slash)
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>