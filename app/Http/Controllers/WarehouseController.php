<?php

namespace App\Http\Controllers;

use Exception;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $data['title'] = "LARAVEDIA || Warehouse";
        // $data['warehouse'] = Warehouse::orderBy('created_by', 'DESC')->get();
        $data['warehouse'] = Warehouse::orderBy('warehouse.created_by', 'DESC')
            ->select('warehouse.*', DB::raw('COUNT(warehouse_detail.id) as total_product'))
            ->join('warehouse_detail', 'warehouse_detail.warehouse_id', '=', 'warehouse.id')
            ->groupBy('warehouse.id')
            ->get();
        // dd($data);
        return view('warehouse.index', $data);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->all());
            $data = $request->all();

            if ($request->has('imageWarehouse')) {
                //save file
                $file = $data['imageWarehouse'];
                $fileName = 'file' . time() . '.' . $file->extension();
                $data['image'] = $fileName;
                $file->move(public_path() . '/assets/uploads/images/warehouse/', $fileName);
            }

            unset($data['imageWarehouse']);

            //creted_by 
            $data['created_by'] = Auth::user()->email;
            $warehouse = Warehouse::create($data);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "success",
                'data' => $warehouse,
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
        $data = Warehouse::find($request->id);
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->all();
            $warehouse = Warehouse::find($request->warehouseId_edit);
            if (!$warehouse) {
                return response()->json([
                    'status' => 500,
                    'success' => false,
                    'message' => "Data not found",
                    'data' => [],
                ]);
            }

            if ($request->has('imageWarehouseEdit')) {
                //save file
                $file = $data['imageWarehouseEdit'];
                $fileName = 'file' . time() . '.' . $file->extension();
                $data['image'] = $fileName;
                $file->move(public_path() . '/assets/uploads/images/warehouse/', $fileName);
            }
            unset($data['imageWarehouseEdit']);
            unset($data['warehouseId_edit']);

            $data['updated_by'] = Auth::user()->email;
            Warehouse::where('id', $request->warehouseId_edit)->update($data);

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

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $oldFile = $request->imageWarehouseDelete;

            if (file_exists(public_path() . '/assets/uploads/images/warehouse/' . $oldFile)) {
                unlink(public_path() . '/assets/uploads/images/warehouse/' . $oldFile);
            }

            Warehouse::where('id', $request->warehouseId_delete)->update(['deleted_by' => Auth::user()->email, 'deleted_at' => now()]);

            $status_code = 200;
            $response = array(
                'status' => 200,
                'message' => "Success delete warehouse",
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