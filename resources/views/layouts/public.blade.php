<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Hubla Documentation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f8fa] text-[#102a43] antialiased">
    <header class="flex h-[72px] items-center justify-between border-b border-[#d9e2ec] bg-white px-6 md:px-[8vw]">
        <a class="flex items-center gap-2.5 text-lg font-extrabold tracking-[-.04em]" href="{{ route('home') }}"><span
                class="grid h-[31px] w-[31px] place-items-center bg-[#102a43] text-sm text-[#d8f06a]">H</span><span>Hubla<span
                    class="text-[#829ab1]">/doc</span></span></a>
        <a class="font-mono text-[11px] uppercase tracking-wide text-[#526b82] transition hover:text-[#6f8535]"
            href="/admin/login">Admin workspace <span class="text-[#839a38]">↗</span></a>
    </header>
    <main>@yield('content')</main>
    <footer
        class="flex justify-between border-t border-[#d9e2ec] bg-white px-6 py-6 font-mono text-[10px] uppercase tracking-wide text-[#829ab1] md:px-[8vw] max-md:block max-md:space-y-2">
        <span>Hubla Documentation</span><span>Visual archive for meaningful work.</span>
    </footer>
</body>

</html>
