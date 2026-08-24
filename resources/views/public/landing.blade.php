<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubla Documentation · Arsip Visual</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-x-hidden bg-[#0f1b26] font-sans text-white">
    <main class="relative min-h-screen overflow-hidden">
        <div
            class="absolute inset-0 grid grid-cols-2 gap-1 opacity-80 sm:grid-cols-4 lg:grid-cols-6">
            @forelse ($images as $index => $image)
                <img class="aspect-square h-full w-full object-cover transition duration-700 hover:scale-105"
                    src="{{ Storage::url($image->image_path) }}"
                    alt="{{ $image->documentation?->title ?? 'Dokumentasi kegiatan' }}">
            @empty
                <div class="col-span-full row-span-full bg-[#27445b]"></div>
            @endforelse
        </div>
        <div class="absolute inset-0 bg-[#0b1722]/15"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0b1722]/20 via-[#0b1722]/10 to-[#0b1722]/50"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,#0b172222_0%,#0b172244_42%,#0b172299_100%)]">
        </div>
        <header
            class="absolute left-0 right-0 top-0 z-10 flex items-center justify-between px-6 py-6 sm:px-10 lg:px-16"><a
                class="flex items-center gap-2.5 text-lg font-extrabold tracking-[-.04em]"
                href="{{ route('home') }}"><span
                    class="grid h-[31px] w-[31px] place-items-center bg-[#d8f06a] text-sm text-[#102a43]">H</span><span>Hubla<span
                        class="text-white/60">/doc</span></span></a><a
                class="font-mono text-[10px] uppercase tracking-[.12em] text-white/75 transition hover:text-[#d8f06a]"
                href="/admin/login">Admin workspace ↗</a></header>
        <section class="relative z-10 flex min-h-screen items-center justify-center px-6 text-center">
            <div
                class="max-w-[760px] rounded-lg border border-white/30 bg-[#08131f]/85 px-8 py-9 shadow-2xl backdrop-blur-sm sm:px-14 sm:py-12">
                <p class="mb-6 font-mono text-[10px] uppercase tracking-[.22em] text-[#d8f06a]">Arsip visual kegiatan
                </p>
                <h1
                    class="font-display text-[clamp(52px,7vw,100px)] font-medium leading-[.9] tracking-[-.035em] text-white drop-shadow-[0_3px_12px_rgba(0,0,0,.9)]">
                    Cerita
                    yang<br><em class="not-italic text-[#d8f06a]">terus hidup.</em></h1>
                <p class="mx-auto mt-7 max-w-[500px] text-sm leading-7 text-white/85">Kumpulan momen, orang, dan
                    kegiatan Hubla yang diabadikan dalam satu ruang dokumentasi.</p><a
                    class="mt-9 inline-flex items-center gap-4 border border-white/60 bg-white px-6 py-3 text-xs font-bold text-[#102a43] transition hover:border-[#d8f06a] hover:bg-[#d8f06a]"
                    href="{{ route('documentations.index') }}">Jelajahi dokumentasi <span class="text-base">↗</span></a>
            </div>
        </section>
        <div
            class="absolute bottom-6 left-6 z-10 font-mono text-[9px] uppercase tracking-[.12em] text-white/50 sm:left-10 lg:left-16">
            {{ $images->count() }} foto dalam arsip</div>
        <div
            class="absolute bottom-6 right-6 z-10 font-mono text-[9px] uppercase tracking-[.12em] text-white/50 sm:right-10 lg:right-16">
            Scroll to explore</div>
    </main>
</body>

</html>
