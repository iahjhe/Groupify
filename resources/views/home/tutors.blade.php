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
        <h1 class="text-center mb-4">Available Tutorials</h1>
        <div class="row">
           @forelse ($tutorials as $tutorial)
              <div class="col-md-4">
                 <div class="card mb-4">
                    <div class="card-body">
                       <h4 class="card-title">{{ $tutorial->title }}</h4>
                       <p class="card-text">{{ Str::limit($tutorial->description, 100) }}</p>
                       <a href="{{ url('tutorial_details/'.$tutorial->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                 </div>
              </div>
           @empty
              <div class="col-12">
                 <p class="text-center">No tutorials available at the moment.</p>
              </div>
           @endforelse
        </div>
        <!-- Pagination -->
        @if ($tutorials->hasPages())
           <div class="d-flex justify-content-center mt-4">
              {{ $tutorials->links() }}
           </div>
        @endif
     </div>
     
@if ($tutorials->isEmpty())
   <p class="text-center">No tutorials available at the moment.</p>
@endif

      <!-- Footer Section -->
      @include('home.footer')   
   </body>
</html>
