<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DocumentationImageController extends Controller
{
    public function store(Request $request, Documentation $documentation)
    {
        $data = $request->validate(['images' => ['required', 'array', 'min:1'], 'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120']]);
        try {
            DB::transaction(function () use ($documentation, $data) {
                $lockedDocumentation = Documentation::whereKey($documentation->id)->lockForUpdate()->firstOrFail();
                if ($lockedDocumentation->images()->count() + count($data['images']) > 20) {
                    throw ValidationException::withMessages(['images' => 'Upload ditolak: jumlah foto akan melebihi 20. Hapus foto terlebih dahulu.']);
                }
                $order = (int) $lockedDocumentation->images()->max('sort_order') + 1;
                foreach ($data['images'] as $file) {
                    $lockedDocumentation->images()->create(['image_path' => $file->store('documentations', 'public'), 'sort_order' => $order++]);
                }
            });
        } catch (ValidationException $exception) {
            return back()->withErrors($exception->errors());
        }

        return back()->with('success', 'Foto berhasil diupload.');
    }

    public function update(Request $request, Documentation $documentation, Image $image)
    {
        abort_unless($image->documentation_id === $documentation->id, 404);
        $image->update($request->validate(['caption' => ['nullable', 'string', 'max:180'], 'sort_order' => ['required', 'integer', 'min:0', 'max:19']]));

        return back()->with('success', 'Foto diperbarui.');
    }

    public function destroy(Documentation $documentation, Image $image)
    {
        abort_unless($image->documentation_id === $documentation->id, 404);
        if ($documentation->images()->count() <= 1 || $documentation->cover_image_id === $image->id) {
            return back()->withErrors(['images' => 'Dokumentasi harus memiliki cover. Pilih cover baru sebelum menghapus cover saat ini.']);
        }
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Foto dihapus.');
    }

    public function cover(Documentation $documentation, Image $image)
    {
        abort_unless($image->documentation_id === $documentation->id, 404);
        $documentation->update(['cover_image_id' => $image->id]);

        return back()->with('success', 'Cover photo diperbarui.');
    }
}
