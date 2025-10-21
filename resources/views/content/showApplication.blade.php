@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow"></div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboardAdmin" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                <a href="show" class="text-slate-400">Available Application</a>
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-4 xl:grid-cols-5 mb-5">
                <div class="md:col-span-2">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">List of Application</h2>
                        <p class="text-xs text-gray-400 mt-1">*Click on <strong>No Application</strong> to approve/reject application</p>
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
                            <th class="text-center">No Application</th>
                            <th class="text-center">Item Name</th>
                            <th class="text-center">Item Count</th>
                            <th class="text-center">Urgency</th>
                            <th class="text-center">Application Type</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Application Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded via AJAX -->
                    </tbody>
                </table>
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
            <button onclick="closeAjaxModal()" class="transition-all duration-100 ease-linear text-slate-500 hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>
        <div class="p-4 modal-body">
            <p class="text-gray-500">Loading...</p>
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

    // Modal handling
    $(document).on('click', '.ajax-modal-btn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = $(this).data('url');

        toggleElementState('ModalContoh', true, 200);
        toggleElementState('blurDiv', true, 200);
        document.querySelector('#ModalContoh .modal-body').innerHTML = '<p class="text-gray-500">Loading...</p>';

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            let barangListHTML = '';
            if (data.barang && data.barang.length > 0) {
                data.barang.forEach(item => {
                    barangListHTML += `
                        <div class="flex justify-between items-center p-2 bg-gray-100 rounded mb-2">
                            <div>
                                <span class="font-medium">${item.nama_barang}</span>
                                ${item.keterangan ? `<p class="text-xs text-gray-500">${item.keterangan}</p>` : ''}
                            </div>
                            <span class="text-sm font-semibold text-blue-600">${item.jumlah} pcs</span>
                        </div>
                    `;
                });
            }

            document.querySelector('#ModalContoh .modal-body').innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border-b border-slate-200">
                    <div class="mb-3 md:col-span-2">
                        <label class="inline-block mb-2 text-base font-medium">No Application:</label>
                        <input type="text" class="form-input border-slate-200 bg-slate-100" value="${data.no_permohonan}" disabled>
                    </div>
                    <div class="mb-3 md:col-span-2">
                        <label class="inline-block mb-2 text-base font-medium">Item(s):</label>
                        <div class="border border-slate-200 rounded p-3 bg-slate-100 max-h-60 overflow-y-auto">
                            ${barangListHTML || '<p class="text-gray-500">No items</p>'}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium">Urgency:</label>
                        <input type="text" class="form-input border-slate-200 bg-slate-100" value="${data.kepentingan}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium">Total Items:</label>
                        <input type="text" class="form-input border-slate-200 w-full bg-slate-100" value="${data.jumlah_barang_total || 0} pcs" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium">Location:</label>
                        <input type="text" class="form-input border-slate-200 bg-slate-100" value="${data.lokasi || '-'}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium">Description:</label>
                        <div class="form-input border-slate-200 bg-slate-100 p-3 rounded min-h-[100px]">${data.alasan_permohonan || '-'}</div>
                    </div>
                    <div class="mb-3">
                        <label class="inline-block mb-2 text-base font-medium">Application Date:</label>
                        <input type="text" class="form-input border-slate-200 bg-slate-100" value="${data.created_at}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-base font-medium">Attachment:</label>
                        ${data.foto_sebelum ? `<img src="{{ asset('storage/app/public') }}/${data.foto_sebelum}" alt="Attachment" class="w-40 h-40 object-cover border rounded-md">` : '<p class="text-gray-500">No attachment</p>'}
                    </div>
                    <button type="button" id="approveBtn" data-id="${data.id}" class="m-4 text-white bg-custom-500 btn">Approve Application</button>
                    <button type="button" id="rejectBtn" data-id="${data.id}" class="m-4 text-white bg-red-500 btn">Reject Application</button>
                </div>
            `;

            // Approve button handler
            $('#approveBtn').on('click', function() {
                if (data.status === "Rejected") {
                    Swal.fire({
                        title: 'Oops!',
                        text: "Application has been rejected, please choose another",
                        icon: 'warning',
                        confirmButtonText: 'OK',
                    });
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Application will be approved!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('process.approve') }}", {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id: data.id,
                                status_id: 2,
                                peninjau_id: "{{ session('user.id') }}"
                            })
                        })
                        .then(res => res.json())
                        .then(response => {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Approved!',
                                    text: 'Application has been approved.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                closeAjaxModal();
                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed!',
                                    text: 'Failed to approve application.',
                                    timer: 2000
                                });
                            }
                        });
                    }
                });
            });

            // Reject button handler
            $('#rejectBtn').on('click', function() {
                if (data.status === "Approved") {
                    Swal.fire({
                        title: 'Oops!',
                        text: "Application has been approved, please choose another",
                        icon: 'warning',
                        confirmButtonText: 'OK',
                    });
                    return;
                }
                document.querySelector('#ModalContoh .modal-body').innerHTML = `
                    <form id="submit_GA_note">
                        <input type="hidden" name="id" value="${data.id}">
                        <input type="hidden" name="status_id" value="3">
                        <div class="p-4 border-b border-slate-200">
                            <label class="inline-block mb-2 text-base font-medium">Rejection Reason: <span class="text-red-500">*</span></label>
                            <textarea id="alasan" name="catatan_peninjau" class="form-input border-slate-200 w-full" placeholder="Enter rejection reason..." rows="4"></textarea>
                        </div>
                        <div class="flex items-center p-4">
                            <button type="button" id="submitRejectionBtn" class="text-white bg-red-500 btn px-6 py-2 rounded">Submit Rejection</button>
                        </div>
                    </form>
                `;
                
                $('#submitRejectionBtn').on('click', function() {
                    let note = $('#alasan').val().trim();
                    if (!note) {
                        Swal.fire({
                            title: 'Oops!',
                            text: "Please fill rejection reason first!",
                            icon: 'warning',
                            confirmButtonText: 'OK',
                        });
                        return;
                    }
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Application will be rejected!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, reject it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ url('process/reject') }}", {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    id: data.id,
                                    status_id: 3,
                                    catatan_peninjau: note
                                })
                            })
                            .then(res => res.json())
                            .then(response => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Rejected!',
                                    text: 'Application has been rejected.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                closeAjaxModal();
                                table.ajax.reload();
                            });
                        }
                    });
                });
            });
        })
        .catch(error => {
            console.error('Fetch error:', error);
            document.querySelector('#ModalContoh .modal-body').innerHTML = '<p class="text-red-500">Failed to load data.</p>';
        });
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
    function showImageModal(imageUrl) {
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50" onclick="closeImageModal()">
            <div class="relative max-w-4xl max-h-full p-4">
                <img src="${imageUrl}" class="max-w-full max-h-full object-contain rounded">
                <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75">
                    ×
                </button>
            </div>
        </div>
    `;
    modal.id = 'imageModal';
    document.body.appendChild(modal);
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.remove();
    }
}
    window.closeAjaxModal = closeAjaxModal;
});
</script>
@endsection