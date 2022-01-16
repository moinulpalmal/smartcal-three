<?php

namespace App\Http\Controllers\ArrowSticker;

use App\Http\Controllers\Controller;
use App\Model\AStickerProductPriceSetup;
use App\Model\AStickerProductSetup;
use App\Model\CartoonProductPriceSetup;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 5;

    public function index(){
        $products = AStickerProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('a-sticker.product.index', compact('products'));
    }

    public function detail($id){
        $product = AStickerProductSetup::find($id);

        if($product != null){

            $productPriceSetups = AStickerProductPriceSetup::where('status', '!=', 'D')
                ->where('a_sticker_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(5);

            return view('a-sticker.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('asticker.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = AStickerProductSetup::find($request->id);
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
            $supplier = new AStickerProductSetup();
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
        $factory = AStickerProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){

        /*$id = $request->get('id');

        if(!empty($id)){
            $priceSetup = AStickerProductPriceSetup::find($id);

            //$priceSetup->interlining_product_setup_id = $request->interlining_product_setup_id;
            $priceSetup->article_no = $request->article_no;
            //$priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;

            if($priceSetup->save()){
                return 'save';
            }

            return null;
        }
        else{

            $priceSetup = new AStickerProductPriceSetup();

            $priceSetup->a_sticker_product_setup_id = $request->a_sticker_product_setup_id;
//            $priceSetup->article_no = $request->article_no;
            $priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;
            if($priceSetup->save()){
                return 'save';
            }
            return null;
        }*/

        //******

        $productPriceSetup = AStickerProductPriceSetup::where('status', '!=', 'D')
            ->where('a_sticker_product_setup_id', $request->a_sticker_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();
        if($productPriceSetup != null){
            $conv_id = DB::table('a_sticker_product_price_setups')
                ->where('a_sticker_product_setup_id', $request->a_sticker_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([ 'unit_price' => $request->get('unit_price'), 'status' => 'A']);

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

            $conv_id = DB::table('a_sticker_product_price_setups')->insertGetId(
                [
                    'a_sticker_product_setup_id' => $request->get('a_sticker_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
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

    public function updateProductPriceSetup(Request $request){
        $id = $request->get('id');
        $priceSetup = AStickerProductPriceSetup::find($id);
        $supplierData = array(
            'id' => $priceSetup->id,
            'a_sticker_product_setup_id' => $priceSetup->interlining_product_setup_id,
//            'article_no' => $priceSetup->article_no,
            'supplier' => $priceSetup->supplier_id,
            'unit_price' => $priceSetup->unit_price,
        );
        return $supplierData;
    }

    public function deleteProductPriceSetup(Request $request){
        //return $request->all();
        $id = $request->get('item_id');
        $priceSetup = AStickerProductPriceSetup::find($id);

        if($priceSetup != null){
            $priceSetup->status = 'D';
            if($priceSetup->save()){
                return 'save';
            }

            return null;
        }

        return null;

    }

    public function getPriceSetup(Request $request){
        $priceSetup = DB::table('a_sticker_product_price_setups')
            ->select('a_sticker_product_price_setups.unit_price')
            ->where('a_sticker_product_price_setups.a_sticker_product_setup_id', $request->id)
            ->where('a_sticker_product_price_setups.supplier_id', $request->supplier)
            ->where('a_sticker_product_price_setups.status', 'A')
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

    /*public function getArticleList(Request $req){
        $status = 'A';
        $DropDownData = DB::table("a_sticker_product_price_setups")
            ->select('a_sticker_product_price_setups.article_no AS name', 'a_sticker_product_price_setups.id')
            ->where("a_sticker_product_price_setups.a_sticker_product_setup_id", $req->id)
            ->where("a_sticker_product_price_setups.supplier_id", $req->supplier_id)
            ->where("a_sticker_product_price_setups.status", $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }*/
}
