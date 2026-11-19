
<header class="navbar-custom">
    <div class="navbar-left">
        <button class="sidebar-toggle-btn d-xl-none" id="sidebar-toggle" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>

        <span class="date-label d-none d-sm-inline">
            <i class="bi bi-calendar3 me-1"></i>
            <span id="current-date">Demensi Studio</span>
        </span>
    </div>

    <div class="navbar-search-wrapper">
        <input
            type="text"
            class="navbar-search-input"
            id="dashboard-search"
            placeholder="Cari booking atau pelanggan...">

        <button class="navbar-search-btn" type="button" aria-label="Cari">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <div class="navbar-actions">
        <a href="#" class="navbar-action-btn position-relative" aria-label="Notifikasi">
            <i class="bi bi-bell"></i>
        </a>

        <div class="dropdown">
            <button
                class="navbar-profile-btn dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <span class="profile-avatar" style="width:27px;height:27px;font-size:11px;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
                </span>

                <span class="d-none d-md-inline">
                    {{ auth()->user()->name ?? 'Tim Demensi' }}
                </span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                <li>
                    <span class="dropdown-item-text small text-muted">
                        {{ ucfirst(auth()->user()->role ?? 'Studio') }}
                    </span>
                </li>

                <li>
                    <a class="dropdown-item small" href="#">
                        <i class="bi bi-gear me-2"></i>Pengaturan
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                {{-- Logout --}}
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="dropdown-item small text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
