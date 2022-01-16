<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GumTapeProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('gum_tape_product_price_setups')
            ->join('gum_tape_product_setups', 'gum_tape_product_setups.id', '=', 'gum_tape_product_price_setups.gum_tape_product_setup_id')
            ->select('gum_tape_product_setups.name', 'gum_tape_product_setups.id')
            ->where('gum_tape_product_price_setups.supplier_id', $supplier_id)
            ->where('gum_tape_product_setups.status', 'A')
            ->where('gum_tape_product_price_setups.status', 'A')
            ->groupBy('gum_tape_product_setups.name', 'gum_tape_product_setups.id')
            ->orderBy('gum_tape_product_setups.name')
            ->get();
    }
}
