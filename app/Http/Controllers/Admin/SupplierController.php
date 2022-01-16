<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ProductGroup;
use App\Model\Role;
use App\Model\Supplier;
use App\Model\Task;
use App\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::orderBy('name')->where('status', '!=', 'D')->get();
        $productGroups = ProductGroup::orderBy('group_name')->get();
        return view('admin.supplier.index', compact('suppliers', 'productGroups'));
    }

    public function saveSupplier(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Supplier::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->address = $request->address;
                $supplier->primary_contact_person = $request->primary_contact_person;
                $supplier->primary_designation = $request->primary_designation;
                $supplier->primary_mobile_no = $request->primary_mobile_no;
                $supplier->primary_email = $request->primary_email;
                $supplier->secondary_contact_person = $request->secondary_contact_person;
                $supplier->secondary_designation = $request->secondary_designation;
                $supplier->secondary_mobile_no = $request->secondary_mobile_no;
                $supplier->secondary_email = $request->secondary_email;
                $supplier->remarks = $request->remarks;

                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->address = $request->address;
            $supplier->primary_contact_person = $request->primary_contact_person;
            $supplier->primary_designation = $request->primary_designation;
            $supplier->primary_mobile_no = $request->primary_mobile_no;
            $supplier->primary_email = $request->primary_email;
            $supplier->secondary_contact_person = $request->secondary_contact_person;
            $supplier->secondary_designation = $request->secondary_designation;
            $supplier->secondary_mobile_no = $request->secondary_mobile_no;
            $supplier->secondary_email = $request->secondary_email;
            $supplier->remarks = $request->remarks;
            $supplier->status = 'I';
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateSupplier(Request $req)
    {
        $supplier = Supplier::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'address' => $supplier->address,
            'primary_contact_person' => $supplier->primary_contact_person,
            'primary_mobile_no' => $supplier->primary_mobile_no,
            'primary_email' => $supplier->primary_email,
            'primary_designation' => $supplier->primary_designation,
            'secondary_contact_person' => $supplier->secondary_contact_person,
            'secondary_mobile_no' => $supplier->secondary_mobile_no,
            'secondary_email' => $supplier->secondary_email,
            'secondary_designation' => $supplier->secondary_designation,
            'remarks' => $supplier->remarks
        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function blackList(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'B';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function applyGroupAccess(Request $request){

        $supplier = Supplier::find($request->supplier_id);

        //return $request->all();


        $groupList = ProductGroup::orderBy('group_access_name')->get();
        foreach ($groupList as $group) {


            if(!empty($request->get('r_'.$group->group_access_name))){
                if($request->get('r_'.$group->group_access_name) == 'on'){
                    if(!Supplier::hasProductGroupPermission($group->group_access_name, $request->supplier_id)){
                        $supplier->product_groups()->attach($group->id);
                    }
                    else{

                    }
                }
                else{
                    $supplier->product_groups()->detach($group->id);
                }
            }
            else{
                $supplier->product_groups()->detach($group->id);
            }
            //if($req->get('IsCHO') == 'on')
        }

        //$taskList = Task::orderBy('view_name')->get();



        /* if($req->get('IsCHO') == 'on')
         {
             $DataUpdate->update('factories','id',$HiddenFactoryID,'is_cho',true);
         }*/

        /* $user = User::find($user_id);
         $user->roles()->attach($role_id);
         return redirect()->route('administration.user.detail', ['id'=>$user->id]);*/

        return 'Update';
    }
}
