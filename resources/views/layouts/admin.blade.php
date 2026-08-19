<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin · Hubla Documentation' }}</title>@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f8fa] text-[#102a43]">
    <aside
        class="fixed inset-y-0 left-0 z-10 flex w-[245px] flex-col border-r border-[#d9e2ec] bg-white px-[22px] py-7 text-[#102a43] max-md:w-[65px] max-md:px-2">
        <a class="mb-[75px] flex items-center gap-2.5 text-lg font-extrabold tracking-[-.04em] max-md:mb-[55px]"
            href="{{ route('admin.dashboard') }}"><span
                class="grid h-[31px] w-[31px] place-items-center bg-[#102a43] text-sm text-[#d8f06a]">H</span><span
                class="max-md:hidden">Hubla<span class="text-[#8ca097]">/doc</span></span></a>
        <nav class="grid gap-1"><a
                class="p-2.5 text-xs text-[#526b82] hover:bg-[#eef4f0] hover:text-[#102a43] {{ request()->routeIs('admin.dashboard') ? 'bg-[#eef4f0] font-semibold text-[#102a43]' : '' }}"
                href="{{ route('admin.dashboard') }}">◈ <span class="max-md:hidden">Dashboard</span></a>
            <p class="mt-7 px-2.5 pb-1 font-mono text-[10px] uppercase text-[#829ab1] max-md:hidden">Dokumentasi</p><a
                class="p-2.5 text-xs text-[#526b82] hover:bg-[#eef4f0] hover:text-[#102a43] {{ request()->routeIs('admin.documentations.*') ? 'bg-[#eef4f0] font-semibold text-[#102a43]' : '' }}"
                href="{{ route('admin.documentations.index') }}">▦ <span class="max-md:hidden">Semua
                    dokumentasi</span></a><a class="p-2.5 text-xs text-[#b3c0b8] hover:bg-white/10 hover:text-white"
                href="{{ route('admin.documentations.create') }}">＋ <span class="max-md:hidden">Tambah
                    dokumentasi</span></a>
            <p class="mt-7 px-2.5 pb-1 font-mono text-[10px] uppercase text-[#829ab1] max-md:hidden">PIC</p><a
                class="p-2.5 text-xs text-[#526b82] hover:bg-[#eef4f0] hover:text-[#102a43] {{ request()->routeIs('admin.persons.*') ? 'bg-[#eef4f0] font-semibold text-[#102a43]' : '' }}"
                href="{{ route('admin.persons.index') }}">◎ <span class="max-md:hidden">Kelola PIC</span></a>
        </nav>
        <form class="mt-auto" method="POST" action="{{ route('admin.logout') }}">@csrf<button
                class="border-0 bg-transparent p-3 text-left text-xs text-[#829ab1] hover:text-[#a33d35] max-md:text-[0px]"
                type="submit">↪
                <span class="max-md:hidden">Keluar</span></button></form>
    </aside>
    <div class="ml-[245px] min-w-0 max-md:ml-[65px]">
        <header
            class="flex h-[69px] items-center justify-end border-b border-[#dce1da] px-[5%] font-mono text-[11px] text-[#728078] max-md:h-[60px] max-md:justify-between">
            <span
                class="hidden font-sans font-extrabold text-[#263b32] max-md:block">Hubla/doc</span><span>{{ auth()->user()->name }}</span>
        </header>
        <main class="max-w-[1300px] px-[5%] py-12 max-md:px-[18px] max-md:py-[30px]">
            @if (session('success'))
                <div class="mb-6 bg-[#e4f0d6] px-4 py-3 text-xs text-[#4d6832]">{{ session('success') }}</div>
                @endif @if ($errors->any())
                    <div class="mb-6 bg-[#fae5e1] px-4 py-3 text-xs text-[#943a31]">{{ $errors->first() }}</div>
                @endif @yield('content')
        </main>
    </div>
</body>

</html>
