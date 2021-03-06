<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\carbon;
class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    function subcategory(){
        $categories = Category::all();
        $subcategory = Subcategory::all();
        return view('subcategory.index',compact('categories' , 'subcategory'));
    }
    function subcategory_post(Request $req){

        Subcategory::insert([
            'category_id' =>  $req->category_id,
            'subcategory_name' =>  $req->subcategory_name,
            'created_at' =>  Carbon::now()
        ]);
        return back();
    }
    function subcategory_get_data(Request $req){
        $str_to_send = "";
        foreach (Subcategory::where('category_id',$req->category_id)->select('id','subcategory_name')->get() as $subcategory) {
            $str_to_send = $str_to_send. "<option value='".$subcategory->id."'>$subcategory->subcategory_name</option>" ;
        }
        echo $str_to_send;
    }
    function subcategory_delete($subcategory_id){
        if(Subcategory::where('id',$subcategory_id)->exists()){ //for double click problem
        Subcategory::find($subcategory_id)->delete();
        }
        return back()->with('category_delete', 'Category Deleted Successfully');
    }
}