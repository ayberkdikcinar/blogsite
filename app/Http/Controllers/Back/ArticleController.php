<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.insert',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:png,jpg,jpeg|max:300',
        ]);
        $article= new Article;
        $article->title=$request->title;
        $article->category_id=$request->categories;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imagename=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imagename);
            $article->image='uploads/'.$imagename;
        }
        $article->save();

        toastr()->success('Successfull','Success');

        return redirect()->route('admin.articles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $article=Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.edit',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:png,jpg,jpeg|max:300',
        ]);
        $article=Article::findOrFail($id);
        $article->title=$request->title;
        $article->category_id=$request->categories;
        $article->content=$request->content;
        $article->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imagename=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imagename);
            $article->image='uploads/'.$imagename;
        }
        $article->save();

        toastr()->success('Successfull','Update');

        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        Article::findOrFail($id)->delete();
        toastr()->success('Successfull','Article is now in trash');
        return redirect()->route('admin.articles.index');
    }
    public function trash(){
        $articles=Article::onlyTrashed()->orderBy('created_at','ASC')->get();
        return view('back.articles.trash',compact('articles'));

    }
    public function takeback($id){
        $article=Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Successfull','Article has taken back');
        return redirect()->back();
    }
    public function deleteFromTrash($id){
        $article=Article::onlyTrashed()->find($id);

        if(File::exists(public_path($article->image))){
            File::delete(public_path($article->image));
        }

        $article->forceDelete();
        toastr()->success('Successfull','Hard deleted');
        return redirect()->back();
    }
    public function destroy($id)
    {
       //
    }
}
