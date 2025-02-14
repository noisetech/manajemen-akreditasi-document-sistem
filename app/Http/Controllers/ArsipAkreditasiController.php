<?php

namespace App\Http\Controllers;

use App\Models\ArsipAkredtasi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ArsipAkreditasiController extends Controller
{
    public function index()
    {
        $arsip_akreditasi = ArsipAkredtasi::with('fakultas')
            ->when(request()->q, function ($query) {
                $query->whereHas('fakultas', function ($q) {
                    $q->where('name', 'LIKE', '%' . request()->q . '%');
                });
            })
            ->orderBy('fakultas_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('pages.arsip-akreditasi.index', [
            'arsip_akreditasi' => $arsip_akreditasi
        ]);
    }

    public function tambah()
    {
        $fakultas = Fakultas::all();

        return view('pages.arsip-akreditasi.tambah', [
            'fakultas' => $fakultas
        ]);
    }

    public function simpan(Request $request)
    {

        $this->validate($request, [
            'fakultas' => 'required',
            'sumber_data' => 'required',
            'jenis' => 'required',
            'no_urutan' => 'required',
            'no_butir' => 'required',
            'bobot' => 'required',
            'deskripsi' => 'required',
            'elemen_penilaian_lam' => 'required',
        ]);


        $arsip_akreditasi = new ArsipAkredtasi();
        $arsip_akreditasi->fakultas_id = $request->fakultas;
        $arsip_akreditasi->sumber_data = $request->sumber_data;
        $arsip_akreditasi->jenis = $request->jenis;
        $arsip_akreditasi->no_urutan = $request->no_urutan;
        $arsip_akreditasi->no_butir = $request->no_butir;
        $arsip_akreditasi->bobot = $request->bobot;
        $arsip_akreditasi->deskripsi = $request->deskripsi;
        $arsip_akreditasi->elemen_penilaian_lam = $request->elemen_penilaian_lam;
        $arsip_akreditasi->penilaian = $request->penilaian;
        $arsip_akreditasi->create_by = Auth::user()->name;
        $arsip_akreditasi->file_pendukung = $request->file('file_pendukung')->store('assets/file-pendukung-arsip-akreditasi', 'public');
        $arsip_akreditasi->save();

        return redirect()->route('arsip_akreditasi')->with('status', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $arsip_akreditasi = ArsipAkredtasi::find($id);

        $fakultas = Fakultas::all();

        return view('pages.arsip-akreditasi.edit', [
            'arsip_akreditasi' => $arsip_akreditasi,
            'fakultas' => $fakultas
        ]);
    }


    public function detail($id)
    {
        $arsip_akreditasi = ArsipAkredtasi::with(['fakultas'])->find($id);
        return view('pages.arsip-akreditasi.detail', [
            'arsip_akreditasi' => $arsip_akreditasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fakultas' => 'required',
            'sumber_data' => 'required',
            'jenis' => 'required',
            'no_urutan' => 'required',
            'bobot' => 'required',
            'deskripsi' => 'required',
            'nilai' => 'required',
            'file_pendukung' => 'required',
        ]);

        $file_pendukung = $request->file('file_pendukung');





        $arsip_akreditasi = ArsipAkredtasi::find($id);
        $arsip_akreditasi->fakultas_id = $request->fakultas;
        $arsip_akreditasi->sumber_data = $request->sumber_data;
        $arsip_akreditasi->jenis = $request->jenis;
        $arsip_akreditasi->no_urutan = $request->no_urutan;
        $arsip_akreditasi->bobot = $request->bobot;
        $arsip_akreditasi->deskripsi = $request->deskripsi;
        $arsip_akreditasi->nilai = $request->nilai;
        $arsip_akreditasi->peninjauan_auditor = 'pending';
        $arsip_akreditasi->save();

        if ($request->hasFile('file_pendukung')) {
            if ($arsip_akreditasi->file_pendukung && Storage::disk('public')->exists($arsip_akreditasi->file_pendukung)) {
                Storage::disk('public')->delete($arsip_akreditasi->file_pendukung);
            }

            $file = $request->file('file_pendukung');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $finalName = $fileName . '_' . time() . '.' . $extension;

            $path = $file->storeAs('assets/file-pendukung-arsip-akreditasi', $finalName, 'public');
            $arsip_akreditasi->file_pendukung = $path;
        }

        return redirect()->route('arsip_akreditasi')->with('status', 'Data berhasil ditambah');
    }


    public function hapus($id)
    {
        $arsip_akreditasi = ArsipAkredtasi::find($id);

        $arsip_akreditasi->delete();

        return redirect()->route('arsip_akreditasi')->with('status', 'Data berhasil dihapus');
    }


    public function previewDokumen($filename)
    {
        $arsipAkreditasi = ArsipAkredtasi::where('file_pendukung', 'LIKE', '%' . $filename)->firstOrFail();

        if (!$arsipAkreditasi->file_pendukung || !Storage::disk('public')->exists($arsipAkreditasi->file_pendukung)) {
            abort(404, 'Document not found');
        }

        $path = storage_path('app/public/' . $arsipAkreditasi->file_pendukung);
        $originalName = basename($arsipAkreditasi->file_pendukung);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $originalName . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN'
        ]);
    }


    public function changeStatusArispAkreditasi(Request $request, $id)
    {
        $arsipAkreditasi = ArsipAkredtasi::findOrFail($id);

        if (!$arsipAkreditasi->file_pendukung || !Storage::disk('public')->exists($arsipAkreditasi->file_pendukung)) {
            abort(404, 'Document not found');
        }

        $path = storage_path('app/public/' . $arsipAkreditasi->file_pendukung);
        $originalName = basename($arsipAkreditasi->file_pendukung);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $originalName . '"'
        ]);
    }
}
