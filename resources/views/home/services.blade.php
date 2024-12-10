<!DOCTYPE html>
<html lang="en">
   <head>
      
      @include('home.homecss')
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')

      </div>
<div class="services-section py-5">
    <div class="container-fluid">
        <h1 class="text-center mb-4">Blog Posts</h1>
        <p class="text-center mb-5">
            Empowering students of King's College of the Philippines with personalized study and tutoring support tailored to your needs.
        </p>
        <div class="row g-4">
            @foreach($post as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="/postimage/{{$post->image}}" alt="Image for {{$post->title}}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">Post by <b>{{$post->name}}</b></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{url('post_details', $post->id)}}" class="btn btn-primary w-100">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

      @include('home.footer')   
   </body>
</html>


