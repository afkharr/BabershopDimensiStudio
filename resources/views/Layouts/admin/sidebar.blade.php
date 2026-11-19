
<div class="mobile-overlay" id="mobile-overlay"></div>

<aside class="sidebar-wrapper" id="sidebar">

    {{-- Sidebar Brand --}}
    <a href="{{ auth()->user()->role === 'owner' ? route('admin.dashboard') : route('barber.dashboard') }}"
        class="sidebar-brand">

        <span class="brand-mark">
            <i class="bi bi-scissors"></i>
        </span>

        <span>
            DIMENSI
            <small style="display:block;color:#a6a6a6;font-size:9px;letter-spacing:2.5px;font-weight:500;">
                HAIR STUDIO · EVO
            </small>
        </span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">

        {{-- ======================================
             SIDEBAR OWNER
        ======================================= --}}
        @if(auth()->user()->role === 'owner')

            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Workspace</div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-menu-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-calendar2-check"></i>
                            <span>Booking</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Antrean</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-calendar-week"></i>
                            <span>Jadwal Barber</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Studio Data</div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-person-workspace"></i>
                            <span>Barber</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="sidebar-menu-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <i class="bi bi-shield-lock"></i>
                            <span>Akun Internal</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-scissors"></i>
                            <span>Layanan</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-people"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Insights</div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-bell"></i>
                            <span>Notifikasi</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-bar-chart-line"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                </ul>
            </div>

        @endif


        {{-- ======================================
             SIDEBAR BARBER
        ======================================= --}}
        @if(auth()->user()->role === 'barber')

            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">Workspace</div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">
                        <a href="{{ route('barber.dashboard') }}"
                            class="sidebar-menu-link {{ Request::is('barber/dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-calendar2-check"></i>
                            <span>Booking Saya</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Antrean Saya</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-calendar-week"></i>
                            <span>Jadwal Saya</span>
                        </a>
                    </li>

                </ul>
            </div>

        @endif

    </div>

    {{-- Sidebar Profile --}}
    <div class="sidebar-profile">

        <div class="profile-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
        </div>

        <div>
            <div class="sidebar-profile-name">
                {{ auth()->user()->name ?? 'Tim Demensi' }}
            </div>

            <div class="sidebar-profile-role">
                {{ ucfirst(auth()->user()->role ?? 'Studio') }}
            </div>
        </div>

    </div>

</aside>
