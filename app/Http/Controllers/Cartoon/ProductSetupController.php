<?php

namespace App\Http\Controllers\Cartoon;

use App\Http\Controllers\Controller;
use App\Model\CartoonProductPriceSetup;
use App\Model\CartoonProductSetup;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 1;
    public function index(){
        $products = CartoonProductSetup::orderBy('name')
                    ->where('status', '!=', 'D')
                    ->get();

        return view('cartoon.product.index', compact('products'));
    }

    public function detail($id){
        $product = CartoonProductSetup::find($id);

        if($product != null){

            $productPriceSetups = CartoonProductPriceSetup::where('status', '!=', 'D')
                    ->where('cartoon_product_setup_id', $id)
                    ->where('status', '!=', 'D')
                    ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(1);
            $units = Unit::getAllActiveUnitsForSelectList();

            return view('cartoon.product.detail',
                compact('product', 'productPriceSetups',
                    'supplierByGroup', 'units'));
        }

        return redirect()->route('cartoon.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = CartoonProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->last_updated_by = Auth::id();
                if($request->get('IsBoard') == 'on')
                {
                    $supplier->is_board = true;
                }
                else
                {
                    $supplier->is_board = false;
                }

                if($request->get('has_sub_measurement') == 'on')
                {
                    $supplier->has_sub_measurement = true;
                }
                else
                {
                    $supplier->has_sub_measurement = false;
                }

                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new CartoonProductSetup();
            $supplier->name = $request->name;
            $supplier->inserted_by = Auth::id();
            if($request->get('IsBoard') == 'on')
            {
                $supplier->is_board = true;
            }
            else
            {
                $supplier->is_board = false;
            }

            if($request->get('has_sub_measurement') == 'on')
            {
                $supplier->has_sub_measurement = true;
            }
            else
            {
                $supplier->has_sub_measurement = false;
            }

            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateProduct(Request $req)
    {
        $factory = CartoonProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'has_sub_measurement' => $factory->has_sub_measurement,
            'is_board' => $factory->is_board,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }

    public function savePriceSetup(Request $request){

        $productPriceSetup = CartoonProductPriceSetup::where('status', '!=', 'D')
            ->where('cartoon_product_setup_id', $request->cartoon_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('measurement_detail', $request->measurement_detail)
            ->where('length', $request->length)
            ->where('width', $request->width)
            ->where('height', $request->height)
            /*->where('input_unit_id', $request->input_unit)*/
            ->where('status', '!=', 'D')
            ->first();

        if($productPriceSetup != null){
            $conv_id = DB::table('cartoon_product_price_setups')
                ->where('cartoon_product_setup_id', $request->cartoon_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->where('supplier_id', $request->supplier)
                ->where('measurement_detail', $request->measurement_detail)
                ->where('length', $request->length)
                ->where('width', $request->width)
                ->where('height', $request->height)
               /* ->where('input_unit_id', $request->input_unit)*/
                ->update([
                    'per_sqm_price' => $request->get('per_sqm_price'),
                    'length' => $request->get('length'),
                    'width' => $request->get('width'),
                    'height' => $request->get('height'),
                    'input_unit_id' => $request->get('input_unit'),
                    'status' => 'A'
                    ]);

            return $conv_id ;
        }
        else{
            /*$newProductPriceSetup = new CartoonProductPriceSetup();

            $newProductPriceSetup->cartoon_product_setup_id = $request->cartoon_product_setup_id;
            $newProductPriceSetup->supplier_id = $request->supplier;
            $newProductPriceSetup->per_sqm_price = $request->per_sqm_price;

            if($newProductPriceSetup->save()){
                return 'Saved';
            }

            return null;*/

            $conv_id = DB::table('cartoon_product_price_setups')->insertGetId(
                [
                    'cartoon_product_setup_id' => $request->get('cartoon_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'per_sqm_price' => $request->get('per_sqm_price'),
                    'measurement_detail' => $request->get('measurement_detail'),
                    'length' => $request->get('length'),
                    'width' => $request->get('width'),
                    'height' => $request->get('height'),
                    'input_unit_id' => $request->get('input_unit'),
                    'status' => 'A'
                ]
            );
            if(!empty($conv_id)){
                return true;
            }

            return null;
        }
    }

    public function getPriceSetup(Request $request)
    {
        $priceSetup = DB::table('cartoon_product_price_setups')
            ->join('cartoon_product_setups', 'cartoon_product_price_setups.cartoon_product_setup_id', '=', 'cartoon_product_setups.id')
            ->select('cartoon_product_price_setups.per_sqm_price', 'cartoon_product_setups.is_board', 'cartoon_product_setups.has_sub_measurement',
                'cartoon_product_price_setups.length', 'cartoon_product_price_setups.width',
                'cartoon_product_price_setups.height', 'cartoon_product_price_setups.input_unit_id')
            ->where('cartoon_product_price_setups.cartoon_product_setup_id', $request->cartoon_product_setup_id)
            ->where('cartoon_product_price_setups.supplier_id', $request->supplier_id)
            ->where('cartoon_product_price_setups.measurement_detail', $request->measurement_detail)
            ->where('cartoon_product_price_setups.status', 'A')
            ->first();

        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'unit_per_square_meter_price' => $priceSetup->per_sqm_price,
            'length' => $priceSetup->length,
            'width' => $priceSetup->width,
            'height' => $priceSetup->height,
            'input_unit' => $priceSetup->input_unit_id,
            'is_board' => $priceSetup->is_board,
        );
        return $supplierData;
    }

    public function getMeasurementDetailList(Request $request){
        $status = 'A';
        $DropDownData = DB::table("cartoon_product_price_setups")
            ->select('cartoon_product_price_setups.measurement_detail AS name', 'cartoon_product_price_setups.measurement_detail AS id')
            ->where('cartoon_product_price_setups.supplier_id', $request->supplier_id)
            ->where('cartoon_product_price_setups.cartoon_product_setup_id', $request->cartoon_product_setup_id)
            ->where("cartoon_product_price_setups.status", $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }


}
