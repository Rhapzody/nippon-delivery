<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Menu;
use App\MenuPicture;
use App\MenuType;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductBackController extends Controller
{

    public function searchProduct($search_mode = null, $search_text = null)
    {

        switch ($search_mode) {
            case '0':
                $menus = Menu::with('tags', 'menuPictures', 'menuType')
                    ->where('name', 'like', $search_text . '%')
                    ->orWhere('id', '=', $search_text)
                    ->orWhereHas('tags', function ($q) use ($search_text) {
                        $q->where('name', 'like', $search_text . '%');
                    })
                    ->orWhereHas('menuType', function ($q) use ($search_text) {
                        $q->where('name', 'like', $search_text . '%');
                    })
                    ->paginate(5);
                break;

            case '1':
                $menus = Menu::with('tags', 'menuPictures', 'menuType')->where('name', 'like', $search_text . '%')->paginate(5);
                break;

            case '2':
                $thisType = MenuType::with('menus')->where('name', 'like', $search_text . '%')->first();
                if ($thisType == null) {
                    $menus = Menu::with('tags', 'menuPictures', 'menuType')->where('id', '=', -99)->paginate(5);
                } else {
                    $menus = $thisType->menus()->paginate(5);
                }
                break;

            case '3':
                $menus = Menu::with('tags', 'menuPictures', 'menuType')->where('id', '=', $search_text)->paginate(5);
                break;

            case '4':
                $thisTag = Tag::with('menus')->where('name', 'like', $search_text . '%')->first();
                if ($thisTag == null) {
                    $menus = Menu::with('tags', 'menuPictures', 'menuType')->where('id', '=', -99)->paginate(5);
                } else {
                    $menus = $thisTag->menus()->paginate(5);
                }
                break;

            default:
                $menus = Menu::with('tags', 'menuPictures', 'menuType')->paginate(5);
                break;
        }

        return view('back.impl.product', [
            'menus' => $menus,
            'nav' => 'show',
            'search_text' => $search_text,
            'search_mode' => $search_mode,
        ]);
    }

    public function addProduct()
    {

        $types = MenuType::all();
        $tags = Tag::all();

        return view('back.impl.add-product', [
            'types' => $types,
            'tags' => $tags,
            'nav' => 'add',
        ]);
    }

    public function addProductProcess(AddProductRequest $req)
    {
        $name = $req->input('name');
        $price = $req->input('price');
        $typeId = $req->input('type');
        $tagData = json_decode($req->input('tag_data'));
        $picName = json_decode($req->input('image_name'));
        $descript = $req->input('description');
        if (!is_array($tagData)) {
            $tagData = [];
        }

        if (!is_array($picName)) {
            $picName = [];
        }

        $newTags = [];
        $oldTags = [];
        if ($tagData) {
            foreach ($tagData as $value) {
                if ($value[0] == 0) {
                    $myTag = new Tag();
                    $myTag->name = $value[1];
                    $newTags[] = $myTag;
                } elseif ($value[0] > 0) {
                    $oldTags[] = $value[0];
                }
            }
        }

        $menu = new Menu();
        $menu->name = $name;
        $menu->price = $price;
        $menu->description = $descript;
        $menu->type_id = $typeId;
        $menu->save();
        $menu->tags()->sync($oldTags);
        $menu->tags()->saveMany($newTags);

        $image_name = 'man.png';
        if ($req->hasFile('menu_image')) {
            foreach ($req->file('menu_image') as $file) {
                $image_filename = $file->getClientOriginalName();
                if (in_array($image_filename, $picName)) {
                    $image_name = date('Y_m_d_His_') . $image_filename;
                    $storage = '/storage/app/public/';
                    $destination = base_path() . $storage;
                    $file->move($destination, $image_name);
                    $new_img = new MenuPicture();
                    $new_img->name = $image_name;
                    $menu->menuPictures()->saveMany([$new_img]);
                }
            }
        } else {
            $new_img = new MenuPicture();
            $new_img->name = $image_name;
            $menu->menuPictures()->saveMany([$new_img]);
        }

        $req->session()->flash('add-product-status', 'เพิ่มสินค้าใหม่ สำเร็จ!!!');

        return redirect('staff/product?nav=show');

    }

    public function editProduct($id)
    {
        $menu = Menu::with('tags', 'menuPictures', 'menuType')->find($id);
        $types = MenuType::all();
        $tags = Tag::all();

        return view('back.impl.edit-product', [
            'tags' => $tags,
            'types' => $types,
            'menu' => $menu,
            'nav' => 'edit',
        ]);
    }

    public function editProductProcess(EditProductRequest $req)
    {
        $id = $req->input('id');
        $menu = Menu::with('tags', 'menuPictures', 'menuType')->find($id);
        $menu->name = $req->input('name');
        $menu->price = $req->input('price');
        $menu->type_id = $req->input('type');
        $menu->description = $req->input('description');
        $menu->touch();
        $menu->save();

        $picName = json_decode($req->input('image_name'));
        $tagData = json_decode($req->input('tag_data'));

        $newTags = [];
        $oldTags = [];
        if ($tagData) {
            foreach ($tagData as $value) {
                if ($value[0] == 0) {
                    $myTag = new Tag();
                    $myTag->name = $value[1];
                    $newTags[] = $myTag;
                } elseif ($value[0] > 0) {
                    $oldTags[] = $value[0];
                }
            }
        }

        $menu->tags()->sync($oldTags);
        $menu->tags()->saveMany($newTags);

        if ($req->hasFile('menu_image')) {
            foreach ($req->file('menu_image') as $file) {
                $image_filename = $file->getClientOriginalName();
                if (in_array($image_filename, $picName)) {
                    $image_name = date('Y_m_d_His_') . $image_filename;
                    $storage = '/storage/app/public/';
                    $destination = base_path() . $storage;
                    $file->move($destination, $image_name);
                    $new_img = new MenuPicture();
                    $new_img->name = $image_name;
                    $menu->menuPictures()->saveMany([$new_img]);
                }
            }
        }

        $oldImageId = json_decode($req->input('old_image_id'));
        foreach ($oldImageId as $key => $value) {
            $img = MenuPicture::find($value);
            $name = $img->name;
            if ($name != 'man.png') {
                File::delete(base_path() . $storage . $name);
            }
            $img->delete();
        }

        return \App::make('redirect')->back()->with('message', 'บันทึกสำเร็จ');
    }

    public function deleteProduct($id)
    {
        Menu::find($id)->delete();
    }

    public function getProductDetailById(Request $req)
    {
        $id = $req->input('product_id');
        if ($id <= 0 || !is_numeric($id)) {
            abort(404);
        }
        $menu = Menu::with('tags', 'menuPictures', 'menuType')->find($id);
        return response()->json($menu->toArray());
    }

    public function getProductTagsById(Request $req)
    {
        $id = $req->input('productId');
        if ($id <= 0 || !is_numeric($id)) {
            abort(404);
        }
        $menu = Menu::with('tags')->find($id);
        return response()->json($menu->toArray());
    }

    public function getProductPicturesById(Request $req)
    {
        $id = $req->input('productId');
        if ($id <= 0 || !is_numeric($id)) {
            abort(404);
        }
        $menu = Menu::with('menuPictures')->find($id);
        return response()->json($menu->toArray());
    }
}
