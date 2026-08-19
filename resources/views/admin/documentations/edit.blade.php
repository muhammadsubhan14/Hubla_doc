@extends('layouts.admin')
@section('content')
    <div class="mb-[35px] flex items-end justify-between gap-5 max-md:items-start">
        <div>
            <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Kelola arsip</p>
            <h1 class="m-0 font-display text-[44px] font-medium tracking-[-.04em] max-md:text-[34px]">
                {{ $documentation->title }}</h1>
        </div><a class="bg-[#e8ece4] px-4 py-3 text-[11px]" href="{{ route('documentations.show', $documentation) }}"
            target="_blank">Lihat public ↗</a>
    </div>@include('admin.documentations.form')<section class="mt-[60px]">
        <div class="mb-[30px]">
            <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">
                {{ $documentation->images->count() }} / 20 foto digunakan</p>
            <h2 class="m-0 font-display text-[38px] font-medium tracking-[-.035em]">Kelola foto</h2>
        </div>
        <form class="mb-6 flex items-end gap-4 bg-[#edf2e7] p-[22px] max-md:grid max-md:items-start" method="POST"
            action="{{ route('admin.documentations.images.store', $documentation) }}" enctype="multipart/form-data">
            @csrf<label class="flex-1 text-[11px] text-[#728078]">Pilih beberapa foto<input
                    class="mt-2 block w-full text-xs" type="file" name="images[]"
                    accept="image/jpeg,image/png,image/webp" multiple @disabled($documentation->images->count() >= 20)></label><span
                class="text-[11px] text-[#728078]">Maksimal {{ max(0, 20 - $documentation->images->count()) }} foto
                lagi.</span><button class="bg-[#263b32] px-4 py-3 text-[11px] text-white disabled:opacity-40" type="submit"
                @disabled($documentation->images->count() >= 20)>Upload foto</button></form>
        <div class="grid grid-cols-5 gap-2.5 max-md:grid-cols-2">
            @foreach ($documentation->images as $image)
                <div class="relative border border-[#dce1da] bg-white p-2"><img
                        class="aspect-[4/3] max-h-[170px] w-full object-cover" src="{{ Storage::url($image->image_path) }}"
                        alt=""><span
                        class="absolute left-3 top-3 bg-[#d8f06a] px-1 py-1 font-mono text-[9px]">{{ $documentation->cover_image_id === $image->id ? 'COVER' : 'FOTO' }}</span>
                    <form class="mt-2 flex gap-1" method="POST"
                        action="{{ route('admin.documentations.images.update', [$documentation, $image]) }}">@csrf
                        @method('PATCH')<input class="min-w-0 w-full border border-[#dce1da] p-1.5 text-[10px]"
                            name="caption" value="{{ $image->caption }}" placeholder="Caption"><input
                            class="w-10 border border-[#dce1da] p-1.5 text-[10px]" name="sort_order" type="number"
                            min="0" max="19" value="{{ $image->sort_order }}"><button
                            class="bg-[#e8ece4] px-2 text-[10px]" type="submit">Simpan</button></form>
                    @if ($documentation->cover_image_id !== $image->id)
                        <form method="POST" action="{{ route('admin.documentations.cover', [$documentation, $image]) }}">
                            @csrf @method('PATCH')<button
                                class="border-0 bg-transparent p-0 pt-2 text-[10px] text-[#69803d]" type="submit">Jadikan
                                cover</button></form>
                    @endif
                    <form method="POST"
                        action="{{ route('admin.documentations.images.destroy', [$documentation, $image]) }}"
                        onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')<button class="border-0 bg-transparent p-0 pt-2 text-[10px] text-[#a33d35]"
                            type="submit">Hapus</button></form>
                </div>
            @endforeach
        </div>
    </section>
@endsection
