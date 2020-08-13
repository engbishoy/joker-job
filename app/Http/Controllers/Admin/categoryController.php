<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware(['permission:categories_create'])->only('create');
        $this->middleware(['permission:categories_update'])->only('edit');
        $this->middleware(['permission:categories_delete'])->only('delete');
        $this->middleware(['permission:categories_read'])->only('index','search','sections');
    }

    public function index(){
        $category=Category::paginate(10);
        return view('admin.category.index')->with('category',$category);
    }

    public function sections($id){
        $category=Category::find($id);
        return view('admin.category.sections')->with('category',$category);
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validate=Validator::make($request->all(),[
        'name_en'=>'required|max:100|string|unique:categories',
        'name_ar'=>'required|max:100|string|unique:categories'
        ]);
        if($validate->fails()){
            return response()->json(['message'=>$validate->errors()],401);
        }
        $category=Category::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar
        ]);
        return response()->json(['message'=>__('trans_word.The Category was added successfully')],200);
    }

    public function edit($id){
        $category=Category::find($id);
        return view('admin.category.edit')->with('category',$category);
    }

    public function update(Request $request,$id){
        $validate=Validator::make($request->all(),[
        'name_en'=>'required|max:100|string|unique:categories',
        'name_ar'=>'required|max:100|string|unique:categories',
        ]);
     
        $category=Category::find($id);
        $category->name_en=$request->name_en;
        $category->name_ar=$request->name_ar;
        $category->save();

        return redirect()->route('category.index')->with('success',__('trans_word.updatedsuccess'));
    }


    public function delete($id){
        $category=Category::find($id);
        $category->delete();
        return response()->json(['message'=>__('trans_word.deletesuccess')], 200);
    }


    public function search(Request $request){
        $category=Category::where('name_en','like','%'.$request->search.'%')->orwhere('name_ar','like','%'.$request->search.'%')->paginate(10);
        return view('admin.category.searchCategory')->with('category',$category);
    }


}
