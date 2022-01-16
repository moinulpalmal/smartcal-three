<?php

namespace App\Http\Controllers\Tissue;

use App\Http\Controllers\Controller;
use App\Model\FabricProductPriceSetup;
use App\Model\FabricProductSetup;
use App\Model\Supplier;
use App\Model\TissueProductPriceSetup;
use App\Model\TissueProductSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 3;
    public function index(){
        $products = TissueProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('tissue.product.index', compact('products'));
    }

    public function detail($id){
        $product = TissueProductSetup::find($id);

        if($product != null){

            $productPriceSetups = TissueProductPriceSetup::where('status', '!=', 'D')
                ->where('tissue_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(3);

            return view('tissue.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('tissue.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = TissueProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                //$supplier->gross_form_factor = $request->gross_form_factor;
                $supplier->last_updated_by = Auth::id();
                /* if($request->get('IsBoard') == 'on')
                 {
                     $supplier->is_board = true;
                 }
                 else
                 {
                     $supplier->is_board = false;
                 }*/
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new TissueProductSetup();
            $supplier->name = $request->name;
            /* if($request->gross_form_factor == null){
                 $supplier->gross_form_factor = 144;
             }
             else{
                 $supplier->gross_form_factor = $request->gross_form_factor;
             }*/

            $supplier->inserted_by = Auth::id();
            /* if($request->get('IsBoard') == 'on')
             {
                 $supplier->is_board = true;
             }
             else
             {
                 $supplier->is_board = false;
             }*/

            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateProduct(Request $req)
    {
        $factory = TissueProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
//            'gross_form_factor' => $factory->gross_form_factor,
            'id' => $factory->id
        );
        return $factoryData;
    }/*'is_board' => $factory->is_board,*/

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){
        $productPriceSetup = TissueProductPriceSetup::where('status', '!=', 'D')
            ->where('tissue_product_setup_id', $request->tissue_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();

        if($productPriceSetup != null){
            $conv_id = DB::table('tissue_product_price_setups')
                ->where('tissue_product_setup_id', $request->tissue_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([ 'per_dz_price' => $request->get('per_dz_price'), 'status' => 'A']);

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

            $conv_id = DB::table('tissue_product_price_setups')->insertGetId(
                [
                    'tissue_product_setup_id' => $request->get('tissue_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'per_dz_price' => $request->get('per_dz_price'),
                    'status' => 'A'
                ]
            );
            if(!empty($conv_id)){
                return true;
            }

            return null;
        }
    }

    public function getPriceSetup(Request $request)    {

        //return $request->all();
        $priceSetup = DB::table('tissue_product_price_setups')
            ->join('tissue_product_setups', 'tissue_product_price_setups.tissue_product_setup_id', '=', 'tissue_product_setups.id')
            ->select('tissue_product_price_setups.per_dz_price')
            ->where('tissue_product_price_setups.tissue_product_setup_id', $request->id)
            ->where('tissue_product_price_setups.supplier_id', $request->supplier_id)
            ->where('tissue_product_price_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'per_dz_price' => $priceSetup->per_dz_price,
        );
        return $supplierData;

        //return 0;
    }
}
