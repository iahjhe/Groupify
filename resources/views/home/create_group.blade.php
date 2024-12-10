<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Make sure Bootstrap CSS is included -->
      <base href="/public">
      @include('home.homecss')

      <!-- SweetAlert2 CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="col-md-6">
               <h2 class="text-center mb-4">Create a New Group</h2>
               <form action="{{ url('add_group') }}" method="POST" enctype="multipart/form-data" id="postForm">
                  @csrf <!-- CSRF token for security -->
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" name="name" id="title" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" cols="30" rows="10" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                     <label for="image">Image</label>
                     <input type="file" name="image" id="image" class="form-control-file" required>
                  </div>
                  <div class="text-center">
                     <input type="submit" value="Submit" class="btn btn-primary">
                  </div>
               </form>
            </div>
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')

      <!-- SweetAlert2 Script -->
      <script>
         // Listen for form submission
         document.getElementById("postForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Show SweetAlert2 confirmation popup
            Swal.fire({
               title: 'Are you sure?',
               text: 'Do you want to add this post?',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Yes, add it!',
               cancelButtonText: 'Cancel'
            }).then((result) => {
               if (result.isConfirmed) {
                  Swal.fire('Your group was added.');
                  this.submit(); // Submit the form after confirmation
               } else {
                  Swal.fire('Your group was not added.');
               }
            });
         });
      </script>
   </body>
</html>
