@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">My Application</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                My Application
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Application List</h2>
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
                                <th class="text-center cursor-pointer hover:bg-gray-100">Reviewer(GA)</th>
                                <th class="text-center cursor-pointer hover:bg-gray-100">GA Notes</th>
                                <th class="th_action text-center cursor-pointer hover:bg-gray-100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permohonans as $permohonan)
                            <tr data-status-id="{{ $permohonan->status_id }}">
                                <td class="text-center">{{ $permohonan->no_permohonan }}</td>
                                <td>
                                    <div class="flex flex-col gap-1">
                                        @foreach ($permohonan->barang as $barang)
                                        <div>{{ $barang->nama_barang }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col gap-1">
                                        @foreach ($permohonan->barang as $barang)
                                        <div>{{ $barang->pivot->jumlah ?? '-'}} pcs</div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="px-2 py-1 rounded-full text-xs 
                    @if($permohonan->kepentingan == 'Sangat Mendesak') bg-red-100 text-red-800
                    @elseif($permohonan->kepentingan == 'Mendesak') bg-orange-100 text-orange-800
                    @else bg-green-100 text-green-800 @endif">
                                        {{ $permohonan->kepentingan }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $permohonan->jenis_permohonan->nama_jenis_permohonan }}</td>
                                <td class="text-center">{{ $permohonan->lokasi->nama_lokasi }}</td>
                                <td class="px-4 py-3">
                                    {{ $permohonan->created_at ? \Carbon\Carbon::parse($permohonan->created_at)->format('Y/m/d H:i:i') : '-' }}
                                </td>
                                <td class="text-center">
                                    <span class="px-2 py-1 rounded-full text-xs  
                    @if($permohonan->status->nama_status == 'Approved') bg-sky-100 text-sky-800
                    @elseif($permohonan->status->nama_status == 'Pending') bg-yellow-100 text-yellow-800
                    @elseif($permohonan->status->nama_status == 'Rejected') bg-red-500 text-red-800
                    @elseif($permohonan->status->nama_status == 'On Progress') bg-orange-300 text-amber-800
                    @elseif($permohonan->status->nama_status == 'Finished') bg-emerald-100 text-emerald-800
                    @endif">
                                        {{ $permohonan->status->nama_status ?? 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $permohonan->peninjau->username ?? '-' }}</td>
                                <td class="text-center">{{ $permohonan->catatan_peninjau ?? '-' }}</td>
                                <td class="td_action text-center">
                                    <button type="button" id="deleteBtn" data-id="{{ $permohonan->id }}"
                                        data-url="{{  url('/process/'.$permohonan->id.'/delete') }}"
                                        class="deleteBtn finished m-4 text-white bg-red-500 btn ">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL CONTOH -->
<div id="ModalContoh" class="fixed inset-0 z-drawer flex items-start justify-center pt-10 overflow-y-auto hidden">
    <div class="bg-white shadow rounded-md w-screen lg:w-[40rem] flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16">Detail Permohonan</h5>
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
<script>
const deleteButtons = document.querySelectorAll('.deleteBtn');
deleteButtons.forEach(btn => {


    btn.addEventListener('click', function(e) {
        let id = e.target.dataset.id;
        let url = e.target.dataset.url;
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
        });
    });


document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('tr[data-status-id]').forEach(function(row) {
        let statusId = row.getAttribute('data-status-id');
        if (statusId !== "1") {
            let td = row.querySelector('.td_action');
            let th = row.querySelector('.th_action');
            if (td) td.style.display = 'none';
            if (th) th.style.display = 'none';
        }
    });
});


$('#myTable').DataTable({
    columnDefs: [

    ],
});

let openModalId = null;
//  Show Modal
const toggleElementState = (elementId, show, delay) => {
    const bodyElement = document.body;

    if (document.getElementById("backDropDiv")) {
        var backDropOverlay = document.getElementById("backDropDiv");
    } else {
        var backDropOverlay = document.createElement('div');
        backDropOverlay.className = 'fixed inset-0 bg-gray-900/20 z-[1049] backdrop-overlay hidden';
        backDropOverlay.id = 'backDropDiv';
    }

    const element = document.getElementById(elementId);
    if (element) {
        if (!show) {
            element.classList.add('show');
            backDropOverlay.classList.add('hidden');
            setTimeout(() => {
                element.classList.add("hidden");
            }, 350);
        } else {
            element.classList.remove("hidden");
            setTimeout(() => {
                element.classList.remove('show');
                backDropOverlay.classList.remove('hidden');
            }, delay);
        }
        bodyElement.classList.toggle('overflow-hidden', show);
        if (show) {
            openDrawerId = elementId;
            openModalId = elementId;
        } else {
            openDrawerId = null;
            openModalId = null;
        }
    }
}
// Close modal 
document.addEventListener("DOMContentLoaded", function() {
    let backDropOverlay = document.getElementById("backDropDiv");

    if (backDropOverlay) {
        backDropOverlay.addEventListener("click", function() {
            if (openModalId) {
                toggleElementState(openModalId, false, 200);
            }
        });
    }
});
$(document).ready(function() {
    // Select 2
    $('.select2').select2({
        theme: "bootstrap-5",
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        }
    });
    // Sweet Alert Swal.Fire
    $('#sweet_alert').on('click', function() {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            customClass: {
                confirmButton: 'text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 ltr:mr-1 rtl:ml-1',
                cancelButton: 'text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100',
                denyButton: "text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 ltr:mr-1 rtl:ml-1"
            },
            buttonsStyling: false,
            denyButtonText: 'Eror',
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500,
                    showCloseButton: true
                })
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100',
                    },
                    buttonsStyling: false,
                    footer: '<a href="#!" class="inline-flex items-center gap-2 mt-3 text-base font-medium text-custom-400 hover:text-custom-600">Why do I have this issue?</a>',
                    showCloseButton: true
                })
            }
        });
    });
    // Modal
    $('#modal').on('click', function() {
        toggleElementState('ModalContoh', true, 200);
    })
})

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('image-modal')) {
        const imageUrl = e.target.getAttribute('data-image-url');
        showImageModal(imageUrl);
    }
});

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
</script>
@endsection