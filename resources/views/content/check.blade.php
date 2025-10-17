@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            @if (session('success'))
            <div class="p-3 mb-3 text-base text-green-500 border border-green-200 rounded-md bg-green-50">
                {{ session('success') }}
            </div>
            @endif
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
                                <th class="text-center cursor-pointer hover:bg-gray-100">Work Est</th>
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
                                <td class="text-center">{{ $permohonan->est_pengerjaan ?? '- ' }} <strong>Days</strong>
                                </td>
                                <td class="td_action text-center">
                                    <button type="button" id="deleteBtn" data-id="{{ $permohonan->id }}"
                                        data-url="{{  url('/process/'.$permohonan->id.'/delete') }}"
                                        class="deleteBtn finished m-4 text-white bg-red-500 btn ">
                                        Cancel
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
<div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden" id="blurDiv"></div>
<div id="ModalContoh" class="fixed inset-0 z-drawer flex items-start justify-center pt-10 overflow-y-auto hidden">
    <div class="bg-white shadow rounded-md w-screen lg:w-[40rem] flex flex-col">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16">Cancel Application</h5>
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
        // Tampilkan modal
        toggleElementState('ModalContoh', true, 200);
        toggleElementState('blurDiv', true, 200);

        document.querySelector('#ModalContoh .modal-body').innerHTML = `
            <form id="submit_GA_note" method="POST" action="{{ url('process/cancel') }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="status_id" value="6">
                <div class="p-4 border-b border-slate-200">
                    <label class="inline-block mb-2 text-base font-medium">
                        Cancel Reason: <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="catatan_pemohon" 
                        class="form-input border-slate-200 w-full rounded-md" 
                        rows="4"
                        placeholder="Please fill this input..."
                        required></textarea>
                </div>
                <div class="flex items-center justify-end gap-2 p-4">
                    <button 
                        type="button" 
                        onclick="closeAjaxModal()" 
                        class="px-4 py-2 text-slate-600 bg-slate-100 rounded hover:bg-slate-200">
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                        Submit
                    </button>
                </div>
            </form>
        `;


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

function closeAjaxModal() {
    toggleElementState('ModalContoh', false, 200);
    toggleElementState('blurDiv', false, 200);
}

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