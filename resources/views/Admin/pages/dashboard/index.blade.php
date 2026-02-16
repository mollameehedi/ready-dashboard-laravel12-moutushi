@extends('admin.layouts.app')

@section('main')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between mb-4 align-items-center">
        <h3 class="fw-bold">Dashboard</h3>
        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-bell"></i> Notifications</button>
    </div>

    {{-- Stats Cards --}}
     <div class="container mt-5">
    <div class="row" style="gap: 45px;">
        @foreach($stats as $stat)
        <div class="col-md-2">
            <div class="card dash-card text-center bg-{{ $stat['color'] }} text-white" style="height: 150px;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-3">
                    <i class="bi bi-graph-up fs-3 mb-2"></i>
                    <h6 class="mb-1">{{ $stat['label'] }}</h6>
                    <h4 class="fw-bold mb-0">{{ $stat['value'] }}</h4>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- Chart / Picture --}}
{{-- Recent Orders Table --}}
</div>
@endsection

@push('styles')
<style>
.sidebar a.nav-link:hover {
    background: #c4b7b7;
    border-radius: 8px;
}
.dash-card {
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.dash-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
}
</style>
@endpush

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const salesData = @json($chart_data);
const labels = Object.keys(salesData);

new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales',
            data: labels.map(l => salesData[l].sales),
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13, 110, 253, 0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        plugins: { legend: { position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
