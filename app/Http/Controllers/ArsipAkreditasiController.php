<?php

namespace App\Http\Controllers;

use App\Models\ArsipAkredtasi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipAkreditasiController extends Controller
{
    public function index()
    {
        $arsip_akreditasi = ArsipAkredtasi::latest()->when(request()->q, function ($roles) {
            $roles =  $roles->where('name', 'LIKE', '%' . request()->q . '%');
        })->paginate(5);

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
        $arsip_akreditasi->file_pendukung = $file_pendukung ?? ($request->hasFile('file_pendukung') ? $request->file('file_pendukung')->store('assets/file-pendukung-arsip-akreditasi', 'public') : '');
        $arsip_akreditasi->save();

        return redirect()->route('arsip_akreditasi')->with('status', 'Data berhasil ditambah');
    }


    public function hapus($id)
    {
        $arsip_akreditasi = ArsipAkredtasi::find($id);

        $arsip_akreditasi->delete();

        return redirect()->route('arsip_akreditasi')->with('status', 'Data berhasil dihapus');
    }


    public function preview_dokumen($id)
    {
        $arsip = ArsipAkredtasi::findOrFail($id);

        // Path file PDF (sesuaikan dengan lokasi penyimpanan Anda)
        $path = storage_path("app/public/pdf/{$arsip->file_pendukung}");

        // Pastikan file tersedia
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Return file dengan header yang mencegah IDM mengunduhnya
        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
            'X-Content-Type-Options' => 'nosniff', // Mencegah MIME sniffing
            'X-Accel-Buffering'   => 'no' // Mencegah buffering oleh proxy server
        ]);
    }
}
