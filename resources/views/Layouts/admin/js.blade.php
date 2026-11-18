    <!-- Core -->
    <script src="{{ asset('assets-admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets-admin/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        // Menampilkan tanggal hari ini pada navbar.
        const dateElement = document.getElementById('current-date');
        if (dateElement) {
            dateElement.textContent = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long', day: '2-digit', month: 'long', year: 'numeric'
            }).format(new Date());
        }

        // Buka/tutup sidebar pada perangkat mobile.
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);
    </script>
    @stack('scripts')
