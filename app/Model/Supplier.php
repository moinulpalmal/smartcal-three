<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    public function product_groups()
    {
        return $this->belongsToMany('App\Model\ProductGroup');
    }

    public static function hasProductGroupPermission($product_group, $supplier_id){
        $supplier = Supplier::find($supplier_id);

        $product_groups = $supplier->product_groups()->where('group_access_name', $product_group)->count();
        if($product_groups >= 1){
            return true;
        }
        return false;
    }

    public static function getActiveSupplierByProductGroup($product_group_id){
        return DB::table('product_group_supplier')
            ->join('suppliers', 'suppliers.id', '=', 'product_group_supplier.supplier_id')
            ->select('suppliers.name', 'suppliers.id')
            ->where('product_group_supplier.product_group_id', $product_group_id)
            ->where('suppliers.status', 'A')
            ->orderBy('suppliers.name')
            ->get();
    }
}
