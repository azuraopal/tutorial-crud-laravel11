<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Intervention\Image\Facades\Image;
use File;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::latest()->paginate(5);
        return view('admin.certificate.index', compact('certificates'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'description' => 'nullable',
            'file' => 'required|mimes:pdf|max:5120',
        ]);

        $filepath = $request->file('file')->store('certificates', 'public');

        Certificate::create([
            'name' => $request->input('name'),
            'issued_by' => $request->input('issued_by'),
            'description' => $request->input('description'),
            'file' => $filepath,
        ]);

        return redirect()->route('admin.certificate.index')->with('success', 'Certificate Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return response()->file(storage_path('app/public/' . $certificate->file));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'nullable',
            'description' => 'nullable',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = $request->only(['name', 'issued_by', 'description']);

        if ($request->hasFile('file')) {
            if ($certificate->file && \Storage::exists($certificate->file)) {
                \Storage::delete($certificate->file);
            }

            $data['file'] = $request->file('file')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.certificate.index')->with('success', 'Certificate Update Successfully');
    }

    // Method untuk menampilkan preview certificate
    public function generateThumbnail($certificateId)
    {
        // Ambil data sertifikat berdasarkan ID
        $certificate = Certificate::findOrFail($certificateId);

        // Path file PDF di storage/public
        $pdfPath = storage_path('app/public/certificates/' . $certificate->file);

        // Tentukan path output untuk thumbnail PNG
        $thumbnailPath = storage_path('app/public/thumbnails/' . basename($certificate->file, '.pdf') . '.png');

        // Periksa apakah file PDF ada
        if (!File::exists($pdfPath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Perintah Ghostscript untuk mengonversi PDF menjadi gambar
        $gsCommand = "gswin64c -dNOPAUSE -dBATCH -sDEVICE=pngalpha -r150 -sOutputFile={$thumbnailPath} {$pdfPath}";

        // Jalankan perintah Ghostscript untuk menghasilkan thumbnail
        exec($gsCommand);

        // Jika thumbnail berhasil dibuat, kembalikan path thumbnail
        if (File::exists($thumbnailPath)) {
            return response()->json(['thumbnail' => asset('storage/thumbnails/' . basename($certificate->file, '.pdf') . '.png')]);
        }

        return response()->json(['error' => 'Failed to generate thumbnail.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->file && Storage::exists($certificate->file)) {
            Storage::delete($certificate->file);
        }

        $certificate->delete();

        return redirect()->route('admin.certificate.index')->with('success', 'Certificate deleted successfully.');
    }
}
