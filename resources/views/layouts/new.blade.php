<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Den Project</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/quickstart/assets/img/favicon.png" rel="icon">
    <link href="/quickstart/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/quickstart/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/quickstart/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/quickstart/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/quickstart/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/quickstart/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/quickstart/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        /* Membuat Navbar transparan dengan efek Blur (Glassmorphism) */
        .header {
            background: rgba(255, 255, 255, 0.8) !important;
            /* Putih transparan */
            backdrop-filter: blur(10px);
            /* Efek blur kaca */
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        /* Styling Profil ala GitHub */
        .profile-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .profile-nav:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .profile-nav span {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .profile-avatar {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        /* Agar logo dan navmenu punya jarak yang pas */
        .header .container-xl {
            display: flex;
            justify-content: space-between;
        }
    </style>

</head>

<body class="d-flex flex-column min-vh-100">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <nav id="navmenu" class="navmenu me-4">
                <ul>
                    <li><a href="/home" class="{{ Request::is('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                    <li><a href="/daftar_pengguna" class="{{ Request::is('daftar_pengguna') ? 'active' : '' }}">Daftar Pengguna</a></li>
                    <li><a href="/library" class="{{ Request::is('library') ? 'active' : '' }}">Library</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="d-flex align-items-center gap-3">
                <div class="profile-nav d-flex align-items-center">
                    <div class="d-none d-md-block text-end me-2">
                        <span class="d-block fw-bold" style="font-size: 14px;">{{ session('user_nama') }}</span>
                        <small class="text-muted" style="font-size: 11px;">{{ ucfirst(session('user_role')) }}</small>
                    </div>
                    <img src="..." alt="Profile" class="rounded-circle profile-avatar">
                </div>

                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1 shadow-sm"
                    onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="d-none d-sm-inline">Logout</span>
                </a>
            </div>

        </div>
    </header>

    <main class="main flex-grow-1" style="padding-top: 100px;" data-aos="fade-up" data-aos-duration="1000">
        @yield('content')
    </main>

    <footer id="footer" style="margin-top: 100px;" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Latihan</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>alvius.jdk3@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">QuickStart</strong><span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | <a href="https://bootstrapmade.com/tools/">DevTools</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="/quickstart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/quickstart/assets/vendor/php-email-form/validate.js"></script>
    <script src="/quickstart/assets/vendor/aos/aos.js"></script>
    <script src="/quickstart/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/quickstart/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="/quickstart/assets/js/main.js"></script>

</body>

</html>