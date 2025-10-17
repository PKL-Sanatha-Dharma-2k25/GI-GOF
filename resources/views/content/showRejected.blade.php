@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboardAdmin" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                <a href="showRejected" class="text-slate-400">Rejected Application</a>
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-4 xl:grid-cols-5 mb-5">
                <div class="md:col-span-2">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">List of Application</h2>
                        <p class="text-xs text-gray-400 mt-1">*Click on <strong>No Application</strong> to
                            approve/reject application</p>
                    </div>
                </div>
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
            <div class="overflow-x-auto">
                <table class="display w-full text-center table-auto min-w-max" style="width:100%" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center cursor-pointer hover:bg-gray-100">No Application</th>
                            <th class="text-center cursor-pointer hover:bg-gray-100">
                                Item Name
                            </th>
                            <th class="text-center max-w-xs">Item Count</th>
                            <th class="text-center cursor-pointer hover:bg-gray-100">
                                Urgency
                            </th>
                            <th class="text-center max-w-xs">Application Type</th>
                            <th class="text-center max-w-xs">Location</th>
                            <th class="text-center cursor-pointer hover:bg-gray-100">
                                Application Date
                            </th>
                            <th class="text-center cursor-pointer hover:bg-gray-100">
                                Status
                            </th>
                            <th class="text-center cursor-pointer hover:bg-gray-100">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<!-- MODAL AJAX -->
