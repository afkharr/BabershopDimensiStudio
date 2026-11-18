@extends('Layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    <section class="ds-welcome mb-4">
        <div class="ds-welcome-copy">
            <span class="ds-kicker">DIMENSI HAIR STUDIO · MANAGEMENT</span>
            <h1>Good day<span>.</span><br>Let’s keep the studio in shape.</h1>
            <p>Kelola booking, antrean, dan aktivitas Demensi Studio dari satu tempat.</p>
            <div class="ds-welcome-actions">
                <a href="#" class="btn ds-btn-light"><i class="bi bi-calendar-plus me-2"></i>Booking baru</a>
                <a href="#" class="ds-text-link">Lihat jadwal <i class="bi bi-arrow-up-right ms-1"></i></a>
            </div>
        </div>
        <div class="ds-welcome-art" aria-hidden="true">
            <div class="ds-art-ring"></div>
            <i class="bi bi-scissors ds-art-scissors"></i>
            <span class="ds-art-word">CUT<br>WITH<br>PRECISION</span>
            <span class="ds-art-index">DS / 01</span>
        </div>
        <div class="ds-welcome-foot"><span>EST. DEMENSI STUDIO</span><span>BOOKING & QUEUE MANAGEMENT</span></div>
    </section>

    <section class="ds-section-heading">
        <div>
            <span class="ds-kicker">OVERVIEW</span>
            <h2>Ringkasan aktivitas</h2>
            <p>Gambaran singkat operasional studio hari ini.</p>
        </div>
        <span class="ds-date-chip"><i class="bi bi-calendar3 me-2"></i><span id="ds-today"></span></span>
    </section>

    <section class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top"><span>Booking hari ini</span><span class="ds-stat-icon"><i class="bi bi-calendar-check"></i></span></div>
                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Total reservasi terjadwal</div>
            </article>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top"><span>Dalam antrean</span><span class="ds-stat-icon"><i class="bi bi-ticket-perforated"></i></span></div>
                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Booking dan walk-in</div>
            </article>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card">
                <div class="ds-stat-top"><span>Selesai dilayani</span><span class="ds-stat-icon"><i class="bi bi-check2"></i></span></div>
                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Layanan selesai hari ini</div>
            </article>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="ds-stat-card ds-stat-dark">
                <div class="ds-stat-top"><span>Barber aktif</span><span class="ds-stat-icon"><i class="bi bi-person-workspace"></i></span></div>
                <div class="ds-stat-number">—</div>
                <div class="ds-stat-bottom">Barber dengan jadwal aktif</div>
            </article>
        </div>
    </section>

    <section class="row g-3 mb-4">
        <div class="col-12 col-xl-8">
            <div class="ds-panel h-100">
                <div class="ds-panel-heading">
                    <div><span class="ds-kicker">ACTIVITY</span><h3>Aktivitas booking</h3><p>Grafik booking akan tampil setelah data terhubung.</p></div>
                    <span class="ds-mini-label">7 HARI TERAKHIR</span>
                </div>
                <div class="ds-chart-placeholder"><div class="ds-chart-lines"><span></span><span></span><span></span><span></span></div><div class="ds-chart-empty"><i class="bi bi-bar-chart-line"></i><strong>Belum ada data aktivitas</strong><small>Grafik akan otomatis terisi ketika booking mulai tercatat.</small></div></div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="ds-panel h-100">
                <div class="ds-panel-heading"><div><span class="ds-kicker">TODAY</span><h3>Jadwal berikutnya</h3><p>Antrean yang perlu diperhatikan.</p></div><span class="ds-panel-icon"><i class="bi bi-clock"></i></span></div>
                <div class="ds-empty-state"><span class="ds-empty-icon"><i class="bi bi-calendar2-week"></i></span><strong>Belum ada jadwal</strong><small>Booking pelanggan akan muncul di bagian ini.</small></div>
            </div>
        </div>
    </section>

    <section class="ds-panel mb-4">
        <div class="ds-panel-heading ds-table-heading">
            <div><span class="ds-kicker">LATEST RESERVATIONS</span><h3>Booking terbaru</h3><p>Daftar reservasi online dan pelanggan walk-in.</p></div>
            <a href="#" class="ds-outline-link">Semua booking <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
        <div class="ds-empty-table"><i class="bi bi-inbox"></i><strong>Belum ada booking yang tercatat</strong><span>Data reservasi akan ditampilkan di sini setelah fitur booking aktif.</span></div>
    </section>
@endsection

@push('scripts')
<script>
    const dsToday = document.getElementById('ds-today');
    if (dsToday) {
        dsToday.textContent = new Intl.DateTimeFormat('id-ID', {
            weekday: 'long', day: '2-digit', month: 'long', year: 'numeric'
        }).format(new Date());
    }
</script>
@endpush
