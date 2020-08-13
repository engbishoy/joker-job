<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware(['permission:admins_create'])->only('create');
        $this->middleware(['permission:admins_update'])->only('edit');
        $this->middleware(['permission:admins_delete'])->only('delete');
        $this->middleware(['permission:admins_read'])->only('index','search');
    }

    public function index(){
        $admin=Admin::where('id','!=',auth()->user()->id)->whereRoleIs('admin')->paginate(10);
        return view('admin.admins.index')->with('admin',$admin);
    }

    public function create(){
        return view('admin.admins.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'phone' => ['required', 'numeric', 'unique:admins'],
            'codephone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image'],
            'permission'=>['required']
        ]);


        if(empty($request->photo)){
            $photoname='avatar5.png';
        }else{
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/admin/dist/img/admins/',$photoname);
        }
        
      $admin=Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code_phone'=>$request->codephone,
            'phone'=>$request->phone,
            'photo'=>$photoname
        ]);

        $admin->attachRole('admin');

        $admin->syncPermissions($request->permission);

        return redirect()->route('admin.index')->with('success',__('trans_word.The admin has been successfully added'));
    }


    public function edit($id){
        $admin=Admin::find($id);
        if($admin){
        return view('admin.admins.edit')->with('admin',$admin);
        }else{
            return redirect()->back();
        }

    }


    public function update(Request $request,$id){

        $admin=Admin::find($id);

        if($admin->email!=$request->email){
            $uniqueEmail='unique:users';
        }else{
            $uniqueEmail='';
        }

        if($admin->phone!=$request->phone){
            $uniquePhone='unique:users';
        }else{
            $uniquePhone='';
        }

        $request->validate([
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255',$uniqueEmail],
            'phone' => ['required', 'numeric',$uniquePhone],
            'codephone' => ['required'],
            'photo' => ['nullable', 'image'],
            'permission'=>['required']
        ]);



        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->code_phone=$request->codephone;
        $admin->phone=$request->phone;


        if(!empty($request->photo)){
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/admin/dist/img/admins/',$photoname);
        $admin->photo=$photoname;
        }
 
        $admin->save();

        $admin->syncPermissions($request->permission);

        return redirect()->route('admin.index')->with('success',__('trans_word.updatedsuccess'));
    }



    public function delete($id){
        $admin=Admin::find($id);
        $admin->delete();
        return response()->json(['message'=>__('trans_word.The admin was successfully deleted')], 200);

    }



    public function search(Request $request){
        $admin=Admin::where('name','like','%'.$request->search.'%')->orwhere('email','like','%'.$request->search.'%')->orwhere('phone','like','%'.$request->search.'%')->whereRoleIs('admin')->paginate(10);
        return view('admin.admins.search')->with('admin',$admin);
    }



    // edit profile
    public function editProfile(){
        $admin=Admin::find(auth()->user()->id);
        if($admin){
        return view('admin.profile.edit')->with('admin',$admin);
        }else{
            return redirect()->back();
        }

    }



    public function updateProfile(Request $request){
        
        $admin=Admin::find(auth()->user()->id);

        if($admin->email!=$request->email){
            $uniqueEmail='unique:users';
        }else{
            $uniqueEmail='';
        }

        if($admin->phone!=$request->phone){
            $uniquePhone='unique:users';
        }else{
            $uniquePhone='';
        }

        $request->validate([
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255',$uniqueEmail],
            'codephone' => ['required'],
            'phone' => ['required', 'numeric',$uniquePhone],
            'photo' => ['nullable', 'image'],
        ]);



        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->code_phone=$request->codpehone;
        $admin->phone=$request->phone;


        if(!empty($request->photo)){
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/admin/dist/img/admins/',$photoname);
        $admin->photo=$photoname;
        }
 
        $admin->save();

        return redirect()->back()->with('success',__('trans_word.updatedsuccess'));


    }

}
