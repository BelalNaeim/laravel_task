<?php

namespace App\Http\Controllers;
use App\Models\users;
use App\Models\tasks;
use Illuminate\Http\Request;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data  = tasks::select('tasks.*','users.name')->join('users','users.id','=','tasks.user_id')->get();
     
        return view('tasks.index',['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # Select Roles .... 
       $data = users::get();

       return view('tasks.create',['data' => $data]);
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
         "title"     => "required|min:10",
         "description"    => "required|min:20",
         "start_date" => "required|date",
         "end_date"  => "required|date",
         "image"  => "required|max:10000|mimes:jpg,png",
         "user_id"  => "required|integer"
       ]);

    $imageName = time().'.'.$request->image->extension();  
     
    $request->image->move(public_path('images'), $imageName);


    # edit image name
    $data['image'] = $imageName;

    # Store Data ...  
      $op = tasks::create($data);

      if($op){
          $message = "Data Inserted";
      }else{
          $message = "Error Try Again!!";
      }

    # Set Message To Session .... 
    session()->flash('Message',$message);
    
    return redirect(url('/tasks'));

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
       # Select Roles .... 
       
       # Fetch Admin Data ... 
       $taskData = tasks::where('id',$id)->get();

      return view('tasks.edit',['task' => $taskData]);

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
                "title"     => "required|min:10",
                "description"    => "required|min:20",
                "start_date" => "required|date",
                "end_date"  => "required|date",
                "image"  => "required|max:10000|mimes:jpg,png"
              ]);
       
            $imageName = time().'.'.$request->image->extension();  
            
           $request->image->move(public_path('images'), $imageName);
       
           if($request->image != ''){        
               $path = public_path('images').$imageName;
       
               //code for remove old file
               if($request->image != ''  && $request->image != null){
                    $image_old = 'http://localhost/todoList/public/images'.$imageName;
                    unlink($image_old);
               }
       
               //upload new file
               $file = $request->image;
               $filename = $file->getClientOriginalName();
               $file->move($path, $filename);
       
          }
       
       
           # edit image name
           $data['image'] = $filename;
    
             $op =  tasks::where('id',$id)->update($data);
    
             if($op){
                 $message = "Raw updated";
             }else{
                 $message = "Error Try Again!!";
             }
    
             session()->flash('Message',$message);
    
             return redirect(url('/tasks'));
    
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

        $op = tasks::where('id',$id)->delete();

        if($op){
            $message = " Raw Removed";
        }else{
            $message = "Error Try Again !!!";
        }

        session()->flash('Message',$message);
       
        return back();
    }
}
