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
            <div class="col-md-6">
               <div class="card shadow-lg border-0">
                  <div class="card-body p-4">
                     <h3 class="text-center text-primary mb-4">Hire Tutor</h3>
                     <form action="{{ url('/hire_tutor/'.$tutorial->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                           <label for="name">Your Name</label>
                           <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label for="year_level">Year Level</label>
                           <input type="text" name="year_level" id="year_level" class="form-control" required>
                        </div>
                        <div class="form-group">
                           <label for="payment">Downpayment</label>
                           <input type="number" name="payment" id="payment" class="form-control" min="1" required>
                        </div>
                        <div class="text-center">
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')
   </body>
</html>
