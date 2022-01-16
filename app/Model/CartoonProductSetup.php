<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartoonProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('cartoon_product_price_setups')
            ->join('cartoon_product_setups', 'cartoon_product_setups.id', '=', 'cartoon_product_price_setups.cartoon_product_setup_id')
            ->select('cartoon_product_setups.name', 'cartoon_product_setups.id')
            ->where('cartoon_product_price_setups.supplier_id', $supplier_id)
            ->where('cartoon_product_setups.status', 'A')
            ->where('cartoon_product_price_setups.status', 'A')
            ->groupBy('cartoon_product_setups.name', 'cartoon_product_setups.id')
            ->orderBy('cartoon_product_setups.name')
            ->get();
    }

    public static function isBoard($id){
        if(CartoonProductSetup::find($id)->is_board){
            return true;
        }
        return false;
    }

}
