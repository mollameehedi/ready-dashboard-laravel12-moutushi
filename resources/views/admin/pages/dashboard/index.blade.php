@extends('admin.layouts.app')
@push('title', 'Dashboard')

@section('content')
<!--breadcrumb-->
<div class="d-flex align-items-center justify-content-between">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<!-- Dashboard Cards Single Row -->
<div class="row flex-nowrap">
    <div class="col-auto">
        <div class="card radius-15 card-info">
            <div class="d-flex align-items-center w-100">
                <div>
                    <p class="mb-0">Total Order</p>
                    <h4 class="my-1">{{ $total_order }}</h4>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-white text-info ms-auto"><i class='fadeIn animated bx bx-grid'></i></div>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="card radius-15 card-success">
            <div class="d-flex align-items-center w-100">
                <div>
                    <p class="mb-0">Total Success Order</p>
                    <h4 class="my-1">{{ $total_success }}</h4>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-white text-success ms-auto"><i class='fadeIn animated bx bx-book-reader'></i></div>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="card radius-15 card-warning">
            <div class="d-flex align-items-center w-100">
                <div>
                    <p class="mb-0">Total Pending Order</p>
                    <h4 class="my-1">{{ $total_pending }}</h4>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-white text-warning ms-auto"><i class='fadeIn animated bx bx-box'></i></div>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="card radius-15 card-danger">
            <div class="d-flex align-items-center w-100">
                <div>
                    <p class="mb-0">Total Cancel Order</p>
                    <h4 class="my-1">{{ $total_cancel }}</h4>
                </div>
                <div class="widgets-icons-2 rounded-circle bg-white text-danger ms-auto"><i class='fadeIn animated bx bx-server'></i></div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
{{-- <div class="row mt-4">
    <div class="col-lg-12">
        <h6 class="mb-0 text-uppercase">Order Summary</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div id="chart4"></div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('script')
<script src="{{ asset('assets') }}/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script>
let chartData = @json($chart_data);
let total_order = [];
let total_success = [];
let total_pending = [];
let total_cancel = [];
let chart_date = [];

$.each(chartData, function(index, value) {
    total_order.push(value.order);
    total_success.push(value.success);
    total_pending.push(value.pending);
    total_cancel.push(value.cancel);
    chart_date.push(index);
});

var options = {
    series: [
        { name: 'Total Order', data: total_order },
        { name: 'Success', data: total_success },
        { name: 'Pending', data: total_pending },
        { name: 'Cancel', data: total_cancel }
    ],
    chart: { foreColor: '#9ba7b2', type: 'bar', height: 360 },
    plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
    dataLabels: { enabled: false },
    stroke: { show: true, width: 2, colors: ['transparent'] },
    title: { text: 'Order Summary', align: 'left', style: { fontSize: '14px' } },
    colors: ["#212529", '#0d6efd', '#ffc107','#fd3550'],
    xaxis: { categories: chart_date },
    fill: { opacity: 1 }
};

var chart = new ApexCharts(document.querySelector("#chart4"), options);
chart.render();
</script>
@endpush
