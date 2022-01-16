<?php

namespace App\Http\Controllers\GeneralItem;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use App\Model\GeneralProductPriceSetup;
use App\Model\GeneralProductSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 7;
    public function index(){
        $products = GeneralProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('generalitem.product.index', compact('products'));
    }

    public function detail($id){
        $product = GeneralProductSetup::find($id);

        if($product != null){

            $productPriceSetups = GeneralProductPriceSetup::where('status', '!=', 'D')
                ->where('general_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(7);

            return view('generalitem.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('generalitem.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = GeneralProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->last_updated_by = Auth::id();
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new GeneralProductSetup();
            $supplier->name = $request->name;
            $supplier->inserted_by = Auth::id();

            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateProduct(Request $req)
    {
        $factory = GeneralProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){
        //$id = $request->get('id');

        $productPriceSetup = GeneralProductPriceSetup::where('status', '!=', 'D')
            ->where('general_product_setup_id', $request->general_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();
        if($productPriceSetup != null){
            $conv_id = DB::table('general_product_price_setups')
                ->where('general_product_setup_id', $request->general_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([
                    'unit_price' => $request->get('unit_price'),
                    'currency' => $request->get('currency'),
                    'status' => 'A'
                ]);

            return $conv_id ;
        }
        else {

            $conv_id = DB::table('general_product_price_setups')->insertGetId(
                [
                    'general_product_setup_id' => $request->get('general_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'unit_price' => $request->get('unit_price'),
                    'currency' => $request->get('currency'),
                    'status' => 'A'
                ]
            );
            if (!empty($conv_id)) {
                return true;
            }

            return null;
        }
    }
    public function getPriceSetup(Request $request)    {

        $priceSetup = DB::table('general_product_price_setups')
            ->join('general_product_setups', 'general_product_setups.id', '=', 'general_product_price_setups.general_product_setup_id')
            ->select('general_product_price_setups.unit_price', 'general_product_price_setups.currency')
            ->where('general_product_setups.id', $request->id)
            ->where('general_product_price_setups.supplier_id', $request->supplier)
            ->where('general_product_price_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'unit_price' => $priceSetup->unit_price,
        );
        return $supplierData;

        //return 0;
    }
}
