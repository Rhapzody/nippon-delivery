<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class ProductController extends Controller
{
    public function product($id){
        if($id<=0 || !is_numeric($id)) abort(404);
        $product = Menu::with('menuPictures', 'menuType', 'tags')->withTrashed()->find($id);
        if($product == null) abort(404);
        return view('front.impl.product',[
            'product'=>$product
        ]);
    }
}
