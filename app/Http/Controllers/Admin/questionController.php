<?php

namespace App\Http\Controllers\admin;

use App\Models\question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class questionController extends Controller
{
    //

    public function index(){
        $question=question::paginate(10);
        return view('admin.question.index')->with('question',$question);
    }


    public function create(){
        return view('admin.question.create');
    }


    public function store(Request $request){

        $validate=Validator::make($request->all(),[
            'title_en'=>'required|max:200|string',
            'title_ar'=>'required|max:200|string',
            'answer_en'=>'required',
            'answer_ar'=>'required',
            ]);
            if($validate->fails()){
                return response()->json(['message'=>$validate->errors()],401);
            }
            $question=question::create([
                'title_en'=>$request->title_en,
                'title_ar'=>$request->title_ar,
                'answer_en'=>$request->answer_en,
                'answer_ar'=>$request->answer_ar,
               
            ]);
            return response()->json(['message'=>__('trans_word.The question and answer has been successfully added')],200);
        
    }

    public function search(Request $request){
        $question=question::where('title_en','like','%'.$request->search.'%')->orwhere('title_ar','like','%'.$request->search.'%')->orwhere('answer_en','like','%'.$request->search.'%')->orwhere('answer_ar','like','%'.$request->search.'%')->paginate(10);
        return view('admin.question.search')->with('question',$question);
    }


}
