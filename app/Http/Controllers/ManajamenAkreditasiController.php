<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManajamenAkreditasiController extends Controller
{
    public function index()
    {
        return view('pages.manajemen-akreditasi.index');
    }

    public function data(Request $request){
        if($request->ajax()){

        }
    }


    public function listFakultas(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $data = Fakultas::where('nama_fakultas', 'LIKE', '%' . $search . '%')
                ->get();


            $result = $data->map(function ($d) {
                return [
                    'id' => $d->id,
                    'text' => $d->nama_fakultas
                ];
            });

            return response()->json($result);
        } else {
            $data = Fakultas::all();

            $result = $data->map(function ($d) {
                return [
                    'id' => $d->id,
                    'text' => $d->nama_fakultas
                ];
            });

            return response()->json($result);
        }
    }


    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas' => 'required',
            'file_pendukung' => 'required|file|mimes:pdf|max:2048',
            'nilai' => 'nullable|numeric',
            'sumber_data' => 'required',
            'jenis' => 'required',
            'no_urutan' => 'required',
            'bobot' => 'required',
            'deskripsi' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {

            if ($request->hasFile('dokumen_pendudkung')) {
                $file = $request->file('dokumen_pendukung');

                $name_file = $file->getClientOriginalName() . '' . date('Ymd') . time() . rand(1, 100000);

                $generate_path = 'storage/app/public' . $name_file . 'public';
                $dokumen_pendukung = $request->file('dokumen_pendukung')->storeAs($generate_path);
            }

            DB::table('akreditasi_fakultas')
                ->insert([
                    'sumber_data' => $request->sumber_data,
                    'jenis' => $request->jenis,
                    'fakultas' => $request->fakultas,
                    'dokumen_pendukung' => $dokumen_pendukung,
                    'nama_file' => $name_file,
                    'nilai' => $request->nilai ? $request->nilai : null,

                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'arsip akreditasi disimpan'
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalaha:' . $exception->getMessage(),
            ], 500);
        }
    }
}
