<!DOCTYPE html>
<html lang="zxx">

@include('Admin/layouts/includes/head')

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Navigation Manu !-->
    <!--! ================================================================ !-->
   @include('Admin/layouts/includes/nav')

   @include('Admin/layouts/includes/header')
   <main class="nxl-container">
        <div class="nxl-content"></div>
   @yield('main')

    </main>

    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('assets/vendors/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/circle-progress.min.js') }}"></script>

<!-- Apps Init -->
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard-init.min.js') }}"></script>

<!-- Theme Customizer -->
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>

    <!--! END: Theme Customizer !-->
    </body>

   </html>