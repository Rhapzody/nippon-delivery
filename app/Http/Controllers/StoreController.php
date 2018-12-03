<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function store(Request $req, $type = 'all')
    {
        $searching = false;
        $text = $req->input('search');
        $typeId = $req->input('typeId');
        $tagId = $req->input('tagId');
        if ($typeId  >= 0 && !is_null($typeId )) {
            $searching = true;
            $type = 'search';
            $menus = Menu::with('menuPictures', 'menuType')
                ->whereHas('menuType', function ($q) use ($typeId) {
                    $compare = "=";
                    if($typeId == 0) $compare = ">";
                    $q->where('id', $compare, $typeId);
                })
                ->where('name', 'like', $text . '%')
                ->get();
        }elseif($tagId  >= 1 && !is_null($tagId )){
            $searching = true;
            $menus = Menu::with('menuPictures', 'menuType', 'tags')
                ->whereHas('tags', function ($q) use ($tagId) {
                    $q->where('id', '=', $tagId);
                })
                ->get();
        }else{
            $menus = Menu::with('menuPictures', 'menuType')
            ->whereHas('menuType', function ($q) use ($type) {
                $search = $type;
                if ($type == 'all') $search = '';
                $q->where('name', 'like', $search . '%');
            })
            ->paginate(9);
        }


        $new_menu = Menu::with('menuPictures', 'menuType')->orderBy('updated_at', 'desc')->take(4)->get();

        $top_menu = Menu::with('menuPictures', 'menuType')->orderBy('hits', 'desc')->take(4)->get();

        $tags = Tag::all();

        return view('front.impl.store', [
            'tags' => $tags,
            'new_menu' => $new_menu,
            'top_menu' => $top_menu,
            'nav' => $type,
            'menus' => $menus,
            'searching'=>$searching,
            'search'=>$text,
            'search_type_id'=>$typeId
        ]);
    }

}
