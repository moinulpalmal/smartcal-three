<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ProductGroup;
use App\Model\Role;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    public function index(){
        /*$roles = Role::orderBy('id')
            ->where('id', '!=', 1)
            ->get();*/

        ///return $roles;
/*
        foreach ($roles as $role){
            $supplier = new ProductGroup();
            $supplier->group_name = $role->view_name;
            $supplier->group_access_name = $role->name;
            $supplier->save();
        }*/

        $productGroups = ProductGroup::orderBy('group_name')
            ->get();;

        //return $productGroup;

        return view('admin.product-group.index', compact('productGroups'));
    }

    public function saveGroup(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = ProductGroup::find($request->id);
            if($supplier != null){
                $supplier->group_name = $request->name;
                $supplier->group_access_name = $request->view_name;
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new ProductGroup();
            $supplier->group_name = $request->name;
            $supplier->group_access_name = $request->view_name;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateGroup(Request $req)
    {
        $supplier = ProductGroup::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->group_name,
            'view_name' => $supplier->group_access_name
        );
        return $supplierData;
    }
}
