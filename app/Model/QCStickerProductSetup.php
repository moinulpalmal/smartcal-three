<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QCStickerProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('q_c_sticker_product_price_setups')
            ->join('q_c_sticker_product_setups', 'q_c_sticker_product_setups.id', '=', 'q_c_sticker_product_price_setups.q_c_sticker_product_setup_id')
            ->select('q_c_sticker_product_setups.name', 'q_c_sticker_product_setups.id')
            ->where('q_c_sticker_product_price_setups.supplier_id', $supplier_id)
            ->where('q_c_sticker_product_setups.status', 'A')
            ->where('q_c_sticker_product_price_setups.status', 'A')
            ->groupBy('q_c_sticker_product_setups.name', 'q_c_sticker_product_setups.id')
            ->orderBy('q_c_sticker_product_setups.name')
            ->get();
    }
}
