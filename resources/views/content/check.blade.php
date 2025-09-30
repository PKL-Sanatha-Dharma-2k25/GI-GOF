@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Permohonan Saya</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                Permohonan Saya
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
           <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Permohonan</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-center table-auto min-w-max" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nama_item', 'sort_order' => $sortBy == 'nama_item' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Nama Item
                                        @if($sortBy == 'nama_item')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center">Foto</th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'kepentingan', 'sort_order' => $sortBy == 'kepentingan' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Kepentingan
                                        @if($sortBy == 'kepentingan')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center max-w-xs">Alasan</th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'tgl_pengajuan', 'sort_order' => $sortBy == 'tgl_pengajuan' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Tanggal Pengajuan
                                        @if($sortBy == 'tgl_pengajuan')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'tgl_selesai', 'sort_order' => $sortBy == 'tgl_selesai' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Tanggal Selesai
                                        @if($sortBy == 'tgl_selesai')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'est_biaya', 'sort_order' => $sortBy == 'est_biaya' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Estimasi Biaya
                                        @if($sortBy == 'est_biaya')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'akt_biaya', 'sort_order' => $sortBy == 'akt_biaya' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Biaya Aktual
                                        @if($sortBy == 'akt_biaya')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>

                                <th class="text-center cursor-pointer hover:bg-gray-100">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'status', 'sort_order' => $sortBy == 'status' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1">
                                        Status
                                        @if($sortBy == 'status')
                                        <span>{{ $sortOrder == 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permohonans as $permohonan)
                            <tr>
                                <td class="text-center">{{ $permohonan->nama_item }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/'.$permohonan->foto_item_sebelum) }}"
                                        class="rounded w-20 h-20 object-cover cursor-pointer image-modal mx-auto"
                                        data-image-url="{{ asset('storage/'.$permohonan->foto_item_sebelum) }}"
                                        title="Klik untuk memperbesar">
                                </td>
                                <td class="text-center">
                                    <span class="px-2 py-1 rounded-full text-xs 
                    @if($permohonan->kepentingan == 'Sangat Mendesak') bg-red-100 text-red-800
                    @elseif($permohonan->kepentingan == 'Mendesak') bg-orange-100 text-orange-800
                    @else bg-green-100 text-green-800 @endif">
                                        {{ $permohonan->kepentingan }}
                                    </span>
                                </td>
                                <td class="text-center max-w-xs break-words whitespace-normal px-2 py-3 align-top">
                                    {{ Str::limit($permohonan->alasan, 100) }}
                                    @if(strlen($permohonan->alasan) > 100)
                                    <button class="text-blue-600 text-xs ml-1 read-more"
                                        data-full-text="{{ $permohonan->alasan }}">
                                        ...baca selengkapnya
                                    </button>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    {{ $permohonan->tgl_pengajuan ? \Carbon\Carbon::parse($permohonan->tgl_pengajuan)->format('Y/m/d') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $permohonan->tgl_selesai ? \Carbon\Carbon::parse($permohonan->tgl_selesai)->format('Y/m/d') : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $permohonan->est_biaya ? 'Rp ' . number_format($permohonan->est_biaya, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $permohonan->akt_biaya ? 'Rp ' . number_format($permohonan->akt_biaya, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-center">
                                    <span class="px-2 py-1 rounded-full text-xs 
                    @if($permohonan->status == 'Approved') bg-green-100 text-green-800
                    @elseif($permohonan->status == 'Pending') bg-blue-100 text-blue-800
                    @elseif($permohonan->status == 'Rejected') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $permohonan->status ?? 'Pending' }}
                                    </span>
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
<div id="ModalContoh" modal-center
    class="fixed flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen lg:w-[55rem] bg-white shadow rounded-md flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16">List Defect</h5>
            <button data-modal-close="ModalContoh"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500"><i data-lucide="x"
                    class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-1 xl:grid-cols-1 mx-5 ">
                <div class="mb-3">
                    <label for="inputText" class="inline-block mb-2 text-base font-medium">Text <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="inputText"
                        class="form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 disabled:border-slate-300 disabled:text-slate-500 placeholder:text-slate-400"
                        required>
                </div>
                <div>
                    <label for="textArea" class="inline-block mb-2 text-base font-medium">Example Textarea</label>
                    <textarea
                        class="form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 disabled:border-slate-300 disabled:text-slate-500 placeholder:text-slate-400"
                        id="textArea" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200">
        </div>
    </div>
</div>
<script>
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