<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::latest()->paginate(5); // Data dengan pagination
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048', // Validasi gambar
        ]);

        // Simpan gambar di path public/storage/abouts
        $imagePath = $request->file('image')->store('abouts', 'public');

        About::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath, // Simpan path gambar ke database
        ]);

        return redirect()->route('admin.about.index')->with('success', 'About created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return view('admin.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validasi gambar opsional
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($about->image && Storage::exists('public/' . $about->image)) {
                Storage::delete('public/' . $about->image);
            }

            // Simpan gambar baru di path public/storage/abouts
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        if ($about->image && Storage::exists('public/' . $about->image)) {
            Storage::delete('public/' . $about->image);
        }

        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About deleted successfully.');
    }
}

