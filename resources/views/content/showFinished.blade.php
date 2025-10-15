@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Hi General Affair! &#128516; </h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboardAdmin" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                <a href="show" class="text-slate-400">Available Application</a>
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">List of Application</h2>
                    <p class="text-xs text-gray-400 mt-1">*Click on item name to <strong>print out</strong> application detail</p>
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

                            @foreach ($permohonans as $permohonan)
                            <tr>
                                <td class="text-center">
                                    <button data-id="{{ $permohonan->id }}"
                                        data-url="{{ url('/permohonan/'.$permohonan->id.'/detail') }}"
                                        style=" text-decoration: underline;color: blue;"
                                        class="ajax-modal-btn bg-white-600 text-black btn border-white-600 hover:text-custom-500 hover:bg-custom-200 hover:border-custom-500 focus:text-white focus:bg-custom-300 focus:border-custom-500 focus:ring focus:ring-custom-100 active:text-custom-500 active:bg-custom-300 active:border-custom-500 active:ring active:ring-custom-100">
                                        {{ $permohonan->no_permohonan }}
                                    </button>
                                </td>
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
                    @elseif($permohonan->status->nama_status == 'Rejected') bg-red-100 text-red-800
                    @elseif($permohonan->status->nama_status == 'On Progress') bg-orange-300 text-orange-800
                    @elseif($permohonan->status->nama_status == 'Finished') bg-emerald-100 text-emerald-800
                    @endif">
                                        {{ $permohonan->status->nama_status ?? 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $permohonan->pemohon->username ?? '-' }}</td>
                            </tr>
                            @endforeach
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
$('#myTable').DataTable({
    buttons: [
        'copy', 'pdf', 'print'
    ],
    language: {
        search: "_INPUT_",
        searchPlaceholder: "Search data..."
    },


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
                <input type="hidden" name="id" value="${data.id}">
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
                <input type="text" id="urgency" class="form-input border-slate-200 bg-slate-100 " value="${data.kepentingan}" disabled>
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
                <label for="created_at" class="inline-block mb-2 text-base font-medium">Application Date : <span class="text-red-500"></span></label>
                <input type="text" id="created_at" name="created_at" class="form-input border-slate-200 bg-slate-100 " value="${data.created_at}" disabled>
            </div>
            <div class="mb-3">
                <label for="approved_at" class="inline-block mb-2 text-base font-medium">Approved Date : <span class="text-red-500"></span></label>
                <input type="text" id="approved_at" name="approved_at" class="form-input border-slate-200 bg-slate-100 " value="${data.approved_at}" disabled>
            </div>
            <div class="mb-3">
                <label for="on_progress_at" class="inline-block mb-2 text-base font-medium">On Progress Date : <span class="text-red-500"></span></label>
                <input type="text" id="on_progress_at" name="on_progress_at" class="form-input border-slate-200 bg-slate-100 " value="${data.on_progress_at}" disabled>
            </div>
            <div class="mb-3">
                <label for="finished_at" class="inline-block mb-2 text-base font-medium">Finished Date : <span class="text-red-500"></span></label>
                <input type="text" id="finished_at" name="tgl_selesai" class="form-input border-slate-200 bg-slate-100 " value="${data.finished_at}" disabled>
            </div>
            <div class="mb-3 md:col-span-2">
                <label for="username" class="inline-block mb-2 text-base font-medium">Username : <span class="text-red-500"></span></label>
                <input type="text" id="username" name="username" class="form-input border-slate-200 bg-slate-100 " value="${data.username}" disabled>
            </div>
            <div class="mb-3">
              <label class="block mb-2 text-base font-medium">Before :</label>
              <img src="/storage/app/public/${data.foto_sebelum}" alt="Foto Item" class="w-40 h-40 object-cover border rounded-md ">
            </div>
            <div class="mb-3">
              <label class="block mb-2 text-base font-medium">After:</label>
              <img src="/storage/app/public/${data.foto_sesudah}" alt="Foto Item" class="w-40 h-40 object-cover border rounded-md">
            </div>
            
            <!--<button type="button" id="printBtn" dataset-id="${data.id}" class="finished m-4 text-white bg-green-500 btn ...">Print</button>-->
            <div class="mb-3 md:col-span-2">
            <button type="button" id="ISOBtn" data-id="28" class="m-4 text-white bg-red-500 btn ..." 
            style="width: 95%;background-color: blue;">Print Application(ISO)</button>
            </div>
            
        </div>
    `;
   
                // const printBtn = document.getElementById('printBtn');
                // printBtn.addEventListener('click', function() {
                //     const idPrint = data.id;
                //     Swal.fire({
                //         title: 'Are you sure?',
                //         text: "Application will be printed!",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonColor: '#3085d6',
                //         cancelButtonColor: '#d33',
                //         confirmButtonText: 'Sure!',
                //         cancelButtonText: 'Cancel'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             window.open(`/print/${idPrint}`, '_blank');
                //             if (response.success) {
                //                 Swal.fire({
                //                     icon: 'success',
                //                     title: 'Done!',
                //                     text: '{{ session("success") }}',
                //                     timer: 2500,
                //                     showConfirmButton: false
                //                 });
                //             } else {
                //                 Swal.fire({
                //                     icon: 'error',
                //                     title: 'Failed!',
                //                     text: '{{ session("error") }}',
                //                     timer: 2500,
                //                     showConfirmButton: false
                //                 });
                //             }
                //             location.reload();
                //         } else if (result.dismiss === Swal.DismissReason
                //             .cancel) {
                //             Swal.fire({
                //                 icon: 'info',
                //                 title: 'Cancelled',
                //                 text: 'Status will not be updated',
                //                 timer: 2500,
                //                 showConfirmButton: false
                //             });
                //         }
                //     });
                // });

                document.getElementById('alasan').innerHTML = data.alasan_permohonan;



                const ISOBtn = document.getElementById('ISOBtn');
                ISOBtn.addEventListener('click', function() {
                    const idPrint = data.id;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "ISO will be printed!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sure!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open(`/printISO/${idPrint}`, '_blank');
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
                        } else if (result.dismiss === Swal.DismissReason
                            .cancel) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Cancelled',
                                text: 'Status will not be updated',
                                timer: 2500,
                                showConfirmButton: false
                            });
                        }
                    });
                });

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

function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    } else {
        preview.src = "";
        preview.classList.add('hidden');
    }
}
let openModalId = null;
let openDrawerId = null;
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
// Read more functionality untuk alasan panjang
document.querySelectorAll('.read-more').forEach(button => {
    button.addEventListener('click', function() {
        const fullText = this.getAttribute('data-full-text');
        this.parentElement.innerHTML = fullText;
    });
});
</script>
@endsection