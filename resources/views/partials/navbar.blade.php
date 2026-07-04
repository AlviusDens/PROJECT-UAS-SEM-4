<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <nav id="navmenu" class="navmenu me-4">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">Home</a></li>

                @if(session()->has('user_role'))
                <li><a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                @endif

                <li><a href="{{ route('koleksi.rilis_baru') }}" class="{{ Request::is('rilis-baru') ? 'active' : '' }}">Rilis Baru</a></li>

                <li><a href="{{ route('koleksi.terpopuler') }}" class="{{ Request::is('download-terpopuler') ? 'active' : '' }}">Download Terpopuler</a></li>

                <li><a href="{{ route('koleksi.pengarang') }}" class="{{ Request::is('pengarang') ? 'active' : '' }}">Pengarang</a></li>

                @if(session('user_role') == 'member')
                <li><a href="{{ route('library.index') }}" class="{{ Request::is('library') ? 'active' : '' }}">Library</a></li>
                @endif

                @if(session('user_role') == 'petugas')
                <li><a href="{{ route('library.index') }}" class="{{ Request::is('library') ? 'active' : '' }}">Kelola Buku & Bacaan</a></li>
                @endif

                @if(session('user_role') == 'admin')
                <li><a href="{{ route('pengguna.index') }}" class="{{ Request::is('daftar_pengguna') ? 'active' : '' }}">Manajemen Petugas</a></li>
                @endif

                @if(session('user_role') == 'petugas')
                <li><a href="{{ route('pengguna.index') }}" class="{{ Request::is('daftar_pengguna') ? 'active' : '' }}">Manajemen Member</a></li>
                @endif

                <li><a href="{{ route('contact_us') }}" class="{{ Request::is('contact-us') ? 'active' : '' }}">Contact Us</a></li>

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex align-items-center gap-2">
            @if(session()->has('user_role'))
            <div class="profile-nav d-flex align-items-center me-2">
                <div class="d-none d-md-block text-end me-2">
                    <span class="d-block fw-bold" style="font-size: 14px;">{{ session('user_nama') }}</span>
                    <small class="text-muted" style="font-size: 11px;">{{ ucfirst(session('user_role')) }}</small>
                </div>
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&h=150" alt="Profile" class="rounded-circle profile-avatar">
            </div>

            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1 shadow-sm"
                onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-sm-inline">Logout</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1 shadow-sm px-3">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 shadow-sm px-3">
                <i class="bi bi-person-plus"></i>
                <span>Register</span>
            </a>
            @endif
        </div>

    </div>
</header>