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
         <div class="text-center mb-4">
            <h1>Available Groups</h1>
            <!-- Create Group Button -->
            <a href="{{ url('create_group') }}" class="btn btn-primary">Create Group</a>
         </div>

         <!-- Show Groups -->
         <div class="row">
            @forelse ($groups as $group)
            <div class="col-md-4">
               <div class="card mb-4 shadow-sm">
                  <div class="card-body">
                     <h4 class="card-title text-primary">{{ $group->name }}</h4>
                     <p class="card-text text-secondary">{{ Str::limit($group->description, 100) }}</p>
                     <p class="text-muted">
                        <strong>Created by:</strong> {{ $group->user->name }}
                     </p>
                     @if ($group->users->contains(auth()->user()->id))
                     <!-- Enter Group Button -->
                     <a href="{{ url('group/' . $group->id) }}" class="btn btn-primary">Enter Group</a>
                 @else
                     <!-- Join Group Form -->
                     <form action="{{ url('join_group/' . $group->id) }}" method="POST" class="">
                         @csrf
                         <button type="submit" class="btn btn-success">Join Group</button>
                     </form>
                 @endif
                  </div>
               </div>
            </div>
            @empty
            <div class="col-12">
               <p class="text-center text-muted">No groups available at the moment.</p>
            </div>
            @endforelse
         </div>

         <!-- Pagination -->
         <div class="d-flex justify-content-center mt-4">
            {{ $groups->links() }}
         </div>
      </div>

      <!-- Footer Section -->
      @include('home.footer')

      <!-- SweetAlert2 Script -->
      <script>
         // Listen for form submission for joining groups
         document.querySelectorAll('.join-group-form').forEach(form => {
            form.addEventListener('submit', function(event) {
               event.preventDefault(); // Prevent default form submission
               
               // Show SweetAlert2 confirmation popup
               Swal.fire({
                  title: 'Are you sure?',
                  text: 'Do you want to join this group?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, join!',
                  cancelButtonText: 'Cancel'
               }).then((result) => {
                  if (result.isConfirmed) {
                     Swal.fire('You joined the group!', '', 'success');
                     this.submit(); // Submit the form after confirmation
                  } else {
                     Swal.fire('You did not join the group.', '', 'info');
                  }
               });
            });
         });
      </script>
   </body>
</html>
