<?php

namespace App\Http\Controllers;

use App\Models\KerjaSama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class KerjaSamaController extends Controller
{
    public function index()
    {
        $kerja_sama = KerjaSama::all();

        return view('pages.kerja-sama.index', [
            'kerja_sama' => $kerja_sama
        ]);
    }

    public function tambah()
    {
        return view('pages.kerja-sama.create');
    }

    public function simpan(Request $request)
    {


        $kerja_sama = new KerjaSama();
        $kerja_sama->tanggal_kerja_sama = $request->tanggal_kerja_sama;
        $kerja_sama->keterangan = $request->content_keterangan;
        $kerja_sama->tanggal_post = Carbon::now();
        $kerja_sama->create_by = Auth::user()->name;
        $kerja_sama->update_by = Auth::user()->name;
        $kerja_sama->save();

        $kerja_sama->thumbnail = $request->file('thumbnail')->store('assets/thumbnail-kerja-sama', 'public');

        $kerja_sama->save();

        return redirect()->route('kerja_sama');
    }


    public function hapus($id)
    {
        $kerja_sama = KerjaSama::find($id);

        $kerja_sama->delete();

        return redirect()->route('kerja-sama');
    }
}
