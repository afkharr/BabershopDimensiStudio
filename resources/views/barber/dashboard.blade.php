
@extends('Layouts.admin.app')

@section('title', 'Dashboard Barber')

@section('content')

    {{-- Welcome Section --}}
    <section class="ds-welcome mb-4">
        <div class="ds-welcome-copy">
            <span class="ds-kicker">DIMENSI HAIR STUDIO · BARBER WORKSPACE</span>

            <h1>Ready to work<span>.</span><br>Make every cut count.</h1>

            <p>
                Selamat datang, {{ auth()->user()->name }}.
                Pantau jadwal dan aktivitas pelayananmu hari ini.
            </p>

            <div class="ds-welcome-actions">
                <a href="#" class="btn ds-btn-light">
                    <i class="bi bi-calendar2-check me-2"></i>
                    Lihat booking
                </a>

                <a href="#" class="ds-text-link">
                    Lihat jadwal
                    <i class="bi bi-arrow-up-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="ds-welcome-art" aria-hidden="true">
            <div class="ds-art-ring"></div>
            <i class="bi bi-scissors ds-art-scissors"></i>
            <span class="ds-art-word">CUT<br>WITH<br>PRECISION</span>
            <span class="ds-art-index">DS / 02</span>
        </div>

        <div class="ds-welcome-foot">
            <span>EST. DEMENSI STUDIO</span>
            <span>PERSONAL BARBER WORKSPACE</span>
        </div>
    </section>


    {{-- Section Heading --}}
    <section class="ds-section-heading">
        <div>
            <span class="ds-kicker">MY OVERVIEW</span>
            <h2>Aktivitas hari ini</h2>
            <p>Ringkasan pekerjaan dan pelayananmu hari ini.</p>
        </div>

        <span class="ds-date-chip">
            <i class="bi bi-calendar3 me-2"></i>
            <span id="barber-today"></span>
        </span>
    </section>


    {{-- Statistics --}}
    <section class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top">
                    <span>Booking hari ini</span>
                    <span class="ds-stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                </div>

                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Reservasi untukmu hari ini</div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top">
                    <span>Antrean saya</span>
                    <span class="ds-stat-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </span>
                </div>

                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Pelanggan dalam antrean</div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top">
                    <span>Selesai dilayani</span>
                    <span class="ds-stat-icon">
                        <i class="bi bi-check2-circle"></i>
                    </span>
                </div>

                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Pelayanan selesai hari ini</div>
            </article>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card ds-stat-dark">
                <div class="ds-stat-top">
                    <span>Jadwal berikutnya</span>
                    <span class="ds-stat-icon">
                        <i class="bi bi-clock"></i>
                    </span>
                </div>

                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Waktu pelayanan selanjutnya</div>
            </article>
        </div>

    </section>


    {{-- Booking and Schedule --}}
    <section class="row g-3 mb-4">

        <div class="col-12 col-xl-8">
            <div class="ds-panel h-100">

                <div class="ds-panel-heading">
                    <div>
                        <span class="ds-kicker">MY BOOKINGS</span>
                        <h3>Booking yang perlu ditangani</h3>
                        <p>Daftar reservasi pelanggan yang ditugaskan kepadamu.</p>
                    </div>

                    <span class="ds-mini-label">HARI INI</span>
                </div>

                <div class="ds-empty-state">
                    <span class="ds-empty-icon">
                        <i class="bi bi-calendar2-check"></i>
                    </span>

                    <strong>Belum ada booking</strong>

                    <small>
                        Reservasi pelanggan yang memilihmu akan muncul di sini.
                    </small>
                </div>

            </div>
        </div>


        <div class="col-12 col-xl-4">
            <div class="ds-panel h-100">

                <div class="ds-panel-heading">
                    <div>
                        <span class="ds-kicker">MY SCHEDULE</span>
                        <h3>Jadwal berikutnya</h3>
                        <p>Informasi waktu pelayananmu.</p>
                    </div>

                    <span class="ds-panel-icon">
                        <i class="bi bi-clock"></i>
                    </span>
                </div>

                <div class="ds-empty-state">
                    <span class="ds-empty-icon">
                        <i class="bi bi-calendar-week"></i>
                    </span>

                    <strong>Belum ada jadwal</strong>

                    <small>
                        Jadwal kerjamu akan ditampilkan di bagian ini.
                    </small>
                </div>

            </div>
        </div>

    </section>


    {{-- Queue Section --}}
    <section class="ds-panel mb-4">

        <div class="ds-panel-heading ds-table-heading">
            <div>
                <span class="ds-kicker">MY QUEUE</span>
                <h3>Antrean pelanggan</h3>
                <p>Pelanggan yang sedang menunggu giliran pelayananmu.</p>
            </div>

            <a href="#" class="ds-outline-link">
                Lihat antrean
                <i class="bi bi-arrow-up-right ms-1"></i>
            </a>
        </div>

        <div class="ds-empty-table">
            <i class="bi bi-ticket-perforated"></i>

            <strong>Belum ada pelanggan dalam antrean</strong>

            <span>
                Informasi antrean akan muncul setelah booking dan walk-in tercatat.
            </span>
        </div>

    </section>

@endsection


@push('scripts')
<script>
    const barberToday = document.getElementById('barber-today');

    if (barberToday) {
        barberToday.textContent = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long',
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        }).format(new Date());
    }
</script>
@endpush
