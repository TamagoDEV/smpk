<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Snacked</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
            <li class="menu-label">Master Menu</li>
            <li>
                <a href="{{ route('users.index') }}">
                    <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="menu-title">Users</div>
                </a>
            </li>
        @endif
        <li class="menu-label">Main Menu</li>
        @if (Auth::user()->role === 'admin' ||
                Auth::user()->role === 'superadmin' ||
                Auth::user()->role === 'kepala_bidang' ||
                Auth::user()->role === 'sub_bagian_approval')
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
                    </div>
                    <div class="menu-title">Surat Masuk</div>
                </a>
                <ul>
                    <li> <a href="{{ route('surat-masuk/peliputan') }}"><i class="bi bi-circle"></i>Peliputan</a>
                    </li>
                    <li> <a href="{{ route('surat-masuk/iklan') }}"><i class="bi bi-circle"></i>Iklan</a>
                    </li>
                    <li> <a href="{{ route('approved-surat') }}"><i class="bi bi-circle"></i>Data Approved Surat</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin' || Auth::user()->role === 'reporter')
            <li>
                <a href="{{ route('jadwal-reporter') }}">
                    <div class="parent-icon"><i class="bi bi-calendar"></i></div>
                    <div class="menu-title">Jadwal Reporter</div>
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route('berita.index') }}">
                <div class="parent-icon"><i class="lni lni-blogger"></i></div>
                <div class="menu-title">Daftar Berita</div>
            </a>
        </li>
        @if (Auth::user()->role === 'admin' ||
                Auth::user()->role === 'superadmin' ||
                Auth::user()->role === 'kepala_bidang' ||
                Auth::user()->role === 'sub_bagian_approval')
            <li>
                <a href="{{ route('pelaporan.index') }}">
                    <div class="parent-icon"><i class="bi bi-book"></i></div>
                    <div class="menu-title">Pelaporan</div>
                </a>
            </li>
        @endif
        <!--end navigation-->
</aside>
