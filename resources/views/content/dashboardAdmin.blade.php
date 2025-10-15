@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Hi {{session('user.username')}} (General Affair) ! 👋</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">GI-GOF</a>
            </li>
            <li class="text-slate-700">Dashboard General Affair</li>
        </ul>
    </div>


    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-5 mb-5">

        <!-- Pending Applications -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">Pending Applications</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $pending ?? 0 }}">{{ $pending ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="ri-time-line text-2xl text-orange-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved Applications -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">Approved</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $approved ?? 0 }}">{{ $approved ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="ri-check-line text-2xl text-green-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- On Progress -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">On Progress</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $onProgress ?? 0 }}">{{ $onProgress ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="ri-loader-4-line text-2xl text-blue-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Finished -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">Finished</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $finished ?? 0 }}">{{ $finished ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="ri-checkbox-circle-line text-2xl text-purple-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected Applications -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">Rejected Applications</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $rejected ?? 0 }}">{{ $rejected ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="ri-prohibited-line text-2xl text-red-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center">
                    <div class="grow">
                        <h6 class="mb-1 text-15">Total Applications</h6>
                        <h4 class="mb-0 text-slate-800">
                            <span class="counter-value text-3xl font-bold"
                                data-target="{{ $sum ?? 0 }}">{{ $sum ?? 0 }}</span>
                        </h4>
                    </div>
                    <div class="shrink-0">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center">
                            <i class="ri-functions text-2xl text-slate-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2 mb-5">

        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Applications by Department</h6>
                <div style="position: relative; height: 300px;">
                    <canvas id="deptChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Applications by Status -->
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Applications by Status</h6>
                <div style="position: relative; height: 300px;">
                    <canvas id="statusChart"></canvas>
                </div>

            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2 mb-5">
        <!-- Monthly Trend -->
        <div class="card xl:col-span-2">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Monthly Application Trend</h6>
                <div style="position: relative; height: 300px;">
                    <canvas id="monthlyChart"></canvas>
                </div>

            </div>
        </div>
    </div>

    <!-- Recent Applications & Top Items -->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2 mb-5">
        <!-- Recent Applications -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="text-15 font-semibold">Recent Applications</h6>
                    <a href="{{ url('/show') }}" class="text-sm text-blue-500 hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b text-xs">No. Application</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b text-xs">Department</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b text-xs">Status</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b text-xs">Urgency</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentApplications ?? [] as $app)
                            <tr>
                                <td class="px-3.5 py-2.5 border-b text-xs">{{ $app->no_permohonan }}</td>
                                <td class="px-3.5 py-2.5 border-b text-xs">
                                    {{ $app->pemohon->department->dept_name ?? '-' }}</td>
                                <td class="px-3.5 py-2.5 border-b text-xs">
                                    <span class="px-2 py-1 text-xs rounded 
                                        @if($app->status_id == 1) bg-yellow-100 text-yellow-800
                                        @elseif($app->status_id == 2) bg-sky-100 text-sky-800
                                        @elseif($app->status_id == 3) bg-red-100 text-red-600
                                        @elseif($app->status_id == 4) bg-orange-300 text-orange-800
                                        @else bg-green-100 text-green-600
                                        @endif">
                                        {{ $app->status->nama_status ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-3.5 py-2.5 border-b text-xs">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($app->kepentingan == 'Sangat Mendesak') bg-red-100 text-red-600
                                        @elseif($app->kepentingan == 'Mendesak') bg-yellow-100 text-yellow-600
                                        @else bg-slate-100 text-slate-600
                                        @endif">
                                        {{ $app->kepentingan }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-3.5 py-4 text-center text-slate-500 text-sm">No recent
                                    applications</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Requested Items -->
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Top Requested Items</h6>
                <div class="space-y-3">
                    @forelse($topItems ?? [] as $item)
                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="ri-box-3-line text-blue-500"></i>
                            </div>
                            <div>
                                <h6 class="text-sm font-semibold">{{ $item->nama_barang }}</h6>
                                <p class="text-xs text-slate-500">Code: {{ $item->kode_barang }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-slate-700">{{ $item->total_requests }}</p>
                            <p class="text-xs text-slate-500">requests</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-slate-500 text-sm py-4">No data available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Urgency Overview -->
    <div class="card mb-5">
        <div class="card-body">
            <h6 class="mb-4 text-15 font-semibold">Applications by Urgency Level</h6>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 bg-red-50 rounded-lg border border-red-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-red-600 mb-1">Sangat Mendesak</p>
                            <h3 class="text-2xl font-bold text-red-700">{{ $sangatMendesak ?? 0 }}</h3>
                        </div>
                        <i class="ri-alarm-warning-line text-3xl text-red-400"></i>
                    </div>
                </div>
                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-yellow-600 mb-1">Mendesak</p>
                            <h3 class="text-2xl font-bold text-yellow-700">{{ $mendesak ?? 0 }}</h3>
                        </div>
                        <i class="ri-time-line text-3xl text-yellow-400"></i>
                    </div>
                </div>
                <div class="p-4 bg-sky-50 rounded-lg border border-sky-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-sky-600 mb-1">Normal</p>
                            <h3 class="text-2xl font-bold text-sky-700">{{ $normal ?? 0 }}</h3>
                        </div>
                        <i class="ri-checkbox-circle-line text-3xl text-sky-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dari PHP
    const deptLabels = JSON.parse('{!! json_encode($deptLabels ?? ["FC", "HR", "IT", "Finance"]) !!}');
    const deptData = JSON.parse('{!! json_encode($deptData ?? [12, 8, 15, 6]) !!}');
    const statusData = JSON.parse('{!! json_encode($statusData ?? [15, 25, 10, 35, 5]) !!}');
    const monthLabels = JSON.parse(
        '{!! json_encode($monthLabels ?? ["Jan", "Feb", "Mar", "Apr", "May", "Jun"]) !!}');
    const monthData = JSON.parse('{!! json_encode($monthData ?? [30, 45, 38, 52, 48, 60]) !!}');

    // Applications by Department Chart
    const deptCtx = document.getElementById('deptChart');
    if (deptCtx) {
        new Chart(deptCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: deptLabels,
                datasets: [{
                    label: 'Applications',
                    data: deptData,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(168, 85, 247, 0.8)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(249, 115, 22)',
                        'rgb(168, 85, 247)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Applications by Status Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'On Progress', 'Finished', 'Rejected'],
                datasets: [{
                    data: statusData,
                    backgroundColor: [
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Applications',
                    data: monthData,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
</script>
@endsection