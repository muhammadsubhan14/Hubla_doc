@extends('layouts.admin')
@section('content')
    <div class="mb-[35px] flex items-end justify-between gap-5 max-md:items-start">
        <div>
            <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Overview</p>
            <h1 class="m-0 text-[40px] font-bold tracking-[-.06em] max-md:text-[30px]">Dashboard</h1>
        </div><a class="bg-[#263b32] px-4 py-3 text-[11px] text-white" href="{{ route('admin.documentations.create') }}">＋
            Dokumentasi baru</a>
    </div>
    <div class="grid grid-cols-3 gap-3.5 max-md:grid-cols-1">
        <div class="border border-[#dce1da] bg-white p-6"><span class="text-[11px] text-[#728078]">Dokumentasi</span><strong
                class="my-[18px] block font-mono text-[42px]">{{ $documentationCount }}</strong><small
                class="text-[11px] text-[#728078]">arsip kegiatan</small></div>
        <div class="border border-[#dce1da] bg-white p-6"><span class="text-[11px] text-[#728078]">Total foto</span><strong
                class="my-[18px] block font-mono text-[42px]">{{ $imageCount }}</strong><small
                class="text-[11px] text-[#728078]">dalam seluruh arsip</small></div>
        <div class="border border-[#dce1da] bg-white p-6"><span class="text-[11px] text-[#728078]">Total PIC</span><strong
                class="my-[18px] block font-mono text-[42px]">{{ $personCount }}</strong><small
                class="text-[11px] text-[#728078]">kontributor kegiatan</small></div>
    </div>
    <section class="mt-[60px]">
        <div class="mb-[30px] flex items-end justify-between">
            <div>
                <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Terbaru</p>
                <h2 class="m-0 text-[35px] font-bold tracking-[-.06em]">Dokumentasi terakhir</h2>
            </div><a class="font-mono text-[11px] uppercase" href="{{ route('admin.documentations.index') }}">Lihat semua
                →</a>
        </div>
        <div class="border-t border-[#dce1da]">
            @forelse($recentDocumentations as $item)
                <a class="flex items-center gap-4 border-b border-[#dce1da] py-3"
                    href="{{ route('admin.documentations.edit', $item) }}">
                    @if ($item->coverImage)
                        <img class="h-[55px] w-[55px] object-cover" src="{{ Storage::url($item->coverImage->image_path) }}"
                        alt="">@else<div class="grid h-[55px] w-[55px] place-items-center bg-[#dae3d5]">H</div>
                    @endif
                    <div class="flex-1">
                        <strong class="block text-[13px]">{{ $item->title }}</strong><small
                            class="mt-1 block text-[11px] text-[#728078]">{{ $item->event_date->format('d M Y') }} ·
                            {{ $item->location }}</small>
                    </div><span>→</span>
            </a>@empty<div class="border border-dashed border-[#c7d0c5] p-8 text-center text-[#728078]">Belum ada
                    dokumentasi.</div>
            @endforelse
        </div>
    </section>
@endsection
