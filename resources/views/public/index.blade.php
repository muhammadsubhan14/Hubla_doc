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
                <section class="mx-auto w-[min(1280px,calc(100%-48px))] pb-16 pt-2">
                    <div class="mb-5 flex items-end justify-between">
                        <div>
                            <p class="mb-2 font-mono text-[10px] uppercase tracking-[.16em] text-[#89958e]">Arsip pilihan
                            </p>
                            <h2 class="font-display text-[34px] font-medium tracking-[-.035em]">Dokumentasi lainnya</h2>
                        </div>
                        <div class="flex gap-2"><button
                                class="grid h-9 w-9 place-items-center border border-[#c7d4e1] text-lg transition hover:border-[#839a38] hover:text-[#6f8535]"
                                type="button" data-carousel-prev aria-label="Dokumentasi sebelumnya">←</button><button
                                class="grid h-9 w-9 place-items-center border border-[#c7d4e1] text-lg transition hover:border-[#839a38] hover:text-[#6f8535]"
                                type="button" data-carousel-next aria-label="Dokumentasi berikutnya">→</button></div>
                    </div>
                    <div class="-mx-2 flex snap-x snap-mandatory gap-3 overflow-x-auto px-2 pb-5 scrollbar-none"
                        data-documentation-carousel>
                        @foreach ($carouselDocumentations as $documentation)
                            <a class="group w-[min(300px,72vw)] flex-none snap-start"
                                href="{{ route('documentations.show', $documentation) }}">
                                <div class="relative aspect-video overflow-hidden rounded-sm bg-[#28302c]"><img
                                        class="h-full w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100"
                                        src="{{ $documentation->coverImage ? Storage::url($documentation->coverImage->image_path) : '' }}"
                                        alt="{{ $documentation->title }}"><span
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></span><span
                                        class="absolute bottom-3 left-3 font-mono text-[10px] text-white/80">{{ $documentation->event_date->format('d M Y') }}</span><span
                                        class="absolute right-3 top-3 grid h-8 w-8 translate-y-1 place-items-center bg-[#d8f06a] text-[#102a43] opacity-0 transition group-hover:translate-y-0 group-hover:opacity-100">↗</span>
                                </div>
                                <h3 class="mt-3 line-clamp-2 font-display text-[23px] leading-tight tracking-[-.02em]">
                                    {{ $documentation->title }}</h3>
                                <p class="mt-1 text-xs text-[#71869c]">⌖ {{ $documentation->location }}</p>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-7">{{ $documentations->links() }}</div>
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