<div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden" id="blurDiv"></div>
<div id="ModalContoh" class="fixed inset-0 z-drawer flex items-start justify-center pt-10 overflow-y-auto hidden">
    <div class="bg-white shadow rounded-md w-screen lg:w-[40rem] flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16">Application Details</h5>
            <button onclick="closeAjaxModal()"
                class="transition-all duration-100 ease-linear text-slate-500 hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>
        <div class="p-4 modal-body">
            <p class="text-gray-500">Loading...</p>
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
        width: 'style'
    });

    $('.yearSelect').select2({
        theme: "bootstrap-5",
        placeholder: "Select Year",
        minimumResultsForSearch: -1,
        width: 'style'
    });

    const baseUrl = "{{ url('/process/getTableData') }}";
    let monthSelect = document.getElementById('monthSelect');
    let yearSelect = document.getElementById('yearSelect');

    // Set current month and year
    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();
    $('#monthSelect').val(String(currentMonth).padStart(2, '0')).trigger('change');
    $('#yearSelect').val(currentYear).trigger('change');

    // Initialize DataTable 
    let table = $('#myTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: baseUrl,
            type: 'GET',
            data: function(d) {
                return {
                    month: monthSelect.value,
                    year: yearSelect.value
                };
            },
            dataSrc: '', 
            error: function(xhr, error, code) {
                console.error('DataTables Ajax Error:', error);
                console.error('Status:', xhr.status);
                console.error('Response:', xhr.responseText);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Load Data',
                    text: 'Please check your internet connection or contact administrator.',
                });
            }
        },
        columns: [
            {
                data: 'no_permohonan',
                name: 'no_permohonan',
                render: function(data, type, row) {
                    return `<button data-id="${row.id}" 
                                data-url="{{ url('/permohonan/') }}/${row.id}/detail"
                                style="text-decoration: underline; color: blue;"
                                class="ajax-modal-btn bg-white-600 text-black">
                                ${data}
                            </button>`;
                }
            },
            {
                data: 'barang',
                name: 'barang',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (!data || data.length === 0) return '-';
                    let html = '<div class="flex flex-col gap-1">';
                    data.forEach(item => {
                        html += `<div>${item.nama_barang}</div>`;
                    });
                    html += '</div>';
                    return html;
                }
            },
            {
                data: 'barang',
                name: 'item_count',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (!data || data.length === 0) return '-';
                    let html = '<div class="flex flex-col gap-1">';
                    data.forEach(item => {
                        html += `<div>${item.jumlah || '-'} pcs</div>`;
                    });
                    html += '</div>';
                    return html;
                }
            },
            {
                data: 'kepentingan',
                name: 'kepentingan',
                render: function(data, type, row) {
                    let bgClass = 'bg-green-100 text-green-800';
                    if (data === 'Sangat Mendesak') {
                        bgClass = 'bg-red-100 text-red-800';
                    } else if (data === 'Mendesak') {
                        bgClass = 'bg-orange-100 text-orange-800';
                    }
                    return `<span class="px-2 py-1 rounded-full text-xs ${bgClass}">${data}</span>`;
                }
            },
            {
                data: 'jenis_permohonan.nama_jenis_permohonan',
                name: 'jenis_permohonan.nama_jenis_permohonan',
                defaultContent: '-'
            },
            {
                data: 'lokasi.nama_lokasi',
                name: 'lokasi.nama_lokasi',
                defaultContent: '-'
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    if (!data) return '-';
                    let date = new Date(data);
                    let year = date.getFullYear();
                    let month = String(date.getMonth() + 1).padStart(2, '0');
                    let day = String(date.getDate()).padStart(2, '0');
                    let hours = String(date.getHours()).padStart(2, '0');
                    let minutes = String(date.getMinutes()).padStart(2, '0');
                    let seconds = String(date.getSeconds()).padStart(2, '0');
                    return `${year}/${month}/${day} ${hours}:${minutes}:${seconds}`;
                }
            },
            {
                data: 'status',
                name: 'status.nama_status',
                render: function(data, type, row) {
                    if (!data) return '<span class="px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">Pending</span>';
                    
                    let bgClass = 'bg-yellow-100 text-yellow-800';
                    let statusName = data.nama_status || 'Pending';
                    
                    if (statusName === 'Approved') {
                        bgClass = 'bg-sky-100 text-sky-800';
                    } else if (statusName === 'Rejected') {
                        bgClass = 'bg-red-500 text-red-800';
                    } else if (statusName === 'On Progress') {
                        bgClass = 'bg-orange-300 text-orange-800';
                    } else if (statusName === 'Finished') {
                        bgClass = 'bg-emerald-100 text-emerald-800';
                    }
                    return `<span class="px-2 py-1 rounded-full text-xs ${bgClass}">${statusName}</span>`;
                }
            },
            {
                data: 'pemohon.username',
                name: 'pemohon.username',
                defaultContent: '-'
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search data...",
            processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        order: [[6, 'desc']]
    });

    // Reload table when month or year changes
    $('#monthSelect, #yearSelect').on('change.select2', function() {
        table.ajax.reload();
    });


    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('ajax-modal-btn')) {
            let id = e.target.dataset.id;

            // tampilkan modal
            toggleElementState('ModalContoh', true, 200);
            // tampilkan backdrop
            toggleElementState('blurDiv', true, 200);
            // loading
            document.querySelector('#ModalContoh .modal-body').innerHTML =
                '<p class="text-gray-500">Loading...</p>';

            let url = e.target.dataset.url;

            //  AJAX 
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let barangListHTML = '';
                    data.barang.forEach(item => {
                        barangListHTML += `
                <div class="flex justify-between items-center p-2 bg-gray-500 rounded mb-2">
                    <div>
                        <span class="font-medium">${item.nama_barang}</span>
                        ${item.keterangan ? `<p class="text-xs text-gray-500">${item.keterangan}</p>` : ''}
                    </div>
                    <span class="text-sm font-semibold text-blue-600">${item.jumlah} pcs</span>
                </div>
            `;
                    });

                    document.querySelector('#ModalContoh .modal-body').innerHTML = `
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border-b border-slate-200">
             <div class="mb-3 md:col-span-2">
                <label for="noApplication" class="inline-block mb-2 text-base font-medium"> No Application : <span class="text-red-500"></span></label>
                <input type="text" id="noApplication" class="form-input border-slate-200 bg-slate-100" value="${data.no_permohonan}" disabled>
            </div>
            <div class="mb-3 md:col-span-2">
                    <label class="inline-block mb-2 text-base font-medium">
                        Item(s) : <span class="text-red-500"></span>
                    </label>
                    <div class="border border-slate-200 rounded p-3 bg-slate-100 max-h-60 overflow-y-auto">
                        ${barangListHTML}
                    </div>
                </div>
            <div class="mb-3">
                <label for="urgency" class="inline-block mb-2 text-base font-medium">Urgency : <span class="text-red-500"></span></label>
                <input type="text" id="urgency" class="form-input border-slate-200 bg-slate-100" value="${data.kepentingan}" disabled>
            </div>
           <div class="mb-3">
                    <label for="itemCount" class="inline-block mb-2 text-base font-medium">
                        Total Items : <span class="text-red-500"></span>
                    </label>
                    <input type="text" id="itemCount" 
                           class="form-input border-slate-200 w-full bg-slate-100" 
                           value="${data.jumlah_barang_total} pcs" disabled>
                </div>
            <div class="mb-3">
                <label for="location" class="inline-block mb-2 text-base font-medium">Location : <span class="text-red-500"></span></label>
                <input type="text" id="location" class="form-input border-slate-200 bg-slate-100" value="${data.lokasi}" disabled>
            </div>
            <div class="mb-3">
                <label for="alasan" class="inline-block mb-2 text-base font-medium">Description : <span class="text-red-500"></span></label>
                <div class="form-input border-slate-200 bg-slate-100 p-3 rounded min-h-[100px]" id="alasan"></div>
            </div>
            <div class="mb-3">
                <label for="my-date" class="inline-block mb-2 text-base font-medium">Application Date : <span class="text-red-500"></span></label>
                <input type="text" id="my-date" name="tgl_pengajuan" class="form-input border-slate-200 bg-slate-100" value="${data.created_at}" disabled>
            </div>

            <!-- Foto Sebelumnya -->
            <div class="mb-3">
              <label class="block mb-2 text-base font-medium">Attachment :</label>
              <img src="{{ asset('/storage/app/public/${data.foto_sebelum}')}}" alt="Foto Item" class="w-40 h-40 object-cover border rounded-md">
            </div>
            
           <div class="mb-3 md:col-span-2">
            <button type="button" id="deleteBtn" class="m-4 text-white bg-red-500 btn ..." 
            style="width: 95%;background-color: red;" data-url="">Delete</button>
            </div>
        </div>
    `;
                    document.getElementById('alasan').innerHTML = data.alasan_permohonan;
                    const deleteBtn = document.getElementById('deleteBtn');
                    deleteBtn.addEventListener('click', function() {
                        let url = `{{ url('process') }}/${data.id}/delete`;
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Application will be deleted!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sure!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                fetch(url, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                    .then(res => res.json())
                                    .then(response => {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Done!',
                                                text: '{{ session("success") }}',
                                                timer: 2500,
                                                showConfirmButton: false
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Failed!',
                                                text: '{{ session("error") }}',
                                                timer: 2500,
                                                showConfirmButton: false
                                            });
                                        }
                                        location.reload();
                                    })
                            } else if (result.dismiss === Swal.DismissReason
                                .cancel) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Cancelled',
                                    text: 'Application will not be deleted',
                                    timer: 2500,
                                    showConfirmButton: false
                                });
                            }
                        })
                    })
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    document.querySelector('#ModalContoh .modal-body').innerHTML =
                        '<p class="text-red-500">Gagal memuat data.</p>';
                });
        }
    });

    function closeAjaxModal() {
        toggleElementState('ModalContoh', false, 200);
        toggleElementState('blurDiv', false, 200);
    }

    let openModalId = null;
    
    const toggleElementState = (elementId, show, delay) => {
        const element = document.getElementById(elementId);
        if (element) {
            if (!show) {
                element.classList.add('show');
                setTimeout(() => {
                    element.classList.add("hidden");
                }, 350);
            } else {
                element.classList.remove("hidden");
                setTimeout(() => {
                    element.classList.remove('show');
                }, delay);
            }
            document.body.classList.toggle('overflow-hidden', show);
            openModalId = show ? elementId : null;
        }
    }
    
    window.closeAjaxModal = closeAjaxModal;
});
</script>
@endsection