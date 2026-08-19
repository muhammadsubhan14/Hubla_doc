<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login · Hubla/doc</title>@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="grid min-h-screen grid-cols-2 bg-[#263b32] max-md:grid-cols-1">
    <div class="flex flex-col bg-[#f5f3ee] px-[12%] py-[10vh] max-md:px-6 max-md:py-[35px]"><a
            class="mb-auto flex items-center gap-2.5 text-lg font-extrabold tracking-[-.04em] max-md:mb-[100px]"
            href="{{ route('home') }}"><span
                class="grid h-[31px] w-[31px] place-items-center bg-[#17221d] text-sm text-[#d8f06a]">H</span><span>Hubla<span
                    class="text-[#728078]">/doc</span></span></a>
        <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Ruang admin</p>
        <h1 class="m-0 text-[57px] font-extrabold leading-none tracking-[-.07em] max-md:text-[47px]">Selamat
            datang<br><em class="not-italic text-[#839a38]">kembali.</em></h1>
        <p class="my-[22px] mb-[35px] max-w-[370px] text-[13px] leading-6 text-[#728078]">Kelola arsip kegiatan dan
            cerita visual Hubla.</p>
        @if (session('success'))
            <p class="mb-4 max-w-[370px] bg-[#e4f0d6] px-4 py-3 text-xs text-[#4d6832]">{{ session('success') }}</p>
        @endif
        <form class="grid max-w-[370px] gap-4" method="POST" action="{{ route('admin.login.store') }}">
            @csrf<label class="grid gap-2 text-[11px] text-[#728078]">Email<input
                    class="border border-[#dce1da] bg-white p-[13px] outline-[#a5bd53]" type="email" name="email"
                    value="{{ old('email') }}" required autofocus></label><label
                class="grid gap-2 text-[11px] text-[#728078]">Password<input
                    class="border border-[#dce1da] bg-white p-[13px] outline-[#a5bd53]" type="password" name="password"
                    required></label><label class="flex items-center gap-2 text-[11px] text-[#728078]"><input
                    class="accent-[#263b32]" type="checkbox" name="remember"> Ingat saya</label>
            @error('email')
                <p class="text-[11px] text-[#a33d35]">{{ $message }}</p>
            @enderror
            <button class="mt-2 w-full bg-[#263b32] px-4 py-3 text-[11px] text-white hover:bg-[#385747]"
                type="submit">Masuk ke workspace ↗</button>
        </form>
        <p class="mt-5 max-w-[370px] text-center text-[11px] text-[#728078]">Admin baru? <a
                class="font-semibold text-[#69803d] underline" href="{{ route('admin.register') }}">Daftar akun
                admin</a></p>
    </div>
    <div
        class="grid -rotate-2 place-items-center bg-[#b7cd68] text-center font-extrabold leading-[.82] tracking-[-.09em] text-[#263b32] text-[clamp(55px,8vw,120px)] max-md:hidden">
        ARCHIVE<br>THE<br>MOMENTS</div>
</body>

</html>
