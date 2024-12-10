<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="/public">
      @include('home.homecss')
   </head>
   <body>
      <!-- Header Section -->
      <div class="header_section">
         @include('home.header')
         @if (session('message'))
         <div class="alert alert-success">
            {{ session('message') }}
         </div>
      @endif
      
      @if (session('error'))
         <div class="alert alert-danger">
            {{ session('error') }}
         </div>
      @endif
      </div>

      <!-- Main Content -->
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card shadow-lg border-0">
                  <div class="card-body p-4">
                     <!-- Title -->
                     <h3 class="card-title text-center text-primary mb-4">
                        <b>{{ $tutorial->title }}</b>
                     </h3>

                     <!-- Description -->
                     <p class="card-text text-justify text-secondary">
                        {{ $tutorial->description }}
                     </p>

                     <hr>

                     <!-- Details -->
                     <p class="card-text">
                        <strong>Schedule:</strong> 
                        {{ \Carbon\Carbon::parse($tutorial->schedule)->format('M d, Y - h:i A') }}
                     </p>
                     <p class="card-text">
                        <strong>Mode:</strong> 
                        {{ ucfirst($tutorial->mode) }}
                     </p>
                     <p class="card-text">
                        <strong>Rate Per Hour:</strong> 
                        ₱{{ number_format($tutorial->rate, 2) }}
                     </p>
                     <p class="card-text">
                        <strong>Number of Students:</strong> 
                        {{ $tutorial->students }}
                     </p>

                     <hr>

                     <!-- Poster Info -->
                     <p class="text-muted mb-1">
                        <strong>Posted by:</strong> 
                        <b>{{ $tutorial->user->name }}</b>
                     </p>
                     <p class="text-muted mb-4">
                        <strong>Posted on:</strong> 
                        <b>{{ $tutorial->created_at->format('F d, Y') }}</b>
                     </p>

                     <!-- Hire Tutor Button -->
                     <div class="text-center">
                        <a href="{{ url('/hire_tutor_form/'.$tutorial->id) }}" class="btn btn-success">
                           Hire Tutor
                        </a>
                     </div>
                     
                  </div>
               </div>
               <div class="mt-4 text-center">
                  <a href="{{ url('/tutors') }}" class="btn btn-secondary">Back to Tutorials</a>
               </div>
            </div>
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')
   </body>
</html>
