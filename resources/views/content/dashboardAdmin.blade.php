@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">

        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">GI-GOF</a>
            </li>
            <li class="text-slate-700">Dashboard General Affair</li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body ">
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-4 xl:grid-cols-5 mb-5">
                <h5 class=" md:col-span-2 text-16">Monthly General Requestition Status Maintenance</h5>
                <select class="monthSelect" id="monthSelect">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select class="yearSelect" id="yearSelect">
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                </select>
            </div>
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-5 mb-5">
                <div class="card border-sky-400">
                    <div class="card-body">
                        <div class="flex items-center">
                            <div class="grow">
                                <h6 class="mb-1 text-15">Pending Applications</h6>
                                <h4 class="mb-0 text-slate-800">
                                    <span id="pendingMonthly" class="counter-value text-3xl font-bold"
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
                                    <span id="approvedMonthly" class="counter-value text-3xl font-bold"
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
                                    <span id="onProgMonthly" class="counter-value text-3xl font-bold"
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
                                    <span id="finishedMonthly" class="counter-value text-3xl font-bold"
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
                                    <span id="rejectedMonthly" class="counter-value text-3xl font-bold"
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
                                    <span id="totalMonthly" class="counter-value text-3xl font-bold"
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
        </div>
        <!-- Pending Applications -->

    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2 mb-5">

        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Applications by Department</h6>
                <div id="deptChart"></div>
            </div>
        </div>

        <!-- Applications by Status -->
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Applications by Status</h6>
                <div id="statusChart"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-2 mb-5">
        <!-- Monthly Trend -->
        <div class="card xl:col-span-2">
            <div class="card-body">
                <h6 class="mb-4 text-15 font-semibold">Monthly Application Trend</h6>
                <div id="monthlyChart"></div>
            </div>
        </div>
    </div>

    <!-- Recent Applications & Top Items -->
    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-3 mb-5">
        <!-- Recent Applications -->
        <div class="card md:col-span-2">
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    $('.monthSelect').select2({
        theme: "bootstrap-5",
        placeholder: "Select Month",
        minimumResultsForSearch: -1,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        }
    });
    $('.yearSelect').select2({
        theme: "bootstrap-5",
        placeholder: "Select Year",
        minimumResultsForSearch: -1,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        }
    });
    
    const baseUrl = "{{ url('/process/getAppData') }}";
    let monthSelect = document.getElementById('monthSelect');
    let yearSelect = document.getElementById('yearSelect');
    let deptChart, statusChart, monthlyChart;

    const initialDeptLabels = JSON.parse('{!! json_encode($deptLabels ?? []) !!}');
    const initialDeptData = JSON.parse('{!! json_encode($deptData ?? []) !!}');
    const initialStatusData = JSON.parse('{!! json_encode($statusData ?? []) !!}');
    const monthLabels = JSON.parse('{!! json_encode($monthLabels ?? []) !!}');
    const monthData = JSON.parse('{!! json_encode($monthData ?? []) !!}');

    // Department Bar Chart
    function initDeptChart(labels, data) {
        if (deptChart) {
            deptChart.destroy();
        }

        const options = {
            series: [{
                name: 'Applications',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    distributed: true,
                    horizontal: false,
                    columnWidth: '55%',
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: [
                '#3b82f6',
                '#10b981',
                '#f97316',
                '#a855f7',
                '#ec4899',
                '#eab308'
            ],
            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            legend: {
                show: false
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " applications"
                    }
                }
            }
        };

        deptChart = new ApexCharts(document.querySelector("#deptChart"), options);
        deptChart.render();
    }

    // Status Donut Chart
    function initStatusChart(data) {
        if (statusChart) {
            statusChart.destroy();
        }

        const options = {
            series: data,
            chart: {
                type: 'donut',
                height: 300
            },
            labels: ['Pending', 'Approved', 'On Progress', 'Finished', 'Rejected'],
            colors: ['#f97316', '#10b981', '#3b82f6', '#a855f7', '#ef4444'],
            legend: {
                position: 'bottom',
                fontSize: '12px'
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return Math.round(val) + "%"
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                fontSize: '16px',
                                fontWeight: 600,
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                }
                            }
                        }
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " applications"
                    }
                }
            }
        };

        statusChart = new ApexCharts(document.querySelector("#statusChart"), options);
        statusChart.render();
    }

    // Monthly Trend Line Chart
    function initMonthlyChart(labels, data) {
        const options = {
            series: [{
                name: 'Applications',
                data: data
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            colors: ['#3b82f6'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        fontSize: '11px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " applications"
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1'
            }
        };

        monthlyChart = new ApexCharts(document.querySelector("#monthlyChart"), options);
        monthlyChart.render();
    }

    // Initialize charts
    initDeptChart(initialDeptLabels, initialDeptData);
    initStatusChart(initialStatusData);
    initMonthlyChart(monthLabels, monthData);

    // Month/Year change handler
    $('#monthSelect').on('change.select2', function() {
        let month = monthSelect.value;
        let year = yearSelect.value;
        let url = `${baseUrl}?month=${encodeURIComponent(month)}&year=${encodeURIComponent(year)}`;
        
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('pendingMonthly').innerHTML = data.pending ?? '0';
                    document.getElementById('approvedMonthly').innerHTML = data.approved ?? '0';
                    document.getElementById('rejectedMonthly').innerHTML = data.rejected ?? '0';
                    document.getElementById('onProgMonthly').innerHTML = data.onProgress ?? '0';
                    document.getElementById('finishedMonthly').innerHTML = data.finished ?? '0';
                    document.getElementById('totalMonthly').innerHTML = data.sum ?? '0';


                    initDeptChart(data.deptLabels, data.deptData);
                    initStatusChart(data.statusData);
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                alert('Cannot load data, please try again');
            });
    });

    $('#yearSelect').on('change.select2', function() {
        $('#monthSelect').trigger('change.select2');
    });

    // Set current month and year
    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();

    $('#monthSelect').val(String(currentMonth).padStart(2, '0')).trigger('change.select2');
    $('#yearSelect').val(currentYear).trigger('change.select2');
});
</script>
@endsection