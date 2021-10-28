<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create || Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



      {{  session()->get('Message')  }}  





<div class="container">
  <h2>Craete Task</h2>
  <form  action="{{ url('/tasks')  }}"   method="post"   enctype ="multipart/form-data">

    @csrf

  <div class="form-group">
    <label for="exampleInputEmail1">title</label>
    <input type="text"  name="title"   value="{{ old('title') }}" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter title">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <input type="text"   name="description" value="{{ old('description') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Description">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Start_Date</label>
    <input type="date"   name = "start_date"  class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">End_Date</label>
    <input type="date"   name = "end_date"  class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input type="file"   name = "image"  class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">User</label>
    <select    name = "user_id"  class="form-control" >
    @foreach ($data as $val )
        <option value="{{ $val->id }}"> {{ $val->name }} </option>
    @endforeach
    </select>   
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>