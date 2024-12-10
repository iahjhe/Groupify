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


      <div class="container mt-5">

         <h1 class="text-center">Group: {{ $group->name }}</h1>
         @if(session('message'))
         <div class="alert alert-success">
             {{ session('message') }}
         </div>
     @endif
         <!-- Show Messages -->
         <div class="row mb-4">
            @foreach ($messages as $message)
            <div class="col-md-12 mb-3">
               <div class="card shadow-sm">
                  <div class="card-body">
                     <p><strong>{{ $message->user->name }}:</strong></p>
                     <p>{{ $message->message }}</p>
                     <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                  </div>
               </div>
            </div>
            @endforeach
         </div>

         <!-- Send Message Form -->
         <form action="{{ url('send_message/' . $group->id) }}" method="POST">
            @csrf
            <div class="form-group">
               <label for="message">Your Message:</label>
               <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Send Message</button>
         </form>

         <!-- Back to Group List -->
         <a href="{{ url('groups') }}" class="btn btn-secondary mt-4">Back to Groups</a>
      </div>

      <!-- Footer Section -->
      @include('home.footer')

   </body>
</html>
