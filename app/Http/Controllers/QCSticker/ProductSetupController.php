<?php

namespace App\Http\Controllers\QCSticker;

use App\Http\Controllers\Controller;
use App\Model\QCStickerProductPriceSetup;
use App\Model\QCStickerProductSetup;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 4;
    public function index(){
        $products = QCStickerProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('qc-sticker.product.index', compact('products'));
    }

    public function detail($id){
        $product = QCStickerProductSetup::find($id);

        if($product != null){

            $productPriceSetups = QCStickerProductPriceSetup::where('status', '!=', 'D')
                ->where('q_c_sticker_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(4);

            return view('qc-sticker.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('qc-sticker.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = QCStickerProductSetup::find($request->id);
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
            $supplier = new QCStickerProductSetup();
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
        $factory = QCStickerProductSetup::find($req->id);
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

       /* if(!empty($id)){
            $priceSetup = QCStickerProductPriceSetup::find($id);

            //$priceSetup->interlining_product_setup_id = $request->interlining_product_setup_id;
            //$priceSetup->article_no = $request->article_no;
            //$priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;

            if($priceSetup->save()){
                return 'save';
            }

            return null;
        }
        else{

            $priceSetup = new QCStickerProductPriceSetup();

            $priceSetup->q_c_sticker_product_setup_id = $request->q_c_sticker_product_setup_id;
            //$priceSetup->article_no = $request->article_no;
            $priceSetup->supplier_id = $request->supplier;
            $priceSetup->unit_price = $request->unit_price;
            if($priceSetup->save()){
                return 'save';
            }
            return null;
        }*/

        $productPriceSetup = QCStickerProductPriceSetup::where('status', '!=', 'D')
            ->where('q_c_sticker_product_setup_id', $request->q_c_sticker_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();
        if($productPriceSetup != null){
            $conv_id = DB::table('q_c_sticker_product_price_setups')
                ->where('q_c_sticker_product_setup_id', $request->q_c_sticker_product_setup_id)
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

            $conv_id = DB::table('q_c_sticker_product_price_setups')->insertGetId(
                [
                    'q_c_sticker_product_setup_id' => $request->get('q_c_sticker_product_setup_id'),
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
        $priceSetup = QCStickerProductPriceSetup::find($id);
        $supplierData = array(
            'id' => $priceSetup->id,
            'q_c_sticker_product_setup_id' => $priceSetup->q_c_sticker_product_setup_id,
            //'article_no' => $priceSetup->article_no,
            'supplier' => $priceSetup->supplier_id,
            'unit_price' => $priceSetup->unit_price,
        );
        return $supplierData;
    }

    public function deleteProductPriceSetup(Request $request){
        //return $request->all();
        $id = $request->get('item_id');
        $priceSetup = QCStickerProductPriceSetup::find($id);

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

        $priceSetup = DB::table('q_c_sticker_product_price_setups')
            ->select('q_c_sticker_product_price_setups.unit_price')
            ->where('q_c_sticker_product_price_setups.q_c_sticker_product_setup_id', $request->id)
            ->where('q_c_sticker_product_price_setups.supplier_id', $request->supplier)
            ->where('q_c_sticker_product_price_setups.status', 'A')
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
        $DropDownData = DB::table("q_c_sticker_product_price_setups")
            ->select('q_c_sticker_product_price_setups.article_no AS name', 'q_c_sticker_product_price_setups.id')
            ->where("q_c_sticker_product_price_setups.q_c_sticker_product_setup_id", $req->id)
            ->where("q_c_sticker_product_price_setups.supplier_id", $req->supplier_id)
            ->where("q_c_sticker_product_price_setups.status", $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }*/
}
