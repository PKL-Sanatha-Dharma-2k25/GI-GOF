@extends('content.app')
@section('content')
<link rel="stylesheet" href="public/assets/styles/choices.min.css" />
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:nama_items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Hi {{session('user.username')}} ! &#128516;</h5>
        </div>
        <ul class="flex nama_items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">Dashboard</a>
            </li>
            <li class="text-slate-700">
                Create an Application
            </li>
        </ul>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h4 class="mb-4 text-15 text-center">Please fill out the application form below</h4>
                    
            <h1 class="text-xl font-bold text-black capitalize dark:text-black">Application Form</h1>
            <form method="POST" action="{{ url('process/save') }}" id="createApplicationForm"
                enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-black dark:text-gray-200" for="nama_barang"><strong>Item Name</strong></label>
                        <select name="nama_barang[]" id="nama_barang" type="text" multiple="multiple" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border
                            border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300
                            dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500
                            focus:outline-none focus:ring">
                        </select>
                        <span class="text-sm text-gray-500">If items is not listed, please type then press Enter</span>
                        
                        <!-- Container untuk daftar barang yang dipilih -->
                        <div id="jumlahContainer" class="mt-4 space-y-3"></div>
                    </div>

                    <div>
                        <label class="text-black dark:text-gray-200" for="lokasi"><strong>Location</strong></label>
                        <select name="lokasi" id="lokasi" type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        </select>
                        <span class="text-sm text-gray-500">If location is not listed, please type then press Enter</span>
                    </div>
                    
                    <div>
                        <label class="text-black dark:text-gray-200" for="jenis_permohonan"><strong>Application Type</strong></label>
                        <select name="jenis_permohonan" id="jenis_permohonan" type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        </select>
                        <span class="text-sm text-gray-500">Please select the application type</span>
                    </div>
    
                    <div>
                        <label class="text-black dark:text-gray-200" for="alasan_permohonan_input"><strong>Reason</strong></label>
                        <div id="alasan_permohonan_input" style="height: 150px;"></div>
                        <input type="hidden" name="alasan_permohonan" id="alasan_permohonan">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-black">
                            <strong>Upload photo</strong>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
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
                                    <p class="pl-1 text-black"> or drag and drop</p>
                                </div>
                                <p class="text-xs text-black">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                                <img id="preview" src="" alt="Preview Foto" class="mt-3 w-40 hidden mx-auto">
                            </div>
                        </div>
                    </div>
                     <div>
                        <label class="text-black dark:text-gray-200" id="kepentingan" for="kepentingan"><strong>Urgency</strong></label>
                        <select id="kepentingan" name="kepentingan"
                            class="kepentingan block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                            <option>Sangat Mendesak</option>
                            <option>Mendesak</option>
                            <option>Normal</option>
                        </select>
                        <span class="text-sm text-gray-500">Please select the importance level</span>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button id="submitButton"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-sky-600 rounded-md hover:bg-sky-600 focus:outline-none focus:bg-sky-600"
                        type="button">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.item-card {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
}

.item-card:hover {
    border-color: #d1d5db;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
}

.item-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 15px;
}

.remove-btn {
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 4px 12px;
    font-size: 13px;
    cursor: pointer;
    transition: background 0.2s;
}

.remove-btn:hover {
    background: #dc2626;
}

.item-inputs {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 12px;
}

.input-group {
    display: flex;
    flex-direction: column;
}

.input-group label {
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 4px;
}

.input-group input,
.input-group textarea {
    border: 1px solid #d1d5db;
    border-radius: 4px;
    padding: 8px 10px;
    font-size: 14px;
    transition: border-color 0.2s;
}

