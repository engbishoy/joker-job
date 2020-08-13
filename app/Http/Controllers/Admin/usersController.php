<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('delete');
        $this->middleware(['permission:users_read'])->only('index','search');
    }



    public function index()
    {
        //
        $user=User::paginate(10);
        return view('admin.users.index')->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'codephone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image'],
        ]);


        if(empty($request->photo)){
            $photoname='avatar5.png';
        }else{
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/site/img/users/',$photoname);
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code_phone'=>$request->codephone,
            'phone'=>$request->phone,
            'photo'=>$photoname,
            'email_verified_at'=>time()
        ]);

        return redirect()->route('users.index')->with('success',__('trans_word.The user has been successfully added'));

    }


    public function edit($id)
    {
        //
        $user=User::find($id);
        return view('admin.users.edit')->with('user',$user);
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
        $user=User::find($id);

        if($user->email!=$request->email){
            $uniqueEmail='unique:users';
        }else{
            $uniqueEmail='';
        }

        if($user->phone!=$request->phone){
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
        ]);

       $user->name=$request->name;
       $user->email=$request->email;
       $user->code_phone=$request->codephone;
       $user->phone=$request->phone;


        if(!empty($request->photo)){
        $photo=$request->photo;
        $photoname=time().'-'.$photo->getClientOriginalName();
        $photo->move(base_path().'/public/site/img/users/',$photoname);
        $user->photo=$photoname;
        }
 
        $user->save();


        return redirect()->route('users.index')->with('success',__('trans_word.updatedsuccess'));
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
        $user=User::find($id);
        $user->delete();
        return response()->json(['message'=>__('trans_word.deletesuccess')], 200);

    }


    public function search(Request $request)
    {
        $user=User::where('name','like','%'.$request->search.'%')->orwhere('email','like','%'.$request->search.'%')->orwhere('phone','like','%'.$request->search.'%')->paginate(10);
        return view('admin.users.search')->with('user',$user);
    }
}
