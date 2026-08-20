@extends('layouts.admin')
@section('content')
    <div class="mb-[35px] flex items-end justify-between gap-5 max-md:items-start">
        <div>
            <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Orang di balik kegiatan</p>
            <h1 class="m-0 text-[40px] font-bold tracking-[-.06em] max-md:text-[30px]">PIC</h1>
        </div><a class="bg-[#263b32] px-4 py-3 text-[11px] text-white" href="{{ route('admin.persons.create') }}">＋ Tambah
            PIC</a>
    </div>
    <div class="grid grid-cols-2 gap-3.5 max-md:grid-cols-1">
        @forelse($persons as $person)
            <div class="flex items-center gap-4 border border-[#dce1da] bg-white p-4">
                @if ($person->photo)
                    <img class="h-14 w-14 rounded-full object-cover" src="{{ Storage::url($person->photo) }}"
                    alt="">@else<span
                        class="grid h-14 w-14 place-items-center rounded-full bg-[#dce5d4] text-lg text-[#71863c]">{{ substr($person->name, 0, 1) }}</span>
                @endif
                <div>
                    <h3 class="m-0 text-sm">{{ $person->name }}</h3>
                    <p class="my-1 text-[11px] text-[#728078]">{{ $person->position }}</p><small
                        class="text-[11px] text-[#728078]">{{ $person->documentations_count }} dokumentasi</small>
                </div>
                <div class="ml-auto flex items-center gap-3"><a class="text-[11px] leading-none text-[#69803d]"
                        href="{{ route('admin.persons.edit', $person) }}">Edit</a>
                    <form class="flex items-center" method="POST" action="{{ route('admin.persons.destroy', $person) }}">
                        @csrf @method('DELETE')<button
                            class="border-0 bg-transparent p-0 text-[11px] leading-none text-[#a33d35]"
                            type="submit">Hapus</button></form>
                </div>
        </div>@empty<div class="col-span-full border border-dashed border-[#c7d0c5] p-8 text-center text-[#728078]">
                Belum ada PIC.</div>
        @endforelse
    </div>
    <div class="mt-9">{{ $persons->links() }}</div>
@endsection
