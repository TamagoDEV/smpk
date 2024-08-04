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

        <li class="menu-label">Master Menu</li>
        <li>
            <a href="{{ route('users.index') }}">
                <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
                <div class="menu-title">Users</div>
            </a>
        </li>
        <li class="menu-label">Main Menu</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
                </div>
                <div class="menu-title">Surat</div>
            </a>
            <ul>
                <li> <a href="{{ route('surat-masuk') }}"><i class="bi bi-circle"></i>Surat Masuk</a>
                </li>
                <li> <a href="{{ route('jadwal-reporter') }}"><i class="bi bi-circle"></i>Jadwal Reporter</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('berita.index') }}">
                <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
                <div class="menu-title">Daftar Berita</div>
            </a>
        </li>

        <!--end navigation-->
</aside>
