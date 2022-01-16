<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use App\Model\ThreadProductPriceSetup;
use App\Model\ThreadProductSetup;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 12;
    public function index(){


        $products = ThreadProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('thread.product.index', compact('products'));
    }

    public function detail($id){
        $product = ThreadProductSetup::find($id);

        if($product != null){

            $productPriceSetups = ThreadProductPriceSetup::where('status', '!=', 'D')
                ->where('thread_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(12);

            return view('thread.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('thread.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = ThreadProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                //$supplier->gross_form_factor = $request->gross_form_factor;
                $supplier->per_con_length = $request->per_con_length;
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
            $supplier = new ThreadProductSetup();
            $supplier->name = $request->name;
            $supplier->per_con_length = $request->per_con_length;
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
        $factory = ThreadProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'per_con_length' => $factory->per_con_length,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){
        //$id = $request->get('id');

        $productPriceSetup = ThreadProductPriceSetup::where('status', '!=', 'D')
            ->where('thread_product_setup_id', $request->thread_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();
        if($productPriceSetup != null){
            $conv_id = DB::table('thread_product_price_setups')
                ->where('thread_product_setup_id', $request->thread_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([
                    'unit_price' => $request->get('unit_price'),
                    'status' => 'A',
                    'decimal_count' => $this->getDecimalCount($request->get('unit_price'))
                ]);

            return $conv_id ;
        }
        else {
            /*$newProductPriceSetup = new CartoonProductPriceSetup();

            $newProductPriceSetup->cartoon_product_setup_id = $request->cartoon_product_setup_id;
            $newProductPriceSetup->supplier_id = $request->supplier;
            $newProductPriceSetup->per_sqm_price = $request->per_sqm_price;

            if($newProductPriceSetup->save()){
                return 'Saved';
            }

            return null;*/

            $conv_id = DB::table('thread_product_price_setups')->insertGetId(
                [
                    'thread_product_setup_id' => $request->get('thread_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'decimal_count' => $this->getDecimalCount($request->get('unit_price')),
                    'unit_price' => $request->get('unit_price'),
                    'status' => 'A'
                ]
            );
            if (!empty($conv_id)) {
                return true;
            }

            return null;
        }
    }

    private function getDecimalCount($value){
        $result = (integer)(strlen(strrchr(($value), '.')) -1);

        return $result;
        /*if($result <= 2){
            return 2;
        }
        else{
            return $result;
        }*/
    }

    public function updateProductPriceSetup(Request $request){
        $id = $request->get('id');
        $priceSetup = ThreadProductPriceSetup::find($id);
        $supplierData = array(
            'id' => $priceSetup->id,
            'thread_product_setup_id' => $priceSetup->thread_product_setup_id,
            //'article_no' => $priceSetup->article_no,
            'supplier' => $priceSetup->supplier_id,
            'unit_price' => $priceSetup->unit_price,
        );
        return $supplierData;
    }

    public function deleteProductPriceSetup(Request $request){
        //return $request->all();
        $id = $request->get('item_id');
        $priceSetup = ThreadProductPriceSetup::find($id);

        if($priceSetup != null){
            $priceSetup->status = 'D';
            if($priceSetup->save()){
                return 'save';
            }

            return null;
        }

        return null;

    }

    public function getPriceSetup(Request $request)    {

        $priceSetup = DB::table('thread_product_price_setups')
            ->join('thread_product_setups', 'thread_product_setups.id', '=', 'thread_product_price_setups.thread_product_setup_id')
            ->select('thread_product_price_setups.unit_price', 'thread_product_price_setups.decimal_count',
                'thread_product_setups.per_con_length')
            ->where('thread_product_setups.id', $request->id)
            ->where('thread_product_price_setups.supplier_id', $request->supplier)
            ->where('thread_product_price_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'unit_price' => $priceSetup->unit_price,
            'decimal_count' => $priceSetup->decimal_count,
            'per_con_length' => $priceSetup->per_con_length
        );
        return $supplierData;

        //return 0;
    }

}
