@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Hi {{session('user.username')}}! 👋</h5>
            <p class="text-sm text-slate-500">{{ $user->department->dept_code }}</p>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">GI-GOF</a>
            </li>
            <li class="text-slate-700">Dashboard</li>
        </ul>
    </div>

    <!-- Welcome Banner with Quick Action -->
    <div class="card mb-5 bg-gradient-to-r from-blue-500 to-blue-600">
        <div class="card-body">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-white mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold mb-2">Welcome to GI-GOF System</h3>
                    <p class="text-blue-100">General Operational Facility Request and Maintenance</p>
                </div>
                <a href="{{ url('/create') }}" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors shadow-lg flex items-center gap-2">
                    <i class="ri-add-circle-line text-xl"></i>
                    Create New Application
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5 mb-5">
        <!-- Total Applications -->
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-file-list-3-line text-2xl text-slate-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-1">{{ $totalApplications ?? 0 }}</h3>
                    <p class="text-sm text-slate-500">Total Applications</p>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-time-line text-2xl text-orange-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-orange-600 mb-1">{{ $pending ?? 0 }}</h3>
                    <p class="text-sm text-slate-500">Pending</p>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-check-line text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-green-600 mb-1">{{ $approved ?? 0 }}</h3>
                    <p class="text-sm text-slate-500">Approved</p>
                </div>
            </div>
        </div>

        <!-- On Progress -->
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-loader-4-line text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-600 mb-1">{{ $onProgress ?? 0 }}</h3>
                    <p class="text-sm text-slate-500">On Progress</p>
                </div>
            </div>
        </div>

        <!-- Finished -->
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-checkbox-circle-line text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-purple-600 mb-1">{{ $finished ?? 0 }}</h3>
                    <p class="text-sm text-slate-500">Finished</p>
                </div>
            </div>
        </div>
        
        <div class="card hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mb-3">
                        <i class="ri-prohibited-line text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-red-600 mb-1">{{ $rejected?? 0 }}</h3>
                    <p class="text-sm text-slate-500">Rejected</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mb-5">
        <!-- Recent Applications -->
        <div class="card xl:col-span-2">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="text-16 font-semibold">Recent Applications</h6>
                    <a href="{{ url('/check/'.session('user.id')) }}" class="text-sm text-blue-500 hover:underline flex items-center gap-1">
                        View All <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
                
                @forelse($recentApplications ?? [] as $app)
                <div class="p-4 mb-3 bg-slate-50 rounded-lg hover:bg-slate-100 transition-colors">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h6 class="font-semibold text-slate-800">{{ $app->no_permohonan }}</h6>
                                <span class="px-2 py-1 text-xs rounded
                                    @if($app->status_id == 1) bg-yellow-100 text-yellow-600
                                    @elseif($app->status_id == 2) bg-sky-100 text-sky-600
                                    @elseif($app->status_id == 3) bg-red-100 text-red-600
                                    @elseif($app->status_id == 4) bg-orange-100 text-orange-600
                                    @else bg-green-100 text-green-600
                                    @endif">
                                    {{ $app->status->nama_status ?? '-' }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 mb-1">
                                <i class="ri-file-list-line"></i>
                                {{ $app->jenis_permohonan->nama_jenis_permohonan ?? '-' }}
                            </p>
                            <p class="text-xs text-slate-500">
                                <i class="ri-map-pin-line"></i>
                                {{ $app->lokasi->nama_lokasi ?? '-' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded
                                @if($app->kepentingan == 'Sangat Mendesak') bg-red-100 text-red-600
                                @elseif($app->kepentingan == 'Mendesak') bg-yellow-100 text-yellow-600
                                @else bg-gray-100 text-gray-600
                                @endif">
                                {{ $app->kepentingan }}
                            </span>
                            <p class="text-xs text-slate-500 mt-2">
                                {{ $app->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Items Preview -->
                    @if($app->barang->count() > 0)
                    <div class="mt-2 pt-2 border-t border-slate-200">
                        <p class="text-xs text-slate-500 mb-1">Items:</p>
                        <div class="flex flex-wrap gap-1">
                            @foreach($app->barang->take(3) as $barang)
                            <span class="px-2 py-1 bg-white border border-slate-200 rounded text-xs">
                                {{ $barang->nama_barang }} ({{ $barang->pivot->jumlah }})
                            </span>
                            @endforeach
                            @if($app->barang->count() > 3)
                            <span class="px-2 py-1 bg-slate-200 rounded text-xs">
                                +{{ $app->barang->count() - 3 }} more
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-file-list-3-line text-4xl text-slate-400"></i>
                    </div>
                    <p class="text-slate-500 mb-4">No applications yet</p>
                    <a href="{{ url('/create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        <i class="ri-add-line"></i>
                        Create First Application
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Info & Progress -->
        <div class="card">
            <div class="card-body">
                <h6 class="text-16 font-semibold mb-4">Application Status</h6>
                
                <!-- Progress Ring -->
                <div class="flex justify-center mb-6">
                    <div class="relative" style="width: 180px; height: 180px;">
                        <canvas id="statusDoughnut"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <h3 class="text-3xl font-bold text-slate-800">{{ $totalApplications ?? 0 }}</h3>
                            <p class="text-xs text-slate-500">Total</p>
                        </div>
                    </div>
                </div>

                <!-- Status Legend -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 bg-yellow-50 rounded">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <span class="text-sm text-slate-700">Pending</span>
                        </div>
                        <span class="text-sm font-semibold text-yellow-600">{{ $pending ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-sky-50 rounded">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-sky-500 rounded-full"></div>
                            <span class="text-sm text-slate-700">Approved</span>
                        </div>
                        <span class="text-sm font-semibold text-sky-600">{{ $approved ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-orange-50 rounded">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <span class="text-sm text-slate-700">On Progress</span>
                        </div>
                        <span class="text-sm font-semibold text-orange-600">{{ $onProgress ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-green-50 rounded">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-slate-700">Finished</span>
                        </div>
                        <span class="text-sm font-semibold text-green-600">{{ $finished ?? 0 }}</span>
                    </div>
                     <div class="flex items-center justify-between p-2 bg-red-50 rounded">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm text-slate-700">Rejected</span>
                        </div>
                        <span class="text-sm font-semibold text-red-600">{{ $rejected ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Activity -->
    <div class="card mb-5">
        <div class="card-body">
            <h6 class="text-16 font-semibold mb-4">Your Application Activity (Last 6 Months)</h6>
            <div style="position: relative; height: 250px;">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
        <a href="{{ url('/create') }}" class="card hover:shadow-lg transition-all hover:-translate-y-1 bg-gradient-to-br from-blue-500 to-blue-600">
            <div class="card-body ">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="ri-add-circle-line text-xl"></i>
                    </div>
                    <div>
                        <h6 class="font-semibold mb-1">New Application</h6>
                        <p class="text-xs text-center text-slate-100 bg-slate-600 rounded-xl">Create new request</p>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ url('/check/'.session('user.id')) }}" class="card hover:shadow-lg transition-all hover:-translate-y-1 bg-gradient-to-br from-green-500 to-green-600">
            <div class="card-body ">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="ri-file-list-3-line text-2xl"></i>
                    </div>
                    <div>
                        <h6 class="font-semibold mb-1">My Applications</h6>
                        <p class="text-xs text-center text-sky-100 bg-sky-600 rounded-xl">View all requests</p>
                    </div>
                </div>
            </div>
        </a>

        <a href="#" class="card hover:shadow-lg transition-all hover:-translate-y-1 bg-gradient-to-br from-purple-500 to-purple-600">
            <div class="card-body ">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="ri-question-line text-2xl"></i>
                    </div>
                    <div>
                        <h6 class="font-semibold mb-1">Help & Guide</h6>
                        <p class="text-xs text-center text-orange-100 bg-orange-600 rounded-xl">View user guide</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pending = {{ $pending ?? 0 }};
    const approved = {{ $approved ?? 0 }};
    const onProgress = {{ $onProgress ?? 0 }};
    const finished = {{ $finished ?? 0 }};
    const rejected = {{ $rejected ?? 0 }};
    const monthLabels = {!! json_encode($monthLabels ?? ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']) !!};
    const monthData = {!! json_encode($monthData ?? [2, 5, 3, 7, 4, 6]) !!};

    const statusCtx = document.getElementById('statusDoughnut');
    if (statusCtx) {
        new Chart(statusCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Approved', 'Rejected', 'On Progress', 'Finished'],
                datasets: [{
                    data: [pending, approved, rejected, onProgress, finished],
                    backgroundColor: [
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(14, 165, 233, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(34, 197, 94, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    const monthlyCtx = document.getElementById('monthlyChart');
    if (monthlyCtx) {
        new Chart(monthlyCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Applications',
                    data: monthData,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 2,
                    borderRadius: 6
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
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection