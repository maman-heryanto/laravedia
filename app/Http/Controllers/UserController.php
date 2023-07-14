<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role == 'user') {
                return abort(403, 'Access denied.');
            }

            return $next($request);
        });
    }
    public function index()
    {
        $data['title'] = "LARAVEDIA || LIST USERS";
        $data['users'] = User::orderBy('created_by', 'DESC')->get();
        return view('users.index', $data);
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            //validatate email yet
            $cek_email = User::where('email', "$request->email")
                ->get();

            if (count(($cek_email)) > 0) {
                return response()->json([
                    'status' => 202,
                    'success' => false,
                    'message' => "email has been registered, please check again"
                ], 200);
            }

            $data_insert = array(
                'id' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'image' => 'default.png',
                'role' => 'user',
                'status' => '1',
                'password' => Hash::make('12345'),
                'created_by' => Auth::user()->email
            );
            // dd($data_insert);
            $user = new User($data_insert);
            $user->save();
            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => "Registration Success",
                'data' => $request->all(),
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => $e->getMessage(),
                'data' => [],
            ], 200);
        }
    }

    public function getData(Request $request)
    {
        // dd($request);
        $data = User::find($request->id);
        // dd($data);
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

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request  );
            $oldFile = $request->imageUserDelete;

            if ($oldFile != 'default.png') {
                if (file_exists(public_path() . '/assets/uploads/images/user/' . $oldFile)) {
                    unlink(public_path() . '/assets/uploads/images/user/' . $oldFile);
                }
            }

            User::where('id', $request->userId_delete)->update(['deleted_by' => Auth::user()->email, 'deleted_at' => now()]);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success delete user",
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

    // public function profile(Request $request)
    // {
    //     // $data = User::find(Auth::user()->getAuthIdentifier());
    //     $data = Auth::user();
    //     $data['title'] = "LARAVEDIA || Profile";
    //     return view('account.profile', $data);
    // }
    // public function changePassword(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // $hashPassword = Hash::make($request->oldPassword);
    //         $database = User::where('id', $request->userId_changepassword)
    //             ->first();

    //         if (!(Hash::check($request->oldPassword, $database->password))) {
    //             return response()->json([
    //                 'status' => 202,
    //                 'success' => false,
    //                 'message' => "Old password does not match, please check again"
    //             ], 200);
    //         }

    //         // dd($request->all());
    //         // dd(Hash::make($request->password));
    //         // $data['updated_by'] = Auth::user()->email;
    //         User::where('id', $request->userId_changepassword)->update(
    //             [
    //                 'password' => Hash::make($request->password),
    //                 'updated_by' => Auth::user()->email
    //             ]
    //         );

    //         $status_code = 200;
    //         $response = array(
    //             'status' => 200,
    //             'message' => "success change password",
    //             'data' => [],
    //         );
    //         DB::commit();
    //         return response()->json($response, $status_code);
    //     } catch (Exception $e) {
    //         DB::rollback();
    //         return response()->json([
    //             'status' => 500,
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //             'data' => [],
    //         ], 200);
    //     }
    // }



}