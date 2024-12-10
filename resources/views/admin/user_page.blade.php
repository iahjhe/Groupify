<!DOCTYPE html>
<html>
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
      .show_taital {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        padding: 30px;
      }
    </style>
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation -->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end -->

      <div class="page-content">
        <!-- Flash message for success -->
        @if(session()->has('message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
          {{ session()->get('message') }}
        </div>
        @endif

        <h1 class="show_taital">Manage Users</h1>

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>User Type</th>
                <th>User Status</th>
                <th>Profile Photo</th>
                <th>Delete</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->usertype }}</td>
                <td>{{ $user->userstatus }}</td>
                <td>
                  @if($user->profile_photo_path)
                  <img src="userprofile/{{ $user->profile_photo_path }}" 
                       alt="Profile Photo" class="img-thumbnail" style="width: 100px;">
                  @else
                  <p>No Photo</p>
                  @endif
                </td>
                <td>
                  <a href="{{ url('delete_user', $user->id) }}" 
                     class="btn btn-danger" 
                     onclick="confirmation(event)">
                    <i class="fa fa-trash"></i> Delete
                  </a>
                </td>
                <td>
                  <a href="{{ url('edit_user', $user->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      @include('admin.footer')
      <script type="text/javascript">
        function confirmation(ev) {
          ev.preventDefault();
          var urlToRedirect = ev.currentTarget.getAttribute('href'); 
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              window.location.href = urlToRedirect;
            } else {
              swal("The user is safe!");
            }
          });
        }
      </script>
    </div>
  </body>
</html>
