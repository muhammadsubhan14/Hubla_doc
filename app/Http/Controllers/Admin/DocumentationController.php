<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Image;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('admin.documentations.index', ['documentations' => Documentation::withCount('images')->latest('event_date')->paginate(12)]);
    }

    public function create()
    {
        return view('admin.documentations.create', ['persons' => Person::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $images = $request->file('images', []);
        if (! $request->hasFile('cover_image') || count($images) + 1 > 20) {
            return back()->withInput()->withErrors(['images' => 'Dokumentasi wajib memiliki cover dan maksimal 20 foto total.']);
        }

        return DB::transaction(function () use ($request, $data, $images) {
            $documentation = Documentation::create($data + ['created_by' => $request->user()->id]);
            $cover = $this->saveImage($documentation, $request->file('cover_image'), 'Cover dokumentasi');
            $documentation->update(['cover_image_id' => $cover->id]);
            $this->saveImages($documentation, $images);
            $documentation->persons()->sync($request->input('person_ids', []));

            return redirect()->route('admin.documentations.edit', $documentation)->with('success', 'Dokumentasi berhasil dibuat.');
        });
    }

    public function edit(Documentation $documentation)
    {
        $documentation->load(['images', 'persons']);

        return view('admin.documentations.edit', ['documentation' => $documentation, 'persons' => Person::orderBy('name')->get()]);
    }

    public function update(Request $request, Documentation $documentation)
    {
        $data = $this->validated($request);
        $images = $request->file('images', []);
        try {
            return DB::transaction(function () use ($request, $data, $documentation, $images) {
                $lockedDocumentation = Documentation::whereKey($documentation->id)->lockForUpdate()->firstOrFail();
                $newFileCount = count($images) + ($request->hasFile('cover_image') ? 1 : 0);
                if ($lockedDocumentation->images()->count() + $newFileCount > 20) {
                    throw ValidationException::withMessages(['images' => 'Upload ditolak: maksimal 20 foto per dokumentasi.']);
                }
                $lockedDocumentation->update($data);
                if ($request->hasFile('cover_image')) {
                    $cover = $this->saveImage($lockedDocumentation, $request->file('cover_image'), 'Cover dokumentasi');
                    $lockedDocumentation->update(['cover_image_id' => $cover->id]);
                }
                $this->saveImages($lockedDocumentation, $images);
                $lockedDocumentation->persons()->sync($request->input('person_ids', []));

                return redirect()->route('admin.documentations.index')->with('success', 'Dokumentasi berhasil diperbarui.');
            });
        } catch (ValidationException $exception) {
            return back()->withInput()->withErrors($exception->errors());
        }
    }

    public function destroy(Documentation $documentation)
    {
        $documentation->delete();

        return redirect()->route('admin.documentations.index')->with('success', 'Dokumentasi dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:5000'],
            'event_date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:180'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'images' => ['nullable', 'array', 'max:20'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'person_ids' => ['nullable', 'array'],
            'person_ids.*' => ['integer', 'exists:persons,id'],
        ]);
    }

    private function saveImages(Documentation $documentation, array $images): void
    {
        $order = (int) $documentation->images()->max('sort_order') + 1;
        foreach ($images as $image) {
            $this->saveImage($documentation, $image, null, $order++);
        }
    }

    private function saveImage(Documentation $documentation, $file, ?string $caption, int $order = 0): Image
    {
        return $documentation->images()->create(['image_path' => $file->store('documentations', 'public'), 'caption' => $caption, 'sort_order' => $order]);
    }
}
