<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(){
        $buyers = Buyer::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.buyer.index', compact('buyers'));
    }

    public function saveBuyer(Request $req)
    {
        $HiddenDepartmentID = $req->get('id');
        if(!empty($HiddenDepartmentID))
        {

            $buyer = Buyer::find($HiddenDepartmentID);
            if($buyer != null){
                $buyer->name = $req->get('name');
                $buyer->short_name = $req->get('short_name');
                if($buyer->save())
                {
                    return 'Updated';
                }
            }
            return 'Error';
        }
        else
        {
            $buyer = new Buyer();
            $buyer->name = $req->get('name');
            $buyer->short_name = $req->get('short_name');
            if($buyer->save())
            {
                return 'Saved';
            }
        }
        return 'Error';
    }

    public function updateBuyer(Request $req)
    {
        $buyer = Buyer::find($req->id);
        if($buyer != null){
            $buyerData = array(
                'name' => $buyer->name,
                'short_name' => $buyer->short_name,
                'id' => $buyer->id
            );
            return $buyerData;
        }
        return 'Error';
    }

    public function deActivateBuyer(Request $request){
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'IA';
            if($buyer->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function activateBuyer(Request $request){
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'A';
            if($buyer->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }

    public function deleteBuyer(Request $request){
        $buyer = Buyer::find($request->id);
        if($buyer != null){
            $buyer->status = 'D';
            if($buyer->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }
}
