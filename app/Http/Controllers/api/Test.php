<?php

namespace App\Http\Controllers\api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Libraries\SqlAnywhere;
use App\Models\User;
use App\Models\UserGroup;

class Test extends Controller

{
    public function testConnection()
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['message' => 'Koneksi ke database berhasil!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal terhubung ke database!', 'error' => $e->getMessage()], 500);
        }
    }

    function testQuery(Request $request) {

        $limit = $request->input('limit', 2);
        $offset = $request->input('offset', 0);

        $userGroups = ((new SqlAnywhere(User::select('*')))->page(1,1)->prepare($meta))->get();
        // $userGroups->select(['description'])->prepare($meta);
        // var_dump($meta);

        return response()->json($userGroups);
        
    }
}


