<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function profile(Request $request)
    {
        // $data = User::find(Auth::user()->getAuthIdentifier());
        $data = Auth::user();
        $data['title'] = "LARAVEDIA || Profile";
        return view('account.profile', $data);
    }
    public function getData(Request $request)
    {
        $data = User::find($request->id);
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $user = User::find($request->userId_edit);
            if (!$user) {
                return response()->json([
                    'status' => 500,
                    'success' => false,
                    'message' => "Data not found",
                    'data' => [],
                ]);
            }

            if ($request->has('imageUserEdit')) {
                //save file
                $file = $data['imageUserEdit'];
                $fileName = 'file' . time() . '.' . $file->extension();
                $data['image'] = $fileName;
                $file->move(public_path() . '/assets/uploads/images/user/', $fileName);
            }
            unset($data['imageUserEdit']);
            unset($data['userId_edit']);

            $data['updated_by'] = Auth::user()->email;
            User::where('id', $request->userId_edit)->update($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success edit user",
                'data' => [],
            );
            DB::commit();
            return response()->json($response, $status_code);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 200);
        }
    }

    public function changePassword(Request $request)
    {
        DB::beginTransaction();
        try {
            // $hashPassword = Hash::make($request->oldPassword);
            $database = User::where('id', $request->userId_changepassword)
                ->first();

            if (!(Hash::check($request->oldPassword, $database->password))) {
                return response()->json([
                    'status' => 202,
                    'success' => false,
                    'message' => "Old password does not match, please check again"
                ], 200);
            }

            // dd($request->all());
            // dd(Hash::make($request->password));
            // $data['updated_by'] = Auth::user()->email;
            User::where('id', $request->userId_changepassword)->update(
                [
                    'password' => Hash::make($request->password),
                    'updated_by' => Auth::user()->email
                ]
            );

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success change password",
                'data' => [],
            );
            DB::commit();
            return response()->json($response, $status_code);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 200);
        }
    }
}