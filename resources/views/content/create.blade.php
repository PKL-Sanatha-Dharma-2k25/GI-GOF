@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:nama_items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Buat Permohonan</h5>
        </div>
        <ul class="flex nama_items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                Buat Permohonan
            </li>
        </ul>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h6 class="mb-4 text-15">Silahkan masukkan informasi permohonan pengadaan/perbaikan anda</h6>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-2">
                <div class="flex flex-col">
                    <!-- component -->
                    <div class="max-w-4xl p-6 mx-auto bg-gray-500 rounded-md shadow-md dark:bg-gray-800 mt-20">
                        <h1 class="text-xl font-bold text-black capitalize dark:text-black">Pengadaan</h1>
                        <form method="POST" action="{{ url('process/save') }}" id="createApplicationForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                                <div>
                                    <label class="text-black dark:text-gray-200" for="nama_item">Nama item</label>
                                    <input name="nama_item" id="nama_item" type="text"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                </div>
                                <div>
                                    <label class="text-black dark:text-gray-200" id="kepentingan"
                                        for="kepentingan">Kepentingan</label>
                                    <select id="kepentingan" name="kepentingan"
                                        class="kepentingan block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                        <option>Sangat Mendesak</option>
                                        <option>Mendesak</option>
                                        <option>Normal</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-black dark:text-gray-200" for="alasan">Alasan</label>
                                    <textarea id="alasan" type="textarea" name="alasan"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                                </div>

                                <div>
                                    <label class="text-black dark:text-gray-200" for="tgl_pengajuan">Tanggal
                                        Pengajuan</label>
                                    <input id="tgl_pengajuan" type="date" name="tgl_pengajuan"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-black">
                                        Foto Item
                                    </label>
                                    <div
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-black" stroke="currentColor" fill="none"
                                                viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file_upload"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file </span>
                                                    <input id="file_upload" name="file_upload" type="file"
                                                        class="sr-only" onchange="previewImage(event)">
                                                </label>
                                                <p class="pl-1 text-black">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-black">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                            <img id="preview" src="" alt="Preview Foto" class="mt-3 w-40 hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button id="submitButton"
                                    class="px-6 py-2 leading-5 text-black transition-colors duration-200 transform bg-sky-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600 "
                                    type="button">Buat</button>
                            </div>
                        </form>
                    </div>



                </div>
                <div class="flex flex-col">

                </div>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('submitButton').addEventListener('click', function() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Permohonan akan dibuat!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, buat permohonan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('createApplicationForm').submit();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2500,
                showConfirmButton: false
            });
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                icon: 'info',
                title: 'Dibatalkan',
                text: 'Permohonan tidak jadi dibuat.',
                timer: 2500,
                showConfirmButton: false
            });
        }
    });
});




function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        preview.src = URL.createObjectURL(file); 
        preview.classList.remove('hidden'); // unhide image
    } else {
        preview.src = "";
        preview.classList.add('hidden'); 
    }
}
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#tgl_pengajuan", {
        dateFormat: "Y-m-d",
    });
});
document.addEventListener("DOMContentLoaded", function () {
    new TomSelect("#kepentingan", {
        create: false,   
        sortField: { field: "text", direction: "asc" },
    });
});
// Inisialisasi Choices.js untuk select
            const element = document.querySelector('.my-select');
            const choices = new Choices(element, {
                searchEnabled: true,
                removeItemButton: true
            });
</script>

@endsection