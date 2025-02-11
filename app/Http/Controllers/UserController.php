<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\User;
use App\Models\UserAkademik;
use App\Models\UserFakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.users.index');
    }


    public function data(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('users')
                ->select('users.*',  'roles.name as role')

                ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->get();

            return datatables()->of($data)
                ->editColumn('status_aktif', function ($data) {
                    return '<span class="badge bg-info mb-1 mt-1 mx-1">' . $data->status_akun . '</span>';
                })

                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex justify-content-start">

                <a class="badge text-sm bg-danger text-white hapus" href="javascript:void(0)" data-id="' . $data->id . '">
                 Hapus Akun
              </a>
           </div>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'role', 'status_aktif'])
                ->toJson();
        }
    }

    public function listRole(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $result = [];

            $data = Role::where('name', 'LIKE', '%' . $search . '%')->whereNotIn('name', ['super admin', 'Super Admin', 'Super admin'])->get();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json($result);
        } else {
            $result = [];

            $data = Role::whereNotIn('name', ['super admin', 'Super Admin', 'Super admin'])->get();

            foreach ($data as $d) {
                $result[] = [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            }

            return response()->json($result);
        }
    }


    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'level_akun' => 'required',
            'fakultas' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            // Buat user baru
            $users = new User();
            $users->name = $request->nama;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->save();

            // masuk role user
            $users->roles()->attach($request->level_akun);


            // user fakultas
            UserFakultas::create([
                'users_id' => $users->id,
                'fakultas_id' => $request->fakultas,
                'create_by' => '-',
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data disimpan',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();

        try {
            $users = User::findOrFail($request->id);


            $password = empty($request->password) ?
                $users->password : Hash::make($request->password);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
            ];
            $users->update($data);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data diubah'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function listRoleByUser(Request $request)
    {
        $roles =  User::with(['roles'])->findOrFail($request->users_id);

        return response()->json([
            'status' => 'success',
            'message' => 'List Role',
            'data' => $roles
        ], 200);
    }


    public function hapus(Request $request)
    {
        $users = User::findOrFail($request->id);

        if ($users->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dihapus',
            ], 200);
        }
    }


    public function listFakultas(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;

            $data = Fakultas::where('name', 'LIKE', '%' . $search . '%')
                ->get();


            $result = $data->map(function ($d) {
                return [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            });


            return response()->json($result);
        } else {
            $data = Fakultas::all();


            $result = $data->map(function ($d) {
                return [
                    'id' => $d->id,
                    'text' => $d->name
                ];
            });
            return response()->json($result);
        }
    }
}
