<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class sectionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['permission:categories_create'])->only('create');
        $this->middleware(['permission:categories_update'])->only('edit');
        $this->middleware(['permission:categories_delete'])->only('delete');
        $this->middleware(['permission:categories_read'])->only('index','search');
    }


    public function index(){
        $section=Section::all();
        return view('admin.section.index')->with('sections',$section);
    }

    public function create(){
        $category=Category::all();
        return view('admin.section.create')->with('category',$category);
    }

    public function store(Request $request){
        $validate=Validator::make($request->all(),[
        'name_en'=>'required|max:100|string|unique:sections',
        'name_ar'=>'required|max:100|string|unique:sections',
        'description_ar'=>'required|string',
        'description_en'=>'required|string',
        'category'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['message'=>$validate->errors()],401);
        }
        $section=Section::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'category_id'=>$request->category
        ]);
        return response()->json(['message'=>__('trans_word.success_add_section')],200);
    }

    public function edit($id){
        $section=Section::find($id);
        $category=Category::all();
        return view('admin.section.edit')->with('section',$section)->with('category',$category);
    }

    public function update(Request $request,$id){
        $validate=Validator::make($request->all(),[
        'name_en'=>'required|max:100|string',
        'name_ar'=>'required|max:100|string',
        'description_ar'=>'required|string',
        'description_en'=>'required|string',
        'category'=>'required',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
     
        $section=Section::find($id);
        $section->name_en=$request->name_en;
        $section->name_ar=$request->name_ar;
        $section->description_en=$request->description_en;
        $section->description_ar=$request->description_ar;
        $section->category_id=$request->category;
        $section->save();

        return redirect()->route('section.index')->with('success',__('trans_word.updatedsuccess'));
    }

    public function delete($id){
        $section=Section::find($id);
        $section->delete();
        return response()->json(['message'=>__('trans_word.deletesuccess')], 200);
    }

    public function search(Request $request){
        $section=Section::where('name_en','like','%'.$request->search.'%')->orwhere('name_ar','like','%'.$request->search.'%')->orwhere('description_en','like','%'.$request->search.'%')->orwhere('description_ar','like','%'.$request->search.'%')->paginate(10);
        return view('admin.section.searchSection')->with('sections',$section);
    }
    

}
