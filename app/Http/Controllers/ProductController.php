<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $data['title'] = "LARAVEDIA || Product";
        $data['product'] = Product::orderBy('created_by', 'DESC')->get();
        return view('product.index', $data);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());
            $data = $request->all();

            if ($request->has('imageProduct')) {
                //save file
                $file = $data['imageProduct'];
                $fileName = 'file' . time() . '.' . $file->extension();
                $data['image'] = $fileName;
                $file->move(public_path() . '/assets/uploads/images/product/', $fileName);
            } else {
                $data['image'] = "default.png";
            }

            unset($data['imageProduct']);

            //creted_by 
            $data['created_by'] = Auth::user()->email;
            $product = Product::create($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success",
                'data' => $product,
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
    public function getData(Request $request)
    {
        $data = Product::find($request->id);
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->all();
            $product = Product::find($request->productId_edit);
            if (!$product) {
                return response()->json([
                    'status' => 500,
                    'success' => false,
                    'message' => "Data not found",
                    'data' => [],
                ]);
            }

            if ($request->has('imageProductEdit')) {
                //save file
                $file = $data['imageProductEdit'];
                $fileName = 'file' . time() . '.' . $file->extension();
                $data['image'] = $fileName;
                $file->move(public_path() . '/assets/uploads/images/product/', $fileName);
            }
            unset($data['imageProductEdit']);
            unset($data['productId_edit']);

            $data['updated_by'] = Auth::user()->email;
            Product::where('id', $request->productId_edit)->update($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success edit product",
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
            $oldFile = $request->imageProductDelete;
            // dd($oldFile);

            if ($oldFile != 'default.png') {
                if (file_exists(public_path() . '/assets/uploads/images/product/' . $oldFile)) {
                    unlink(public_path() . '/assets/uploads/images/product/' . $oldFile);
                }
            }

            Product::where('id', $request->productId_delete)->update(['deleted_by' => Auth::user()->email, 'deleted_at' => now()]);
            // $product = Product::find($request->productId_delete);
            // $product->delete();

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "Success edit product",
                'data' => []
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