<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('created_at','ASC')->get();
        return view('back.categories.index',compact('categories'));
    }
    public function create(Request $request){
        $isExist=Category::where('slug',Str::slug($request->category))->first();
        if($isExist){
            toastr()->error($request->category.' is already in use');
            return redirect()->back();
        }
        $category = new Category;
        $category->name=$request->category;
        $category->slug=Str::slug($request->category);
        $category->save();
        toastr()->success('Successfull','Category '.$category->name.' has been added');
        return redirect()->back();


    }
    public function edit(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
    public function update(Request $request){
        $isExist=Category::where('name',Str::slug($request->category))->whereNotIn('id',[$request->id])->first();
        if($isExist){
            toastr()->error($request->category.' is already in use');
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name=$request->category;
        $category->slug=Str::slug($request->category);
        $category->save();
        toastr()->success('Successfull','Category has been updated');
        return redirect()->back();

    }
}
