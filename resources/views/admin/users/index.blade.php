
@extends('Layouts.admin.app')

@section('title', 'Akun Internal')

@push('styles')
    <style>
        .user-page {
            --u-ink: #171717;
            --u-muted: #858585;
            --u-line: #e9e9e6;
            --u-soft: #f6f6f4;
            color: var(--u-ink)
        }

        .user-page .user-hero {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px
        }

        .user-page .user-eyebrow {
            font-size: .66rem;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: #888
        }

        .user-page .user-title {
            font-size: clamp(1.65rem, 3vw, 2.15rem);
            font-weight: 850;
            letter-spacing: -.055em;
            margin: 6px 0 5px
        }

        .user-page .user-subtitle {
            margin: 0;
            color: var(--u-muted);
            font-size: .86rem
        }

        .user-page .user-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            background: #171717;
            color: #fff;
            border: 1px solid #171717;
            border-radius: 9px;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 750;
            transition: .2s
        }

        .user-page .user-primary:hover {
            background: #3a3a3a;
            color: #fff;
            transform: translateY(-1px)
        }

        .user-page .user-stat {
            height: 100%;
            padding: 17px 19px;
            background: #fff;
            border: 1px solid var(--u-line);
            border-radius: 13px
        }

        .user-page .user-stat-label {
            color: #888;
            font-size: .73rem;
            font-weight: 650
        }

        .user-page .user-stat-value {
            font-size: 1.8rem;
            line-height: 1.2;
            font-weight: 850;
            letter-spacing: -.06em;
            margin-top: 8px
        }

        .user-page .user-stat-icon {
            float: right;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #f0f0ee;
            display: grid;
            place-items: center;
            color: #333
        }

        .user-page .user-panel {
            background: #fff;
            border: 1px solid var(--u-line);
            border-radius: 14px;
            overflow: hidden
        }

        .user-page .user-panel-head {
            padding: 19px 21px;
            border-bottom: 1px solid var(--u-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px
        }

        .user-page .user-panel-head h2 {
            font-size: .98rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -.025em
        }

        .user-page .user-panel-head p {
            font-size: .73rem;
            color: #999;
            margin: 4px 0 0
        }

        .user-page .user-filter {
            padding: 16px 21px;
            background: #fcfcfb;
            border-bottom: 1px solid var(--u-line)
        }

        .user-page .form-control,
        .user-page .form-select {
            min-height: 40px;
            border-color: #e4e4e1;
            border-radius: 8px;
            font-size: .8rem;
            box-shadow: none
        }

        .user-page .form-control:focus,
        .user-page .form-select:focus {
            border-color: #999;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, .045)
        }

        .user-page .user-search-btn {
            height: 40px;
            padding: 0 14px;
            border: 0;
            border-radius: 8px;
            background: #171717;
            color: #fff;
            font-size: .78rem;
            font-weight: 700
        }

        .user-page .user-reset {
            display: inline-flex;
            align-items: center;
            height: 40px;
            padding: 0 13px;
            border: 1px solid #e2e2df;
            border-radius: 8px;
            color: #555;
            text-decoration: none;
            font-size: .78rem
        }

        .user-page .table {
            margin: 0;
            vertical-align: middle
        }

        .user-page .table thead th {
            padding: 12px 15px;
            background: #fafaf9;
            border-bottom: 1px solid var(--u-line);
            color: #888;
            font-size: .65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            white-space: nowrap
        }

        .user-page .table tbody td {
            padding: 14px 15px;
            border-color: #f0f0ed;
            font-size: .78rem;
            color: #555
        }

        .user-page .user-person {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 180px
        }

        .user-page .user-avatar {
            width: 37px;
            height: 37px;
            flex: 0 0 37px;
            border-radius: 11px;
            background: #171717;
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: .8rem
        }

        .user-page .user-person strong {
            display: block;
            color: #222;
            font-size: .79rem;
            font-weight: 750
        }

        .user-page .user-person small {
            display: block;
            color: #999;
            font-size: .68rem;
            margin-top: 2px
        }

        .user-page .role-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 99px;
            background: #f1f1ef;
            color: #333;
            font-size: .67rem;
            font-weight: 750
        }

        .user-page .role-pill:before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #333
        }

        .user-page .role-pill.barber {
            background: #f5f5f5;
            color: #666
        }

        .user-page .role-pill.barber:before {
            background: #999
        }

        .user-page .user-action {
            width: 32px;
            height: 32px;
            display: inline-grid;
            place-items: center;
            border: 1px solid #e7e7e4;
            border-radius: 8px;
            background: #fff;
            color: #555;
            text-decoration: none
        }

        .user-page .user-action:hover {
            background: #171717;
            border-color: #171717;
            color: #fff
        }

        .user-page .user-action.delete:hover {
            background: #fff1f1;
            border-color: #f0d1d1;
            color: #b42318
        }

        .user-page .user-empty {
            padding: 55px 20px;
            text-align: center
        }

        .user-page .user-empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f1ef;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            color: #555
        }

        .user-page .user-empty strong {
            display: block;
            font-size: .85rem
        }

        .user-page .user-empty p {
            margin: 5px 0 0;
            color: #999;
            font-size: .74rem
        }

        .user-page .user-pagination {
            padding: 15px 20px;
            border-top: 1px solid var(--u-line)
        }

        .user-page .pagination {
            margin: 0;
            justify-content: flex-end
        }

        .user-page .page-link {
            font-size: .75rem;
            color: #333;
            border-color: #e7e7e4
        }

        .user-page .page-item.active .page-link {
            background: #171717;
            border-color: #171717
        }

        @media(max-width:767px) {
            .user-page .user-hero {
                align-items: flex-start;
                flex-direction: column
            }

            .user-page .user-panel-head {
                align-items: flex-start;
                flex-direction: column
            }

            .user-page .user-filter {
                padding: 14px
            }
        }
    </style>
