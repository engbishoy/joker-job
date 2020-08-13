<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\businessExhibition;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;

class businessExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $work=businessExhibition::orderBy('created_at','desc')->paginate(12);
        return view('site.businessExhibitions.index')->with('work',$work);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myworks()
    {
        //
        $user=User::find(auth()->user()->id);
        return view('site.businessExhibitions.myworks')->with('user',$user);
    }

     
    public function create()
    {
        //
        $category=Category::all();
        return view('site.businessExhibitions.create')->with('category',$category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // store businessExhibition 
    public function store(Request $request){
        $request->validate([
            'title'=>'max:200|required',
            'description'=>'required|max:1000',
            'category'=>'required',
            'section'=>'required',
            'photos.*'=>'required|image|max:2000',
            'photos'=>'required',
            'skills'=>'required|max:200',
            'link'=>'nullable|max:200'
        ]);
        $businessExhibition=new businessExhibition();
        $businessExhibition->title=$request->title;
        $businessExhibition->description=$request->description;
        $businessExhibition->skills=$request->skills;
        $businessExhibition->category_id=$request->category;
        $businessExhibition->section_id=$request->section;
        $businessExhibition->user_id=auth()->user()->id;
        $businessExhibition->link_work=$request->link;
        

        $photo=$request->photos;
        if($photo){

        if(count($photo)<=4){
        foreach($photo as $photos){
        $photoname=time().'-'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/site/img/servicework/',$photoname);
        $multiphoto[]=$photoname;
        }
        $images=implode(',',$multiphoto);
        $businessExhibition->photos=$images;
    
        }else{
            return redirect()->back()->withErrors(__('trans_word.Only 4 images are allowed'));
        }

        }
        

        $businessExhibition->save();

        return redirect()->back()->with('success',__('trans_word.Your work has been added successfully'));

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
        $work=businessExhibition::find($id);
        if($work){
        return view('site.businessExhibitions.show')->with('work',$work);
        }else{
            return redirect()->back();
        }
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $businessExhibition=businessExhibition::find($id);
        $category=Category::all();
        return view('site.businessExhibitions.edit')->with('businessExhibition',$businessExhibition)->with('category',$category);
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
        //
        $request->validate([
            'title'=>'max:200|required',
            'description'=>'required|max:1000',
            'category'=>'required',
            'section'=>'required',
            'photos.*'=>'image|max:2000',
            'photos'=>'nullable',
            'skills'=>'required',
            'link'=>'nullable|max:200'
        ]);
        $businessExhibition=businessExhibition::find($id);
        $businessExhibition->title=$request->title;
        $businessExhibition->description=$request->description;
        $businessExhibition->skills=$request->skills;
        $businessExhibition->category_id=$request->category;
        $businessExhibition->section_id=$request->section;
        $businessExhibition->user_id=auth()->user()->id;
        $businessExhibition->link_work=$request->link;
        

        $photo=$request->photos;
        if($photo){

        if(count($photo)<=4){
        foreach($photo as $photos){
        $photoname=time().'-'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/site/img/servicework/',$photoname);
        $multiphoto[]=$photoname;
        }
        $images=implode(',',$multiphoto);
        $businessExhibition->photos=$images;
    
        }else{
            return redirect()->back()->withErrors(__('trans_word.Only 4 images are allowed'));
        }

        }
        

        $businessExhibition->save();

        return redirect()->back()->with('success',__('trans_word.Your work has been updated successfully'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $businessExhibition=businessExhibition::find($id);
        $businessExhibition->delete();
        return response()->json(['message'=>__('trans_word.Your work has been successfully deleted')]);
    }
}
