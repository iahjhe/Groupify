

<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
   @include('admin.css')
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
        <form action="{{url('update_post/'.$post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Post</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Post Title</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Post Title" name="title" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Old Image</label>
                        <img src="{{ asset('postimage/'.$post->image) }}" height="100" width="100" alt="Old Image">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Post Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail3" name="image">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleTextarea1">Post Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description">{{$post->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      @include('admin.footer')
  </body>
</html>
{{-- {{$post->id}}
{{$post->title}} --}}
