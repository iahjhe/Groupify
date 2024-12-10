<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style type="text/css">
.post_title{
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    padding: 30px;
}
</style>
  </head>
  <body>
   @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            {{session()->get('message')}}
        </div>
        @endif
        <h1 class="post_title">Add Post</h1>

        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <form action="{{url('add_post')}}" method="POST" enctype="multipart/form-data" class="w-50 bg-transparent p-4 rounded shadow">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Post Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Add Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
      @include('admin.footer')
  </body>
</html>