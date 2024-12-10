<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Include Bootstrap CSS -->
      @include('home.homecss')

      <!-- SweetAlert2 CDN -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <body>
      <!-- Header Section -->
      <div class="header_section">
         @include('home.header')
      </div>

      <!-- Main Content -->
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="col-md-8">
               <h2 class="text-center mb-4">Create a New Tutorial</h2>
               <form action="{{ url('add_tutorial') }}" method="POST" enctype="multipart/form-data" id="tutorialForm">
                  @csrf <!-- CSRF token for security -->
                  <div class="form-group">
                     <label for="title">Tutorial Title</label>
                     <input type="text" name="title" id="title" class="form-control" placeholder="Enter tutorial title" required>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                     <textarea name="description" id="description" cols="30" rows="6" class="form-control" placeholder="Brief description of the tutorial" required></textarea>
                  </div>
                  <div class="form-group">
                     <label for="schedule">Schedule</label>
                     <input type="datetime-local" name="schedule" id="schedule" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="mode">Mode</label>
                     <select name="mode" id="mode" class="form-control" required>
                        <option value="" disabled selected>Select mode</option>
                        <option value="online">Online</option>
                        <option value="f2f">Face-to-Face</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="rate">Rate Per Hour (₱)</label>
                     <input type="number" name="rate" id="rate" class="form-control" placeholder="Enter rate per hour" min="1" step="any" required>
                  </div>
                  <div class="form-group">
                     <label for="students">Number of Students</label>
                     <input type="number" name="students" id="students" class="form-control" placeholder="Enter max number of students" min="1" required>
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
         document.getElementById("tutorialForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Show SweetAlert2 confirmation popup
            Swal.fire({
               title: 'Are you sure?',
               text: 'Do you want to create this tutorial?',
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Yes, create it!',
               cancelButtonText: 'Cancel'
            }).then((result) => {
               if (result.isConfirmed) {
                  Swal.fire('Tutorial created successfully.', '', 'success');
                  this.submit(); // Submit the form after confirmation
               } else {
                  Swal.fire('Tutorial creation canceled.', '', 'info');
               }
            });
         });
      </script>
   </body>
</html>
