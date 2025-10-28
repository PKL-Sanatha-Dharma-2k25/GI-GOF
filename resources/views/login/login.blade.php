<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Sign In | GI-GFRM</title>
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
     @vite(['resources/js/login.js'])
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="font-public">

    <div
        class="relative flex flex-col md:flex-row w-full overflow-hidden bg-gradient-to-r from-custom-900 to-custom-800">
        <!-- Left: Login Card -->
        <div
            class="loginCard min-h-[calc(100vh_-_theme('spacing.4')_*_2)] mx-3 md:w-[28rem] lg:w-[40rem] shrink-0 px-6 md:px-8 lg:px-10 py-10 md:py-14 flex items-center justify-center m-4 bg-white rounded z-10 relative mx-3 md:mx-auto xl:mx-4 ml-3 md:ml-0">
            <div class=" flex-col w-full h-full ">
                <div class="my-auto">
                    <!-- <img src="{{ asset('public/assets/images/logo/gi.PNG') }}" alt="Logo GI" class="block mx-auto w-[200px] h-[40px]"> -->
                    <img style="width:400px;height:60px" src="{{ asset('public/assets/images/logo/gi.PNG') }}" alt=""
                        class="block mx-auto h-7">
                    <h6 class="text-center">Jl. Jombor - Pokak 01/01, Ceper, Klaten</h6>
                    <h6 class="text-center">Jawa Tengah - Indonesia</h6>

                    <div class="lg:w-[25rem] mx-auto">
                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="usernameLogin">
                                <form action="{{ url('auth/sign_in') }}" method="POST" class="mt-10" id="signInForm">
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
                                        @if (session('msgUp'))
                                        <div
                                            class="p-3 mb-3 text-base text-blue-500 border border-blue-200 rounded-md bg-blue-50">
                                            {{ session('msgUp') }}
                                        </div>
                                        @endif
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

                                    <!-- Sign In Button & Create Account Button -->
                                    <div class="mt-10">
                                        Don't have an account?
                                        <a href="{{ url('/register') }}"
                                            class="font-medium text-sky-500 text-base">Create Account</a>
                                        <button type="button" id="btnSignIn"
                                            class="w-full text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:bg-custom-600 focus:ring focus:ring-custom-100">
                                            Sign In
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
                <img id="logo" src="{{ asset('public/assets/images/logo/logo-gi-transparant.png') }}" alt="Logo GI"
                    class="block mx-auto w-20 h-[70px]">
                <div class="mt-2 text-center">
                    <h2 id="info" class="mt-4 mb-3 capitalize text-custom-50">GI-GFRM</h2>
                    <p id="infoSub" class="max-w-2xl mx-auto text-custom-300 text-base">Globalindo Intimates - General Form Request and Maintenance | MIS
                        Team </p>
                </div>

                <lottie-player src="{{ asset('public/assets/images/logo/Animation.json') }}" speed="1"
                    style="width: 450px; height: 450px" loop autoplay direction="1" mode="normal" class="anim mx-auto">
                </lottie-player>
            </div>
        </div>
    </div>
    <!-- Main JS -->
    <script>
    const signInBtn = document.getElementById('btnSignIn');
    signInBtn.addEventListener('click', function() {
        let username = document.getElementById('username').value.trim();
        let pass = document.getElementById('password').value;
        if (username === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter username first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;
        } else if (pass === "") {
            Swal.fire({
                title: 'Oops!',
                text: "Please enter password first!",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ah i forgot, Sure!',
            });
            return;

        } else if (pass.length < 6) {
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
        let url = "{{ url('/auth/signInValidate') }}";
        let payload = {
            username: username,
            password: pass,
        };
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'

                },
                body: JSON.stringify(payload)

            }).then(response => response.json())
            .then(data => {
                if (data.message == "Incorrect password." || data.message ==  "These credentials do not match our records (username not found).") {
                    Swal.fire({
                        title: 'Oops!',
                        text: "Incorrect Password or Username",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ah i forgot, Sure!',
                    });
                    return;
                } else {
                    document.getElementById('signInForm').submit();
                    Swal.fire({
                        title: 'Success!',
                        text: "You'll be redirecting to dashboard page!",
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
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