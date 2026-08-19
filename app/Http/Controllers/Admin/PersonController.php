<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        return view('admin.persons.index', ['persons' => Person::withCount('documentations')->latest()->paginate(15)]);
    }

    public function create()
    {
        return view('admin.persons.create');
    }

    public function store(Request $request)
    {
        Person::create($this->validated($request));
        return redirect()->route('admin.persons.index')->with('success', 'PIC berhasil ditambahkan.');
    }

    public function edit(Person $person)
    {
        return view('admin.persons.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $person->update($this->validated($request));
        return redirect()->route('admin.persons.index')->with('success', 'PIC berhasil diperbarui.');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return back()->with('success', 'PIC dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120'], 'position' => ['required', 'string', 'max:120'], 'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120']]);
        if ($request->hasFile('photo')) $data['photo'] = $request->file('photo')->store('persons', 'public');
        return $data;
    }
}
