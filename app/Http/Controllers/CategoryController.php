<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\category;
use DB;
class CategoryController extends Controller
{
    public function subcat($catid)
    {
        $sc=Subcategory::where('category_id','=',$catid,'and','status','=',1)->get();

        return view('subcategory',['subcate'=>$sc]);
    }
    public function subcatupdate(Request $request,$subcatid)
    {   
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
        Subcategory::where('subcategory_id',$subcatid)->update($request->all());
        if($request->cat_logo)
        {
        $image=(file_get_contents($_FILES['cat_logo']['tmp_name']));
        Subcategory::where('subcategory_id',$subcatid)->update(['cat_logo'=>$image]);
       
        }
        return redirect()->back();
    }

    public function addcat(Request $request,$categoryid)
    {   if($request->cat_logo){
        $image=(file_get_contents($_FILES['cat_logo']['tmp_name']));   
        }
        else
        $image=Null;
        DB::insert('insert into subcategories (subcategory_name,cat_logo,category_id) values (?,?,?)', [$request->subcategory_name,$image,$categoryid]);
        
        return redirect()->back();
    }

    public function deletesubcat($scatid)
    {
        Subcategory::where('subcategory_id',$scatid)->delete();
        return redirect()->back();
    }

    public function addmaincat(Request $request)
    {
        Category::create($request->all());
        return redirect()->back();   
    }
    public function deletecat($catid)
    {
        // DB::update('update categories set status = 0 where category_id = ?', [$catid]);
        DB::delete('delete from subcategories where category_id = ?', [$catid]);
        Category::where('category_id',$catid)->delete();

        return redirect()->back();   

    }
    public function admincatedit($catid,Request $request)
    {
        DB::table('categories')->where('category_id','=',$catid)->update(['category_name'=>$request->category_name]);
        return back();
    }
}
