<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Contact;


class Homepage extends Controller
{
    public function index(){
        $data['categories']=Category::inRandomOrder()->get();
        $data['articles']=Article::orderBy('created_at','desc')->paginate(2);
        return view('front.homepage',$data);
    }
    public function single($categorySlug,$articleSlug){
        $category=Category::where('slug',$categorySlug)->first() ?? abort(403,'Aradağınız sayfa bulunamadı');
        $data['articles']=Article::where('slug',$articleSlug)->where('category_id',$category->id)->first() ?? abort(403,'Aradağınız sayfa bulunamadı');

        $data['categories']=Category::inRandomOrder()->get();
         return view('front.single',$data);

    }
    public function category($slug){
        $category=Category::where('slug',$slug)->first() ?? abort(403,'Aradağınız sayfa bulunamadı');
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->paginate(1);
        $data['categories']=Category::inRandomOrder()->get();
        return view('front.category',$data);
    }
    public function contact(){
        return view('front.contact');
    }
    public function about(){
        return view('front.about');
    }
    public function contactpost(Request $request){

        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'message'=>'required|min:10',
            'name'=>'required',
            'phone'=>'required|min:10|max:10'
        ]);

        if($validator->fails())
           return redirect()->route('contact')->withErrors($validator)->withInput();


            $contact = new Contact;
            $contact->name=$request->name;
            $contact->email=$request->email;
            $contact->phone=$request->phone;
            $contact->message=$request->message;
            $contact->created_at=now();
            $contact->updated_at=now();
            $contact->save();

        return redirect()->route('contact')->with('success','Message has sent. Thank you !');
    }
}
