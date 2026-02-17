    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('assets')}}/js/jquery.min.js"></script>
	<script src="{{ asset('assets')}}/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('assets')}}/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
	<!--app JS-->
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets')}}/js/jquery.min.js"></script>
	<script src="{{ asset('assets')}}/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('assets')}}/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
	<!--app JS-->
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
	<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/dev.js') }}"></script>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif
    @if(Session::has('success'))
            <script>
                toastr.success("{{ Session::get('success') }}");
            </script>
            {{ Session::forget('success') }}
        @endif

        @if(Session::has('error'))
            <script>
                toastr.error("{{ Session::get('error') }}");
            </script>
            {{ Session::forget('error') }}
        @endif
        @if(Session::has('danger'))
            <script>
                toastr.error("{{ Session::get('error') }}");
            </script>
            {{ Session::forget('error') }}
        @endif
        @if(Session::has('warning'))
            <script>
                toastr.warning("{{ Session::get('warning') }}");
            </script>
            {{ Session::forget('warning') }}
        @endif
	<script src="{{ asset('assets') }}/js/app.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const toggleBtn = document.getElementById('themeToggle');

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark-theme');
        toggleBtn.innerHTML = "<i class='bx bx-sun'></i>";
    }

    toggleBtn.addEventListener('click', function () {

        document.documentElement.classList.toggle('dark-theme');

        if (document.documentElement.classList.contains('dark-theme')) {
            localStorage.setItem('theme', 'dark');
            toggleBtn.innerHTML = "<i class='bx bx-sun'></i>";
        } else {
            localStorage.setItem('theme', 'light');
            toggleBtn.innerHTML = "<i class='bx bx-moon'></i>";
        }

    });

});
</script>

    @stack('script')