.input-group input:focus,
.input-group textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.input-group textarea {
    resize: vertical;
    min-height: 60px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let url = "{{url('/process/getNamaBarang')}}";
    let container = document.getElementById('jumlahContainer');
    fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('nama_barang');
            select.innerHTML = '';
            items = data.data
            console.log(items);
            items.forEach(item => {
                let option = document.createElement('option');
                option.value = item.id;
                option.text = item.nama_barang;
                select.appendChild(option);
            });
        })
    
    $('#nama_barang').select2({
        theme: "bootstrap-5",
        tags: true,
        placeholder: "Select or type the item name",
        minimumInputLength: 0,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        },
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true
            }
        },
    });
    
    let itemData = {};

    $('#nama_barang').on('change', function() {
        const select = this;
        
        // Simpan data lama
        document.querySelectorAll('[data-item-id]').forEach(card => {
            const id = card.getAttribute('data-item-id');
            const jumlahInput = card.querySelector('[name="jumlah_barang[]"]');
            const keteranganInput = card.querySelector('[name="keterangan_barang[]"]');
            
            itemData[id] = {
                jumlah: jumlahInput.value,
                keterangan: keteranganInput.value
            };
        });

        // Bersihkan container
        container.innerHTML = '';

        // Render ulang berdasarkan barang yang dipilih
        Array.from(select.selectedOptions).forEach(option => {
            const id = option.value;
            const nama = option.text;

            const card = document.createElement('div');
            card.className = 'item-card';
            card.setAttribute('data-item-id', id);

            card.innerHTML = `
                <div class="item-header">
                    <span class="item-name">${nama}</span>
                    <button type="button" class="remove-btn" onclick="removeItem('${id}', '${nama}')">
                        <i class="ri-close-line"></i> Remove
                    </button>
                </div>
                <div class="item-inputs">
                    <div class="input-group">
                        <label>Quantity</label>
                        <input type="number" 
                               name="jumlah_barang[]" 
                               min="1" 
                               value="${itemData[id]?.jumlah || 1}"
                               required>
                    </div>
                    <div class="input-group">
                        <label>Notes/Description</label>
                        <textarea name="keterangan_barang[]" 
                                  placeholder="Enter item notes or description...">${itemData[id]?.keterangan || ''}</textarea>
                    </div>
                </div>
                <input type="hidden" name="barang_id[]" value="${id}">
            `;

            container.appendChild(card);
        });
    });

    $('.kepentingan').select2({
        theme: "bootstrap-5",
        placeholder: "Select Importance Level",
        minimumResultsForSearch: -1,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        }
    });
    
    $('#nama_barang').on('select2:select', function(e) {
    let data = e.params.data;
    
    if (data.newTag) {
        let namaFormatted = capitalizeWord(data.text);
        const selectElement = $(this);
        
        // Disable select saat proses save
        selectElement.prop('disabled', true);
        
        // Tampilkan loading indicator
        Swal.fire({
            title: 'Saving new item...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        fetch("{{url('/process/addMasterBarang')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                nama_barang: namaFormatted
            })
        })
        .then(res => res.json())
        .then(response => {
            
            selectElement.find(`option[value="${data.text}"]`).remove();
            
           
            const newOption = new Option(response.nama_barang, response.id, true, true);
            selectElement.append(newOption);
            
            // Update selected values
            let currentValues = selectElement.val() || [];
            currentValues = currentValues.filter(v => v !== data.text);
            currentValues.push(response.id);
            
            selectElement.val(currentValues).trigger('change');
            
            // Enable select
            selectElement.prop('disabled', false);
            
            // Close loading
            Swal.close();
            
            // Success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: `Item "${response.nama_barang}" has been added`,
                timer: 1500,
                showConfirmButton: false
            });
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Hapus option temporary
            selectElement.find(`option[value="${data.text}"]`).remove();
            selectElement.trigger('change');
            
            // Enable select
            selectElement.prop('disabled', false);
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Failed, please try again.',
            });
        });
    }
});
});

// Function untuk remove item
window.removeItem = function(id, nama) {
    const select = $('#nama_barang');
    const values = select.val();
    const newValues = values.filter(v => v != id);
    select.val(newValues).trigger('change');
}

// Select Jenis Permohonan
document.addEventListener('DOMContentLoaded', function() {
    let url = "{{url('/process/getJenisPermohonan')}}";
    fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('jenis_permohonan');
            select.innerHTML = '';
            items = data.data
            items.forEach(item => {
                let option = document.createElement('option');
                option.value = item.nama_jenis_permohonan;
                option.text = item.nama_jenis_permohonan;
                select.appendChild(option);
            });
        })
    $('#jenis_permohonan').select2({
        theme: "bootstrap-5",
        placeholder: "Select the application type",
        minimumResultsForSearch: -1,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        }
    });
});

// Select Lokasi Kendala
document.addEventListener('DOMContentLoaded', function() {
    let url = "{{url('/process/getLokasiKendala')}}";
    fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('lokasi');
            select.innerHTML = '';
            items = data.data
            items.forEach(item => {
                let option = document.createElement('option');
                option.value = item.nama_lokasi;
                option.text = item.nama_lokasi;
                select.appendChild(option);
            });
        })
    $('#lokasi').select2({
        theme: "bootstrap-5",
        placeholder: "Select or type the location",
        tags: true,
        minimumInputLength: 0,
        width: function() {
            return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                '100%' : 'style';
        },
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true
            }
        },
    });
});

$('#lokasi').on('select2:select', function(e) {
    let data = e.params.data;
    if (data.newTag) {
        let namaFormatted = capitalizeWord(data.text);
        fetch("{{url('/process/addMasterLokasi')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    nama_lokasi: namaFormatted
                })
            })
            .then(res => res.json())
            .then(response => {
                const newOption = new Option(response.nama_lokasi, response.id, true, true);
                this.appendChild(newOption);
                $(this).trigger('change');
            })
            .catch(() => alert("Gagal menyimpan lokasi baru!"));
    }
});

function capitalizeWord(str) {
    str = str.trim().toLowerCase();
    return str.charAt(0).toUpperCase() + str.slice(1);
}

document.getElementById('submitButton').addEventListener('click', function() {
    let lokasi = document.getElementById('lokasi').value.trim();
    let nama_barang = document.getElementById('nama_barang');
    let jenis = document.getElementById('jenis_permohonan');
    
    Swal.fire({
        title: 'Are You Sure?',
        text: "Application will be created!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('alasan_permohonan').value = quill.root.innerHTML;
            document.getElementById('createApplicationForm').submit();
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                timer: 2500,
                showConfirmButton: false
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                icon: 'info',
                title: 'Canceled',
                text: 'Application will not be proceed.',
                timer: 2500,
                showConfirmButton: false
            });
        }
    });
});

let quill = new Quill('#alasan_permohonan_input', {
    theme: 'snow'
});

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

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#tgl_pengajuan", {
        theme: "material_green",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
});
</script>

@endsection