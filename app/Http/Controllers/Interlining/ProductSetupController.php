<?php

namespace App\Http\Controllers\Interlining;

use App\Http\Controllers\Controller;
use App\Model\InterliningProductPriceSetup;
use App\Model\InterliningProductSetup;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 2;
    public function index(){
        $products = InterliningProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('interlining.product.index', compact('products'));
    }

    public function detail($id){
        $product = InterliningProductSetup::find($id);

        if($product != null){

            $productPriceSetups = InterliningProductPriceSetup::where('status', '!=', 'D')
                ->where('interlining_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(2);

            return view('interlining.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('fabric.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = InterliningProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                //$supplier->gross_form_factor = $request->gross_form_factor;
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
            $supplier = new InterliningProductSetup();
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
        $factory = InterliningProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){

        $id = $request->get('id');

        if(!empty($id)){
            $priceSetup = InterliningProductPriceSetup::find($id);

            //$priceSetup->interlining_product_setup_id = $request->interlining_product_setup_id;
            $priceSetup->article_no = $request->article_no;
            //$priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;
            $priceSetup->currency = $request->currency;
            if($priceSetup->save()){
                return 'save';
            }

            return null;
        }
        else{

            $priceSetup = new InterliningProductPriceSetup();

            $priceSetup->interlining_product_setup_id = $request->interlining_product_setup_id;
            $priceSetup->article_no = $request->article_no;
            $priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;
            $priceSetup->currency = $request->currency;
            if($priceSetup->save()){
                return 'save';
            }
            return null;
        }
    }

    public function updateProductPriceSetup(Request $request){
        $id = $request->get('id');
        $priceSetup = InterliningProductPriceSetup::find($id);
        $supplierData = array(
            'id' => $priceSetup->id,
            'interlining_product_setup_id' => $priceSetup->interlining_product_setup_id,
            'article_no' => $priceSetup->article_no,
            'supplier' => $priceSetup->supplier_id,
            'currency' => $priceSetup->currency,
            'unit_price' => $priceSetup->unit_price,
        );
        return $supplierData;
    }

    public function deleteProductPriceSetup(Request $request){
        //return $request->all();
        $id = $request->get('item_id');
        $priceSetup = InterliningProductPriceSetup::find($id);

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

        $priceSetup = DB::table('interlining_product_price_setups')
            ->select('interlining_product_price_setups.unit_price', 'interlining_product_price_setups.currency')
            ->where('interlining_product_price_setups.id', $request->id)
            ->where('interlining_product_price_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'unit_price' => $priceSetup->unit_price,
            'currency' => $priceSetup->currency,
        );
        return $supplierData;

        //return 0;
    }

    public function getArticleList(Request $req){
        $status = 'A';
        $DropDownData = DB::table("interlining_product_price_setups")
            ->select('interlining_product_price_setups.article_no AS name', 'interlining_product_price_setups.id')
            ->where("interlining_product_price_setups.interlining_product_setup_id", $req->id)
            ->where("interlining_product_price_setups.supplier_id", $req->supplier_id)
            ->where("interlining_product_price_setups.status", $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }

}
