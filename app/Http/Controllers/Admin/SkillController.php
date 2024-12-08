<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest()->paginate(5);
        return view('admin.skills.index', compact('skills'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'category' => 'required',
            'icon_path' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('icon_path')) {
            $destinationPath = 'images/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['icon_path'] = "$imageName";
        }

        Skill::create($input);

        return redirect()->route('admin.skill.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        return view('admin.skill.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|max:100',
            'category' => 'required',
            'icon_path' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Validasi gambar, nullable jika tidak ada
        ]);

        // Ambil semua input dari request
        $input = $request->all();

        // Cek apakah ada gambar baru yang diupload
        if ($image = $request->file('icon_path')) {
            // Tentukan path penyimpanan dan nama file
            $destinationPath = 'images/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();

            // Pindahkan gambar ke folder yang ditentukan
            $image->move($destinationPath, $imageName);

            // Hapus gambar lama jika ada
            if ($skill->icon_path && file_exists(public_path('images/' . $skill->icon_path))) {
                unlink(public_path('images/' . $skill->icon_path));
            }

            // Simpan nama file gambar baru
            $input['icon_path'] = $imageName;
        }

        // Update data skill dengan input yang baru
        $skill->update($input);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.skill.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skill.index')->with('success', 'Skill deleted successfully');
    }
}
