<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Province;
use App\SubDistrict;
use App\RestaurantDetail;

class BranchController extends Controller
{
    public function detail(Request $req){
        $check = $req->input('find_mode');
        $is_search = true;
        $search = $req->input('search');

        if ($check == 1) {
            $branches = Branch::with(['subDistrict'])
                ->where('id', '=', $req->input('search'))
                ->where('status', '=', 1)
                ->get();
        } elseif ($check == 2) {
            $branches = Branch::with(['subDistrict'])
                ->where('name', 'like', '%' . $search . '%')
                ->where('status', '=', 1)
                ->get();
        } else {
            $branches = Branch::with(['subDistrict'])
                ->where('status', '=', 1)
                ->paginate(5);
            $is_search = false;
        }

        return view('back.impl.branch',[
            'is_search'=>$is_search,
            'unav'=>'branch',
            'branches'=>$branches,
            'find_mode'=>$check,
            'search'=>$search,
            'provinces'=>Province::all(),
            'promo'=>RestaurantDetail::find(1)
        ]);
    }

    public function open(Request $req){
        $branch = Branch::find($req->input('id'));
        $branch->status = 1;
        $branch->save();
        return redirect('staff/branch');
    }

    public function close(Request $req){
        $branch = Branch::find($req->input('id'));
        $branch->status = 0;
        $sub_district = SubDistrict::where('branch_id', '=', $branch->id);
        $branch->save();
        $sub_district->update([
            'branch_id'=>NULL
        ]);
        return redirect('staff/branch');
    }

    public function all(){
        return response(Branch::all());
    }

    public function create(Request $req){
        $sub_district_id = $req->input('sub_district');
        $sub_district = SubDistrict::find($sub_district_id);

        if ($sub_district->branch_id == null) {
            $branch = Branch::create([
                'name'=>$req->input('branch_name'),
                'lat'=>$req->input('lat'),
                'long'=>$req->input('long'),
                'status'=>$req->input('status'),
                'additional_address'=>$req->input('additional_address'),
                'road'=>$req->input('road'),
                'alley'=>$req->input('alley'),
                'house_number'=>$req->input('house_number'),
                'village_number'=>$req->input('village_number'),
            ]);

            $sub_district->branch_id = $branch->id;
            $sub_district->save();

        } else {
            $branch = $sub_district->branch->update([
                'name'=>$req->input('branch_name'),
                'lat'=>$req->input('lat'),
                'long'=>$req->input('long'),
                'status'=>$req->input('status'),
                'additional_address'=>$req->input('additional_address'),
                'road'=>$req->input('road'),
                'alley'=>$req->input('alley'),
                'house_number'=>$req->input('house_number'),
                'village_number'=>$req->input('village_number'),
            ]);
        }


        // //close replaced branches
        // $branches = Branch::with(['subDistrict'])->get();
        // foreach ($branches as $key => $value) {
        //     if ($value->subDistrict == null) {
        //         $value->status = 0;
        //         $value->save();
        //     }
        // }

        return redirect('staff/branch');
    }

    public function changePromotion(Request $req){
        $res = RestaurantDetail::find(1);
        $res->sum_price_discount = $req->input('sumCost');
        $res->shipping_cost = $req->input('shippingCost');
        $res->save();
    }

    public function getSubdistrictBranch(){
        return response(SubDistrict::whereNotNull('branch_id')->get());
    }
}
