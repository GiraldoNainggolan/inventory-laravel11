<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function add_item()
    {
        if (Session::get('session_user_type') === 'admin') {
            return view('add_item');
        }
        return redirect(url('index'))->with("fail", "Only Admins can add Item");
    }

    public function add_item_post(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_hsn' => 'required',
            'item_unit' => 'required',
            'item_desc' => 'required',
            'item_mrp' => 'required|numeric',
            'item_purchase' => 'required|numeric',
            'item_sale' => 'required|numeric'
        ]);

        try {
            Inventory::create([
                'item_name' => $request->item_name,
                'item_hsn' => $request->item_hsn,
                'item_unit' => $request->item_unit,
                'item_desc' => $request->item_desc,
                'item_mrp' => $request->item_mrp,
                'item_purchase' => $request->item_purchase,
                'item_sale' => $request->item_sale,
                'item_stock' => 0,
                'item_status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            Log::info('Item added to inventory', [
                'item_name' => $request->item_name,
                'user_type' => Session::get('session_user_type'),
                'user_name' => Session::get('session_name'),
            ]);

            return redirect(url('list_item'))->with("success", "Item added successfully");
        } catch (\Exception $e) {
            Log::error('Failed to add item to inventory', [
                'error_message' => $e->getMessage(),
                'user_type' => Session::get('session_user_type'),
                'user_name' => Session::get('session_name'),
            ]);

            return redirect(url('add_item'))->with("error", "Item adding failed, try again");
        }
    }

    public function list_item()
    {
        $list_item = Inventory::where('item_status', 1)->get();
        return view('list_item', compact('list_item'));
    }

    public function list_item_status()
    {
        $list_item_status = Inventory::all();
        return view('list_item_status', compact('list_item_status'));
    }

    public function list_item_status_change($id, $item_status)
    {
        Inventory::where('id', $id)->update([
            'item_status' => $item_status == 1 ? 0 : 1,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function get_item(Request $request)
    {
        $item = Inventory::find($request->id);
        $purchase_item = DB::table('purchase_item')->where("item_id", $request->id)->get();
        $sale_item = DB::table('sale_item')->where("item_id", $request->id)->get();

        return response()->json(compact('item', 'purchase_item', 'sale_item'));
    }

    public function edit_item(Request $request)
    {
        $item = Inventory::find($request->id);
        return response()->json(compact('item'));
    }

    public function edit_item_post(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_hsn' => 'required',
            'item_unit' => 'required',
            'item_desc' => 'required',
            'item_mrp' => 'required|numeric',
            'item_purchase' => 'required|numeric',
            'item_sale' => 'required|numeric',
            'item_stock' => 'required|numeric'
        ]);

        try {
            Inventory::where('id', $request->item_id)->update([
                'item_name' => $request->item_name,
                'item_hsn' => $request->item_hsn,
                'item_unit' => $request->item_unit,
                'item_desc' => $request->item_desc,
                'item_mrp' => $request->item_mrp,
                'item_purchase' => $request->item_purchase,
                'item_sale' => $request->item_sale,
                'item_stock' => $request->item_stock,
                'updated_at' => Carbon::now()
            ]);

            Log::info('Item updated in inventory', [
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,
                'user_type' => Session::get('session_user_type'),
                'user_name' => Session::get('session_name'),
            ]);

            return redirect(url('list_item'))->with("success", "Item updated successfully");
        } catch (\Exception $e) {
            Log::error('Failed to update item in inventory', [
                'error_message' => $e->getMessage(),
                'user_type' => Session::get('session_user_type'),
                'user_name' => Session::get('session_name'),
            ]);

            return redirect(url('list_item'))->with("error", "Item updating failed, try again");
        }
    }

    public function exportInventory()
    {
        if (Session::get('session_user_type') === 'suadmin') {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $headers = ['ID', 'Item Name', 'Stock', 'HSN', 'MRP', 'PURCHASE', 'SALE', 'DESC', 'UNIT'];
            $sheet->fromArray([$headers], null, 'A1');

            $inventory = Inventory::all();
            $row = 2;

            foreach ($inventory as $item) {
                $sheet->fromArray([
                    $item->id, $item->item_name, $item->item_stock, $item->item_hsn, 
                    $item->item_mrp, $item->item_purchase, $item->item_sale, $item->item_desc, 
                    $item->item_unit
                ], null, "A$row");
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'inventory.xlsx';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        }
        return redirect(url('index'))->with("fail", "Only Super Admins can export items");
    }

    public function importInventory()
    {
        return view('import');
    }

    public function importInventoryPost(Request $request)
    {
        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        foreach (array_slice($rows, 1) as $row) {
            Inventory::create([
                'item_name' => $row[1],
                'item_stock' => $row[2],
                'item_hsn' => $row[3],
                'item_mrp' => $row[4],
                'item_purchase' => $row[5],
                'item_sale' => $row[6],
                'item_desc' => $row[7],
                'item_unit' => $row[8],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect(url('list_item'))->with("success", "Inventory imported successfully");
    }
}
