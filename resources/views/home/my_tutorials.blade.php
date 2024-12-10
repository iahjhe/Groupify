<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Include your custom CSS file or the Bootstrap CSS -->
      <base href="/public">
      @include('home.homecss')
   </head>
   <body>
      <!-- Header Section -->
      <div class="header_section">
         @include('home.header')
         @if (session()->has('message'))
         <div class="alert alert-success">                   
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
             {{ session()->get('message') }}
         </div>
         @endif
      </div>

      <!-- Main Content Section -->
      <div class="container mt-5 pt-5">
         <div class="row justify-content-center">
            @foreach ($tutorials as $tutorial)
               <div class="col-md-8 col-lg-6">
                  <div class="card mb-4">
                    
                     <div class="card-body">
                        <h4 class="card-title">{{ $tutorial->title }}</h4>
                        <p class="card-text"><strong>Description:</strong> {{ $tutorial->description }}</p>
                        <p class="card-text"><strong>Schedule:</strong> {{ \Carbon\Carbon::parse($tutorial->schedule)->format('M d, Y - h:i A') }}</p>
                        <p class="card-text"><strong>Mode:</strong> {{ ucfirst($tutorial->mode) }}</p>
                        <p class="card-text"><strong>Rate Per Hour:</strong> ₱{{ number_format($tutorial->rate, 2) }}</p>
                        <p class="card-text"><strong>Number of Students:</strong> {{ $tutorial->students }}</p>
                        <a onclick="return confirm('Are you sure you want to delete this tutorial?')" href="{{ url('delete_tutorial/'.$tutorial->id) }}" class="btn btn-danger">
                           <i class="fa fa-trash"></i> Delete
                        </a>
                        <a href="{{ url('edit_tutorial/'.$tutorial->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')
   </body>
</html>
