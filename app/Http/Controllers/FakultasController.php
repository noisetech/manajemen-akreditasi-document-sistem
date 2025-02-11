<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FakultasController extends Controller
{
    public function index()
    {
        return view('pages.fakultas.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Fakultas::all();

            return datatables()->of($data)
                ->editColumn('status_aktif', function ($data) {
                    return '<span class="badge bg-info mb-1 mt-1 mx-1">' . $data->status_aktif . '</span>';
                })
                ->addColumn('action', function ($data) {
                    if ($data->status_aktif == 'aktif') {
                        $button = '<div class="d-flex justify-content-start">
                            <a href="#" class="badge bg-warning text-white " id="edit" data-id="' . $data->id . '" title="Edit">
                                   Edit
                                   </a>
                                   <a class="badge bg-danger text-white mx-1 hapus" href="javascript:void(0)" data-id="' . $data->id . '" title="Hapus">
                                    Hapus</a>



                      </div>';
                    } else {
                        $button = '<div class="d-flex justify-content-start">
                        <a href="#" class="badge bg-warning text-white " id="edit" data-id="' . $data->id . '" title="Edit">
                               Edit
                               </a>
                               <a class="badge bg-danger text-white mx-1 hapus" href="javascript:void(0)" data-id="' . $data->id . '" title="Hapus">
                                Hapus</a>


                  </div>';
                    }
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status_aktif'])
                ->toJson();
        }
    }

    public function tambah()
    {
        return view('pages.fakultas.tambah');
    }


    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $fakultas = new Fakultas();
        $fakultas->name = $request->fakultas;
        $fakultas->status_aktif = 'aktif';
        $fakultas->create_by = Auth::user()->name;
        $fakultas->slug = Str::slug($request->nama);
        $fakultas->save();

        if ($fakultas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan'
            ], 200);
        }
    }

    public function getDataById($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return response()->json($fakultas);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $fakultas = Fakultas::findOrFail($request->id);
        $fakultas->name = $request->fakultas;
        $fakultas->create_by = Auth::user()->name;
        $fakultas->slug = Str::slug($request->nama);
        $fakultas->save();

        if ($fakultas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah'
            ], 200);
        }
    }

    public function hapus(Request $request)
    {
        $fakultas = Fakultas::findOrFail($request->id);

        if ($fakultas->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan'
            ], 200);
        }
    }


    public function nonAktifkanFakultas(Request $request)
    {
        $fakultas = Fakultas::findOrFail($request->id);

        $fakultas->update([
            'status_aktif' => 'tidak aktif'
        ]);

        if ($fakultas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diproses'
            ], 200);
        }
    }

    public function AktifkanFakultas(Request $request)
    {
        $fakultas = Fakultas::findOrFail($request->id);

        $fakultas->update([
            'status_aktif' => 'aktif'
        ]);

        if ($fakultas) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data diproses'
            ], 200);
        }
    }
}
