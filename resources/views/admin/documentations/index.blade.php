@extends('layouts.admin')
@section('content')
    <div class="mb-[35px] flex items-end justify-between gap-5 max-md:items-start">
        <div>
            <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Arsip kegiatan</p>
            <h1 class="m-0 text-[40px] font-bold tracking-[-.06em] max-md:text-[30px]">Dokumentasi</h1>
        </div><a class="bg-[#263b32] px-4 py-3 text-[11px] text-white" href="{{ route('admin.documentations.create') }}">＋
            Tambah</a>
    </div>
    <div class="overflow-auto border border-[#dce1da] bg-white">
        <table class="w-full border-collapse text-xs">
            <thead>
                <tr>
                    <th class="p-4 text-left font-mono text-[10px] uppercase text-[#728078]">Kegiatan</th>
                    <th class="p-4 text-left font-mono text-[10px] uppercase text-[#728078]">Tanggal</th>
                    <th class="p-4 text-left font-mono text-[10px] uppercase text-[#728078]">Lokasi</th>
                    <th class="p-4 text-left font-mono text-[10px] uppercase text-[#728078]">Foto</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($documentations as $item)
                    <tr>
                        <td class="border-t border-[#dce1da] p-4"><strong>{{ $item->title }}</strong><small
                                class="mt-1 block text-[#728078]">{{ Str::limit($item->description, 55) }}</small></td>
                        <td class="border-t border-[#dce1da] p-4">{{ $item->event_date->format('d M Y') }}</td>
                        <td class="border-t border-[#dce1da] p-4">{{ $item->location }}</td>
                        <td class="border-t border-[#dce1da] p-4">{{ $item->images_count }} / 20</td>
                        <td class="border-t border-[#dce1da] p-4">
                            <div class="flex gap-3"><a class="text-[11px] text-[#69803d]"
                                    href="{{ route('admin.documentations.edit', $item) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.documentations.destroy', $item) }}"
                                    onsubmit="return confirm('Hapus dokumentasi ini?')">@csrf @method('DELETE')<button
                                        class="border-0 bg-transparent p-0 text-[11px] text-[#a33d35]"
                                        type="submit">Hapus</button></form>
                            </div>
                        </td>
                </tr>@empty<tr>
                        <td class="p-8 text-center text-[#728078]" colspan="5">Belum ada dokumentasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-9">{{ $documentations->links() }}</div>
@endsection
