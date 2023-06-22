<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\ProdukHukumType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $menus = Menu::orderBy('id', 'asc')->where('is_active', 1)->get();
        $menus_name = Menu::select('id', 'menu_name', 'parent_id')->where('is_active', 1)->orderBy('parent_id', 'asc')->get();
        $rules_name = ProdukHukumType::orderBy('type_name', 'asc')->where('type_active', 1)->get();
        return view('admin.menu.index', compact('menus', 'menus_name', 'rules_name'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|unique:menus'
        ]);
        
        $menuCreate = new Menu();
        $data = $request->only($menuCreate->getFillable());
        
        $data['menu_status'] = 'Hide';
        $data['type_doc'] = 0;
        $data['parent_id'] = 0;
        $data['editabled'] = 1;
        $data['is_active'] = 1;

        $menuCreate->fill($data)->save();
        
        return response()->json(['code'=>200, 'message'=>'Created menu successfully','data' => $data], 200);
    }

    public function update(Request $request)
    {

        echo '<pre>';
        print_r(request('menu_id'));
        echo '</pre>';

        echo '<pre>';
        print_r(request('menu_status'));
        echo '</pre>';

        echo '<pre>';
        print_r(request('parent_id'));
        echo '</pre>';

        echo '<pre>';
        print_r(request('slug'));
        echo '</pre>';

        $i=0;
        foreach(request('menu_id') as $value)
        {
            $arr1[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(request('parent_id') as $value)
        {
            $arr3[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(request('slug') as $value)
        {
            $arr4[$i] = $value;
            $i++;
        }

        $i=0;
        foreach(request('menu_status') as $value)
        {
            $arr2[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('editabled') as $value)
        {
            $arr5[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('menu_name') as $value)
        {
            $arr6[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('type_doc') as $value)
        {
            $arr7[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('menu_order') as $value)
        {
            $arr8[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('type_ruledoc') as $value)
        {
            $arr9[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('free_link') as $value)
        {
            $arr10[$i] = $value;
            $i++;
        }

        for($i=0; $i<count($arr1); $i++)
        {
            $data = array();
            $data['menu_name'] = $arr6[$i];
            $data['menu_status'] = $arr2[$i];
            $data['parent_id'] = $arr3[$i];
            $data['order'] = $arr8[$i];
            $data['type_ruledoc'] = $arr9[$i];
            $data['free_link'] = $arr10[$i];
            
            if($arr5[$i] == 1) {
                $data['slug'] = Str::slug($arr6[$i], '-');
            }
            
            DB::table('menus')->where('id', $arr1[$i])->update($data);
        }
        
        $menu = new Menu;
        $parentId = $menu::where('editabled', '=', 1)->get();
        foreach($parentId as $item) {
            if(count($item->children)) {
                $dataSlug['slug'] = '';
                DB::table('menus')->where('id', $item->id)->update($dataSlug);
            }
        }

        return redirect()->route('admin.menu.index')->with('success', 'Menu is updated successfully!');
    }
}
