<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="/public">
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->

      <!-- Main Content -->
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="col-md-8">
               @if(session()->has('message'))
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                  {{ session()->get('message') }}
               </div>
               @endif

               <h1 class="text-center mb-4">Update Post</h1>
               <form action="{{ url('update_mypost/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="title" id="title" class="form-control" value="{{$data->title}}" required>
                  </div>

                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>{{$data->description}}</textarea>
                  </div>

                  <div class="form-group">
                     <label for="image">Current Image</label>
                     <div>
                        <img src="/postimage/{{$data->image}}" alt="Current Image" class="img-fluid" style="max-height: 200px; width: auto;">
                     </div>
                     <label for="image" class="mt-2">Change Image</label>
                     <input type="file" name="image" id="image" class="form-control-file">
                  </div>

                  <div class="form-group text-center">
                     <input type="submit" value="Update" class="btn btn-primary">
                  </div>
               </form>
            </div>
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')   
   </body>
</html>
