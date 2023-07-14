<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\WarehouseDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WarehouseDtlController extends Controller
{
    public function warehouse(Request $request)
    {
        $warehouseId = $request->query('id'); // Access the id parameter from the query string directly
        $cekId = Warehouse::where('id', "$warehouseId")
            ->first();
        if (!$cekId) {
            return Redirect::route('warehouse');
        }

        $data['title'] = "LARAVEDIA || Warehouse";
        $data['warehousedtl'] = WarehouseDetail::orderBy('warehouse_detail.created_by', 'DESC')
            ->join('product', 'product.id', '=', 'warehouse_detail.product_id')
            ->join('warehouse', 'warehouse.id', '=', 'warehouse_detail.warehouse_id')
            ->select('warehouse_detail.*', 'product.name as product_name', 'product.image as product_image', 'product.price as product_price', 'product.description as product_description', 'warehouse.name as warehouse_name', 'warehouse.address as warehouse_address', 'warehouse.image as warehouse_image')
            ->where('warehouse.id', $warehouseId)
            ->get();
        $data['product'] = Product::orderBy('created_by', 'DESC')->get();
        $data['warehouse'] = Warehouse::where('id', $warehouseId)->first();
        return view('warehouse.detail', $data);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = [
                'warehouse_id' => $request->warehouse,
                'product_id' => $request->product,
                'stock' => $request->stock,
            ];

            $data['created_by'] = Auth::user()->email;
            // dd($data);
            $warehouseProduct = WarehouseDetail::create($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success",
                'data' => $warehouseProduct,
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
        // dd($request);
        $data = WarehouseDetail::find($request->id);
        return response()->json($data);
    }


    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->all();
            // dd($data);
            $warehouse = WarehouseDetail::find($request->warehouseProductId_edit);
            if (!$warehouse) {
                return response()->json([
                    'status' => 500,
                    'success' => false,
                    'message' => "Data not found",
                    'data' => [],
                ]);
            }

            unset($data['warehouseProductId_edit']);

            $data['updated_by'] = Auth::user()->email;
            WarehouseDetail::where('id', $request->warehouseProductId_edit)->update($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success edit warehouse",
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

    // public function destroy(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $oldFile = $request->imageWarehouseDelete;

    //         if (file_exists(public_path() . '/assets/uploads/images/warehouse/' . $oldFile)) {
    //             unlink(public_path() . '/assets/uploads/images/warehouse/' . $oldFile);
    //         }

    //         Warehouse::where('id', $request->warehouseId_delete)->update(['deleted_by' => Auth::user()->email, 'deleted_at' => now()]);

    //         $status_code = 200;
    //         $response = array(
    //             'status' => 200,
    //             'message' => "Success delete warehouse",
    //             'data' => []
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