@endpush

@section('content')
    <div class="user-page">
        <section class="user-hero">
            <div>
                <div class="user-eyebrow">Studio data / Access management</div>
                <h1 class="user-title">Akun Internal</h1>
                <p class="user-subtitle">Kelola akun owner dan barber yang memiliki akses ke dashboard Demensi Studio.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="user-primary"><i class="bi bi-plus-lg"></i> Tambah Akun</a>
        </section>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">{{ session('success') }}<button
                    type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">{{ session('error') }}<button
                    type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-4">
                <div class="user-stat"><span class="user-stat-icon"><i class="bi bi-people"></i></span>
                    <div class="user-stat-label">Total akun internal</div>
                    <div class="user-stat-value">{{ $totalUsers }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="user-stat"><span class="user-stat-icon"><i class="bi bi-shield-check"></i></span>
                    <div class="user-stat-label">Owner</div>
                    <div class="user-stat-value">{{ $totalOwners }}</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="user-stat"><span class="user-stat-icon"><i class="bi bi-scissors"></i></span>
                    <div class="user-stat-label">Barber</div>
                    <div class="user-stat-value">{{ $totalBarbers }}</div>
                </div>
            </div>
        </div>

        <section class="user-panel">
            <div class="user-panel-head">
                <div>
                    <h2>Daftar akun</h2>
                    <p>Informasi akun yang dapat masuk ke sistem.</p>
                </div>
                <span class="small text-muted">{{ $users->total() }} akun terdaftar</span>
            </div>
            <form method="GET" action="{{ route('admin.users.index') }}" class="user-filter">
                <div class="row g-2">
                    <div class="col-lg-6"><input type="search" name="q" value="{{ request('q') }}" class="form-control"
                            placeholder="Cari nama, email, atau nomor HP..."></div>
                    <div class="col-sm-6 col-lg-3"><select name="role" class="form-select">
                            <option value="">Semua peran</option>
                            <option value="owner" @selected(request('role') === 'owner')>Owner</option>
                            <option value="barber" @selected(request('role') === 'barber')>Barber</option>
                        </select></div>
                    <div class="col-sm-6 col-lg-3 d-flex gap-2"><button class="user-search-btn" type="submit"><i
                                class="bi bi-search me-1"></i>
                            Cari</button>@if(request()->filled('q') || request()->filled('role'))<a
                            href="{{ route('admin.users.index') }}" class="user-reset">Reset</a>@endif</div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama akun</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Peran</th>
                            <th>Dibuat</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="user-person">
                                        <div class="user-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                                        <div><strong>{{ $user->name }}</strong><small>ID akun #{{ $user->id }}</small></div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?: '—' }}</td>
                                <td><span
                                        class="role-pill {{ $user->role === 'barber' ? 'barber' : '' }}">{{ $user->role === 'owner' ? 'Owner' : 'Barber' }}</span>
                                </td>
                                <td>{{ $user->created_at?->format('d M Y') ?? '—' }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="user-action" title="Edit akun">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    <button type="button" class="user-action delete ms-1" title="Hapus akun"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                        data-user-name="{{ $user->name }}"
                                        data-delete-url="{{ route('admin.users.destroy', $user) }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="user-empty">
                                        <div class="user-empty-icon"><i class="bi bi-person-lock"></i></div><strong>Belum ada
                                            akun ditemukan</strong>
                                        <p>Tambahkan akun owner atau barber, atau ubah kata kunci pencarian.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
            <div class="user-pagination">{{ $users->links('pagination::bootstrap-5') }}</div>@endif
        </section>

        {{-- Modal Konfirmasi Hapus --}}
        <div class="modal fade" id="deleteUserModal" tabindex="-1"
            aria-labelledby="deleteUserModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-body p-4 text-center">

                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light"
                                style="width: 65px; height: 65px;">
                                <i class="bi bi-trash3 fs-3 text-dark"></i>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2" id="deleteUserModalLabel">
                            Hapus Akun?
                        </h5>

                        <p class="text-muted small mb-4">
                            Apakah kamu yakin ingin menghapus akun
                            <strong id="deleteUserName" class="text-dark"></strong>?
                            Data akun yang dihapus tidak dapat dikembalikan.
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-light border px-4"
                                data-bs-dismiss="modal">
                                Batal
                            </button>

                            <form id="deleteUserForm" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-dark px-4">
                                    <i class="bi bi-trash3 me-1"></i>
                                    Ya, Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteUserModal');

            if (!deleteModal) {
                return;
            }

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                const userName = button.getAttribute('data-user-name');
                const deleteUrl = button.getAttribute('data-delete-url');

                document.getElementById('deleteUserName').textContent = userName;
                document.getElementById('deleteUserForm').action = deleteUrl;
            });
        });
    </script>
@endpush
