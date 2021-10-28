<?php

namespace App\Http\Controllers;
use App\Models\users;
use App\Models\tasks;
use Illuminate\Http\Request;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =  users::get();
     
        return view('users.index',['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.register',['data' => $data]);
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
      $data =  $this->validate($request,[
         "name"     => "required|min:3",
         "email"    => "required|email",
         "password" => "required|min:6|max:10",
       ]);

    # Hash Password 
    $data['password'] = bcrypt($data['password']);

    # Store Data ...  
      $op = users::create($data);

      if($op){
          $message = "Data Inserted";
      }else{
          $message = "Error Try Again!!";
      }

    # Set Message To Session .... 
    session()->flash('Message',$message);
    
    return redirect(url('/users'));

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
    {
        //
       
       # Fetch Admin Data ... 
       $userdata = users::where('id',$id)->get();

      return view('users.edit',['user' => $userdata]);

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
        $data =  $this->validate($request,[
            "name"     => "required|min:3",
            "email"    => "required|email"
          ]);


         $op =  users::where('id',$id)->update($data);

         if($op){
             $message = "Raw updated";
         }else{
             $message = "Error Try Again!!";
         }

         session()->flash('Message',$message);

         return redirect(url('/users'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $op = users::where('id',$id)->delete();

        if($op){
            $message = " Raw Removed";
        }else{
            $message = "Error Try Again !!!";
        }

        session()->flash('Message',$message);
       
        return back();
    }
    public function LoginView(){
        return view('users.login');
    }

    public function login(Request $request){

        // Logic ...... 
       $data = $this->validate($request,[

        "email" => "required|email",
        "password" => "required|min:6"
       ]);


       if(auth()->guard('member')->attempt($data)){

        return redirect(url('/users'));
       }else{

           return redirect(url('/users/Login'));
       }

    }
    public function logOut(){

        auth('member')->logout();

        return redirect(url('/Login'));
  }
    


}
