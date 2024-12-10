<!DOCTYPE html>
<html>
  <head> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
      .show_taital{
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
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            {{session()->get('message')}}
        </div>
        @endif
        
        <h1 class="show_taital">All Posts</h1>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Post Title</th>
                        <th>Description</th>
                        <th>Post by</th>
                        <th>Post Status</th>
                        <th>User Type</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Status Accept</th>
                        <th>Status Reject</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row -->
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->post_status}}</td>
                        <td>{{$post->usertype}}</td>
                        <td><img src="postimage/{{$post->image}}" alt="Post Image" class="img-thumbnail" style="width: 100px;"></td>
                        <td>
                            <a href="{{ url('delete_post', $post->id) }}" 
                                class="btn btn-danger" 
                                onclick="confirmation(event)">
                                 <i class="fa fa-trash"></i> Delete
                             </a>
                             
                        </td>
                        <td>
                            <a href="{{ url('edit_post', $post->id) }}" class="btn btn-success">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('accept_post', $post->id) }}" class="btn btn-primary">
                                <i class="fa fa-check"></i> Accept
                            </a>
                        </td>
                        <td>
                            <a onclick ="return confirm('Are you sure you want to reject this post?')" href="{{ url('reject_post', $post->id) }}" class="btn btn-danger">
                                <i class="fa fa-times"></i> Reject
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

      @include('admin.footer')
      <script type="text/javascript">
        function confirmation(ev) {
            console.log("confirmation called");
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href'); // use currentTarget because the click may be on nested children element
            console.log(urlToRedirect);
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }        
                else {
                    swal("Your file is safe!");
                }               
            });
        }
      </script>
  </body>
</html>