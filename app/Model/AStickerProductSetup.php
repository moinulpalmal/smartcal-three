<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AStickerProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('a_sticker_product_price_setups')
            ->join('a_sticker_product_setups', 'a_sticker_product_setups.id', '=', 'a_sticker_product_price_setups.a_sticker_product_setup_id')
            ->select('a_sticker_product_setups.name', 'a_sticker_product_setups.id')
            ->where('a_sticker_product_price_setups.supplier_id', $supplier_id)
            ->where('a_sticker_product_setups.status', 'A')
            ->where('a_sticker_product_price_setups.status', 'A')
            ->groupBy('a_sticker_product_setups.name', 'a_sticker_product_setups.id')
            ->orderBy('a_sticker_product_setups.name')
            ->get();
    }
}
