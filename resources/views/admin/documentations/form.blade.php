<form class="border border-[#dce1da] bg-white p-[30px]" method="POST"
    action="{{ $documentation ? route('admin.documentations.update', $documentation) : route('admin.documentations.store') }}"
    enctype="multipart/form-data">
    @csrf @if ($documentation)
        @method('PUT')
    @endif
    <div class="grid grid-cols-2 gap-[22px] max-md:grid-cols-1">
        <label class="grid gap-2 text-[11px] text-[#728078]">Judul acara<input
                class="border border-[#dce1da] bg-[#fbfcf9] p-3 outline-[#a5bd53]" name="title"
                value="{{ old('title', $documentation?->title) }}" required></label><label
            class="grid gap-2 text-[11px] text-[#728078]">Tanggal acara<input
                class="border border-[#dce1da] bg-[#fbfcf9] p-3 outline-[#a5bd53]" type="date" name="event_date"
                value="{{ old('event_date', $documentation?->event_date?->format('Y-m-d')) }}" required></label><label
            class="grid gap-2 text-[11px] text-[#728078]">Lokasi<input
                class="border border-[#dce1da] bg-[#fbfcf9] p-3 outline-[#a5bd53]" name="location"
                value="{{ old('location', $documentation?->location) }}" required></label><label
            class="col-span-full grid gap-2 text-[11px] text-[#728078] max-md:col-span-1">Deskripsi
            <textarea class="border border-[#dce1da] bg-[#fbfcf9] p-3 outline-[#a5bd53]" name="description" rows="5" required>{{ old('description', $documentation?->description) }}</textarea>
        </label>
        <fieldset class="min-w-0 border border-[#dce1da] p-3">
            <legend class="px-1 text-[11px] text-[#728078]">PIC kegiatan</legend>
            <div class="grid gap-2">
                @foreach ($persons as $person)
                    <label
                        class="flex cursor-pointer items-center gap-2 border border-[#dce1da] bg-[#fbfcf9] p-2.5 has-[:checked]:border-[#9eb956] has-[:checked]:bg-[#eef5df]"><input
                            class="accent-[#263b32]" type="checkbox" name="person_ids[]" value="{{ $person->id }}"
                            @checked($documentation?->persons->contains($person))><span><strong
                                class="block text-[11px]">{{ $person->name }}</strong><small
                                class="mt-0.5 block text-[10px] text-[#728078]">{{ $person->position }}</small></span></label>
                @endforeach
            </div><small class="mt-2 block text-[10px] text-[#9aa69d]">Pilih satu atau beberapa PIC.</small>
        </fieldset><label class="grid gap-2 text-[11px] text-[#728078]">Cover photo<input class="block text-xs"
                type="file" name="cover_image" accept="image/jpeg,image/png,image/webp" @required(!$documentation)><small
                class="text-[10px] text-[#9aa69d]">JPG, PNG, WEBP. Maks. 5 MB.</small></label><label
            class="col-span-full grid gap-2 text-[11px] text-[#728078] max-md:col-span-1">Foto tambahan<input
                class="block text-xs" type="file" name="images[]" accept="image/jpeg,image/png,image/webp"
                multiple><small class="text-[10px] text-[#9aa69d]">Cover termasuk hitungan.
                {{ $documentation ? $documentation->images->count() . ' / 20 digunakan.' : '0 / 20 digunakan.' }}</small></label>
    </div>
    <div class="mt-7 border-t border-[#dce1da] pt-[22px]"><button class="bg-[#263b32] px-4 py-3 text-[11px] text-white"
            type="submit">{{ $documentation ? 'Simpan perubahan' : 'Simpan dokumentasi' }} ↗</button></div>
</form>
