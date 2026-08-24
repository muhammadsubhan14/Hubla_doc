@extends('layouts.public')
@section('content')
    <main class="bg-[#f7f8fa] text-[#102a43]">
        @if ($featured)
            <section class="relative min-h-[min(720px,78vh)] overflow-hidden bg-[#1d2421]">
                @if ($featured->coverImage)
                    <img class="absolute inset-0 h-full w-full object-cover opacity-70"
                        src="{{ Storage::url($featured->coverImage->image_path) }}" alt="{{ $featured->title }}">
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-[#0d1412] via-[#0d1412aa] to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-transparent to-[#14141433]"></div>
                <div
                    class="relative mx-auto flex min-h-[min(720px,78vh)] w-[min(1280px,calc(100%-48px))] items-end pb-[clamp(70px,10vw,130px)]">
                    <div class="max-w-[650px] lg:pl-16 xl:pl-24">
                        <p class="mb-5 font-mono text-[10px] uppercase tracking-[.16em] text-[#d8f06a]">Dokumentasi terbaru
                        </p>
                        <h1 class="font-display text-[clamp(48px,7vw,96px)] font-medium leading-[.88] tracking-[-.045em]">
                            {{ $featured->title }}</h1>
                        <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-white/70">
                            <span>{{ $featured->event_date->translatedFormat('d F Y') }}</span><span
                                class="h-1 w-1 rounded-full bg-[#d8f06a]"></span><span>{{ $featured->location }}</span>
                        </div>
                        <p class="mt-5 max-w-[520px] text-sm leading-6 text-white/70">
                            {{ Str::limit($featured->description, 170) }}</p>
                        <a class="mt-7 inline-flex items-center gap-3 bg-white px-5 py-3 text-xs font-bold text-[#141414] transition hover:bg-[#d8f06a]"
                            href="{{ route('documentations.show', $featured) }}">Lihat detail <span
                                class="text-base">↗</span></a>
                    </div>
                </div>
            </section>
            @if ($carouselDocumentations->isNotEmpty())
                <section class="mx-auto w-[min(1280px,calc(100%-48px))] pb-20 pt-10">
                    <div class="mb-6 flex items-end justify-between border-b border-[#e2e8f0] pb-4">
                        <div>
                            <p class="mb-1 font-mono text-[10px] uppercase tracking-[.16em] text-[#718096]">Arsip Dokumentasi</p>
                            <h2 class="font-display text-3xl font-bold tracking-[-.03em] text-[#1a202c]">Dokumentasi lainnya</h2>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="grid h-10 w-10 place-items-center rounded-full border border-[#cbd5e0] bg-white text-lg font-bold text-[#4a5568] transition-all hover:border-[#102a43] hover:bg-[#102a43] hover:text-white"
                                type="button" data-carousel-prev aria-label="Dokumentasi sebelumnya">←</button>
                            <button
                                class="grid h-10 w-10 place-items-center rounded-full border border-[#cbd5e0] bg-white text-lg font-bold text-[#4a5568] transition-all hover:border-[#102a43] hover:bg-[#102a43] hover:text-white"
                                type="button" data-carousel-next aria-label="Dokumentasi berikutnya">→</button>
                        </div>
                    </div>
                    
                    <div class="-mx-2 flex snap-x snap-mandatory gap-6 overflow-x-auto px-2 pb-6 scrollbar-none"
                        data-documentation-carousel>
                        @foreach ($carouselDocumentations as $documentation)
                            <a class="group flex w-[320px] flex-none snap-start flex-col overflow-hidden rounded-lg border border-[#e2e8f0] bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[#cbd5e0] hover:shadow-md"
                                href="{{ route('documentations.show', $documentation) }}">
                                <div class="relative aspect-[16/10] overflow-hidden bg-[#edf2f7]">
                                    <img class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        src="{{ $documentation->coverImage ? Storage::url($documentation->coverImage->image_path) : '' }}"
                                        alt="{{ $documentation->title }}">
                                    <span class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></span>
                                    <span class="absolute bottom-3 left-3 rounded bg-black/40 px-2 py-0.5 font-mono text-[9px] text-white backdrop-blur-sm">
                                        {{ $documentation->event_date->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <p class="mb-1.5 font-mono text-[9px] uppercase tracking-wider text-[#d8f06a] bg-[#102a43] px-2 py-0.5 rounded self-start">
                                        {{ $documentation->location }}
                                    </p>
                                    <h3 class="line-clamp-2 font-display text-lg font-bold leading-snug tracking-tight text-[#2d3748] transition-colors group-hover:text-[#102a43]">
                                        {{ $documentation->title }}
                                    </h3>
                                    <p class="mt-2 line-clamp-2 flex-1 text-xs leading-relaxed text-[#718096]">
                                        {{ Str::limit($documentation->description, 100) }}
                                    </p>
                                    <div class="mt-4 flex items-center justify-between border-t border-[#f7fafc] pt-3 font-mono text-[10px] uppercase tracking-wider text-[#4a5568]">
                                        <span>Lihat detail</span>
                                        <span class="text-base text-[#102a43] transition-transform duration-300 group-hover:translate-x-1">→</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-8 border-t border-[#e2e8f0] pt-6 flex justify-center">{{ $documentations->links() }}</div>
                </section>
            @endif
        @else
            <section
                class="mx-auto flex min-h-[70vh] w-[min(1160px,calc(100%-48px))] items-center justify-center text-center">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[.16em] text-[#d8f06a]">Arsip kegiatan</p>
                    <h1 class="mt-4 font-display text-6xl text-[#102a43]">Belum ada dokumentasi</h1>
                    <p class="mt-4 text-[#71869c]">Koleksi kegiatan akan tampil di sini.</p>
                </div>
            </section>
        @endif
    </main>
@endsection
