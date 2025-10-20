<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Sign Up | GI-GFRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Globalindo Report & Repair" name="description">
    <meta content="MIS Team" name="author">

    <link rel="shortcut icon" href="{{ asset('public/assets/images/logo/icon.PNG') }}">
    <script src="{{ asset('public/assets/js/layout.js') }}"></script>
    <link href="{{ asset('public/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/tailwind2.css') }}">
    <script src="{{ asset('public/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="font-public">

    <div
        class="relative flex flex-col md:flex-row w-full overflow-hidden bg-gradient-to-r from-custom-900 to-custom-800">
        <!-- Left: Login Card -->
        <div
            class="min-h-[calc(100vh_-_theme('spacing.4')_*_2)] mx-3 md:w-[28rem] lg:w-[40rem] shrink-0 px-6 md:px-8 lg:px-10 py-10 md:py-14 flex items-center justify-center m-4 bg-white rounded z-10 relative mx-3 md:mx-auto xl:mx-4 ml-3 md:ml-0">
            <div class=" flex-col w-full h-full ">
                <div class="my-auto">
                    <!-- <img src="{{ asset('public/assets/images/logo/gi.PNG') }}" alt="Logo GI" class="block mx-auto w-[200px] h-[40px]"> -->
                    <img style="width:400px;height:60px" src="{{ asset('public/assets/images/logo/gi.PNG') }}" alt=""
                        class="block mx-auto h-7">
                    <h6 class="text-center">Jl. Jombor - Pokak 01/01, Ceper, Klaten</h6>
                    <h6 class="text-center">Jawa Tengah - Indonesia</h6>

                    <div class="lg:w-[25rem] mx-auto">
                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="emailLogin">
                                <form action="{{ url('auth/sign_up') }}" method="POST" class="mt-10" id="signUpForm">
                                    @csrf

                                    <!-- Flash Messages -->
                                    <div class="flashMsg">
                                        @if (session('msgErr'))
                                        <div
                                            class="p-3 mb-3 text-base text-red-500 border border-red-200 rounded-md bg-red-50">
                                            {{ session('msgErr') }}
                                        </div>
                                        @endif
                                        @if (session('msgOut'))
                                        <div
                                            class="p-3 mb-3 text-base text-green-500 border border-green-200 rounded-md bg-green-50">
                                            {{ session('msgOut') }}
                                        </div>
                                        @endif
                                    </div>
                                    <!--Fullname-->
                                    <div class="mb-3">
                                        <label for="fullname"
                                            class="inline-block mb-2 text-base font-medium">Fullname</label>
                                        <input type="text" id="fullname" name="fullname"
                                            class="form-input w-full border-slate-200 focus:outline-none focus:border-custom-500 placeholder:text-slate-400"
                                            placeholder="Enter fullname" autofocus required>
                                        <div id="fullname-error" class="hidden mt-1 text-sm text-red-500">Please enter
                                            fullname</div>
                                    </div>
                                    <!-- Username -->
                                    <div class="mb-3">
                                        <label for="username"
                                            class="inline-block mb-2 text-base font-medium">Username</label>
                                        <input type="text" id="username" name="username"
                                            class="form-input w-full border-slate-200 focus:outline-none focus:border-custom-500 placeholder:text-slate-400"
                                            placeholder="Enter username" autofocus required>
                                        <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter
                                            username</div>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password"
                                            class="inline-block mb-2 text-base font-medium">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-input w-full border-slate-200 focus:outline-none focus:border-custom-500 placeholder:text-slate-400"
                                            placeholder="Enter password" required>
                                        <div id="password-error" class="hidden mt-1 text-sm text-red-500">Please enter
                                            password</div>
                                    </div>
                                    <!-- Password Confirmation -->
                                    <div class="mb-3">
                                        <label for="password_confirmation"
                                            class="inline-block mb-2 text-base font-medium">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-input w-full border-slate-200 focus:outline-none focus:border-custom-500 placeholder:text-slate-400"
                                            placeholder="Confirm password" required>
                                        <div id="password-confirmation-error" class="hidden mt-1 text-sm text-red-500">
                                            Please confirm password
                                        </div>
                                    </div>
                                    <!-- Department -->
                                    <div class="mb-3">
                                        <label for="dept"
                                            class="inline-block mb-2 text-base font-medium">Department</label>

                                        <ul id ="radios" class="grid grid-cols-2 gap-x-4 gap-y-2 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg p-3"
                                            required>

                                            <!-- MIS -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-mis" type="radio" value="MIS" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                        required>
                                                    <label for="dept-mis" class="ml-2 text-sm font-medium">MIS</label>
                                                </div>
                                            </li>

                                            <!-- GA -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-ga" type="radio" value="GA" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-ga" class="ml-2 text-sm font-medium">GA</label>
                                                </div>
                                            </li>

                                            <!-- Factory -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-factory" type="radio" value="FC" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-factory"
                                                        class="ml-2 text-sm font-medium">Factory</label>
                                                </div>
                                            </li>

                                            <!-- Production -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-production" type="radio" value="PR" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-production"
                                                        class="ml-2 text-sm font-medium">Production</label>
                                                </div>
                                            </li>

                                            <!-- Warehouse -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-warehouse" type="radio" value="WH" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-warehouse"
                                                        class="ml-2 text-sm font-medium">Warehouse</label>
                                                </div>
                                            </li>


                                            <!-- QC -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-qc" type="radio" value="QC" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-qc" class="ml-2 text-sm font-medium">QC</label>
                                                </div>
                                            </li>

                                            <!-- HR -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-hr" type="radio" value="HRD" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-hr" class="ml-2 text-sm font-medium">HR</label>
                                                </div>
                                            </li>

                                            <!-- PPIC -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-ppic" type="radio" value="PPIC" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-ppic" class="ml-2 text-sm font-medium">PPIC</label>
                                                </div>
                                            </li>

                                            <!-- Accounting -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-accounting" type="radio" value="ACT" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-accounting"
                                                        class="ml-2 text-sm font-medium">Accounting</label>
                                                </div>
                                            </li>

                                             <!-- Incoming QC -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-iqc" type="radio" value="IQC" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-iqc"
                                                        class="ml-2 text-sm font-medium">Incoming QC</label>
                                                </div>
                                            </li>

                                             <!-- Finish Good -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-fg" type="radio" value="FG" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-fg"
                                                        class="ml-2 text-sm font-medium">Finish Good</label>
                                                </div>
                                            </li>

                                             <!-- Exim -->
                                            <li>
                                                <div class="flex items-center">
                                                    <input id="dept-exim" type="radio" value="EXIM" name="dept"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="dept-exim"
                                                        class="ml-2 text-sm font-medium">EXIM</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    
                                    <!-- Sign Up Button -->
                                    <div class="mt-10">
                                        <button type="button"
                                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:bg-custom-600 focus:ring focus:ring-custom-100"
                                            id="btnSignUp">
                                            Sign Up
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-5">
                    <p class="mb-0 text-center text-sm text-slate-500">
                        © <script>
                        document.write(new Date().getFullYear())
                        </script> MIS Team.
                        <a href="http://themesdesign.in" target="_blank"
                            class="underline transition-all duration-200 ease-linear text-slate-800 hover:text-custom-500">
                            PT Globalindo Intimates
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right: Branding + Animation -->
        <div
            class="relative z-10 flex items-center justify-center min-h-screen px-6 md:px-8 lg:px-10 text-center grow py-10 md:py-14">
            <div>
                <img src="{{ asset('public/assets/images/logo/logo-gi-transparant.png') }}" alt="Logo GI"
                    class="block mx-auto w-20 h-[70px]">
                <div class="mt-2 text-center">
                    <h2 class="mt-4 mb-3 capitalize text-custom-50">GI-GFRM</h2>
                    <p class="max-w-2xl mx-auto text-custom-300 text-base">Globalindo Intimates - General Form Request and Maintenance | MIS
                        Team </p>
                </div>

                <lottie-player src="{{ asset('public/assets/images/logo/Animation.json') }}" speed="1"
                    style="width: 450px; height: 450px" loop autoplay direction="1" mode="normal" class="mx-auto">
                </lottie-player>
            </div>
        </div>
    </div>
    <script>
    const signUpBtn = document.getElementById('btnSignUp');

    signUpBtn.addEventListener('click', function() {
        let username = document.getElementById('username').value.trim();
        let fullname = document.getElementById('fullname').value.trim();
        let pass = document.getElementById('password').value;
        let confirm = document.getElementById('password_confirmation').value;
        const radios = document.querySelectorAll('input[name="dept"]');
        const selected = Array.from(radios).some(radio => radio.checked);
        if (fullname === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter fullname first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }else if (username === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter username first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }else if (pass === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter password first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
            
        }
        else if (pass.length < 6) {
            Swal.fire({
                title: 'Oops!',
                text: "Password min 6 characters!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }
        else if (confirm === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter password confirm first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }else if (pass != confirm) {
            Swal.fire({
                title: 'Oops!',
                text: "Passwords do not match!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }else if (!selected) {
            Swal.fire({
                title: 'Oops!',
                text: "Please select your department!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        }

        let url = "{{ url('/auth/validate') }}" + '?username=' + encodeURIComponent(username);
        let payload = {
            username: username,
        };
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                payload

            }).then(response => response.json())
            .then(data => {

                if (data.exists) {
                    Swal.fire({
                        title: 'Oops!',
                        text: "Username has been taken! Please use another",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Sure!',
                    });
                    return;
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Your data will be saved!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sure!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('signUpForm').submit();
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
                                text: 'Cancelled!',
                                timer: 2500,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });

    });
    </script>
    <!-- JS Libraries -->
    <script src="{{ asset('public/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('public/assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ asset('public/assets/js/tailwick.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
</body>

</html>