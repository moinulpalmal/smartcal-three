<?php

namespace App\Http\Controllers\Elastic;

use App\Http\Controllers\Controller;
use App\Model\CartoonProductPriceSetup;
use App\Model\CartoonProductSetup;
use App\Model\ElasticProductPriceSetup;
use App\Model\ElasticProductSetup;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 8;
    public function index(){
        $products = ElasticProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('elastic.product.index', compact('products'));
    }

    public function detail($id){
        $product = ElasticProductSetup::find($id);

        if($product != null){

            $productPriceSetups = ElasticProductPriceSetup::where('status', '!=', 'D')
                ->where('elastic_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(8);

            return view('elastic.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('elastic.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = ElasticProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->gross_form_factor = $request->gross_form_factor;
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
            $supplier = new ElasticProductSetup();
            $supplier->name = $request->name;
            if($request->gross_form_factor == null){
                $supplier->gross_form_factor = 144;
            }
            else{
                $supplier->gross_form_factor = $request->gross_form_factor;
            }

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
        $factory = ElasticProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'gross_form_factor' => $factory->gross_form_factor,
            'id' => $factory->id
        );
        return $factoryData;
    }/*'is_board' => $factory->is_board,*/

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){
        $productPriceSetup = ElasticProductPriceSetup::where('status', '!=', 'D')
            ->where('elastic_product_setup_id', $request->elastic_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();

        if($productPriceSetup != null){
            $conv_id = DB::table('elastic_product_price_setups')
                ->where('elastic_product_setup_id', $request->elastic_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([/* 'per_sqm_price' => $request->get('per_sqm_price'),*/ 'status' => 'A']);

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

            $conv_id = DB::table('elastic_product_price_setups')->insertGetId(
                [
                    'elastic_product_setup_id' => $request->get('elastic_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
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

        $priceSetup = DB::table('elastic_product_setups')
            ->select('elastic_product_setups.gross_form_factor')
            ->where('elastic_product_setups.id', $request->id)
            ->where('elastic_product_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'gross_form_factor' => $priceSetup->gross_form_factor,
        );
        return $supplierData;
    }
}
