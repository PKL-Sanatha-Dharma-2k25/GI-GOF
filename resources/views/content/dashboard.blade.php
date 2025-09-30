@extends('content.app')
@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
        <div class="grow">
            <h5 class="text-16">Dashboard</h5>
        </div>
        <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
            <li
                class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400">
                <a href="dashboard" class="text-slate-400">GI-RR</a>
            </li>
            <li class="text-slate-700">
                Dashboard
            </li>
        </ul>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="grow">
                <h1 class="text-56 text-center text-slate-500">Welcome to Globalindo Report&Repair System (GI-RR)</h1>
            </div>
        </div>
        <lottie-player src="{{ asset('public/assets/images/logo/work_FUV.json') }}" speed="0.5"
            style="width: 450px; height: 450px" loop autoplay direction="1" mode="normal" class="mx-auto">
        </lottie-player>
    </div>

</div>
@endsection