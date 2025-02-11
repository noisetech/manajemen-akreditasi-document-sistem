<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    public function index()
    {

        $visi_misi = VisiMisi::all();

        return view('pages.visi-misi.index', [
            'visi_misi' => $visi_misi
        ]);
    }

    public function data(Request $request) {}


    public function tambah()
    {
        return view('pages.visi-misi.create');
    }

    public function simpan(Request $request)
    {

        // dd($request->all());
        VisiMisi::create([
            'visi' => $request->content_visi,
            'misi' => $request->content_misi
        ]);

        return redirect()->route('visi_misi');
    }


    public function hapus($id)
    {
        $visi_misi = VisiMisi::find($id);

        $visi_misi->delete();

        return redirect()->route('visi_misi');
    }
}
