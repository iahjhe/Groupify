<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Include your custom CSS file or the Bootstrap CSS -->
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         @if (session()->has('message'))
         <div class="alert alert-success">                   
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
             {{session()->get('message')}}
         </div>
         @endif
        </div>
         <!-- banner section start -->
         
         
         <div class="container mt-5 pt-5">
            <div class="row justify-content-center">
               
               @foreach ($data as $data)
                  <div class="col-md-8 col-lg-6">
                     <div class="card mb-4">
                        <img src="{{url('/postimage/'.$data->image)}}" alt="Post Image" class="card-img-top" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                           <h4 class="card-title">{{$data->title}}</h4>
                           <p class="card-text">{{$data->description}}</p>
                           <a onclick="return confirm('Are you sure you want to delete this post?')" href="{{ url('delete_mypost/'.$data->id) }}" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                        <a href="{{ url('edit_mypost/'.$data->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <!-- banner section end -->
      

      <!-- footer section start -->
      @include('home.footer')
      <!-- footer section end -->
   </body>
</html>
