<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <base href="/public">
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation -->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end -->

        <div class="page-content">
            <h1 class="show_taital text-center">Create New User</h1>

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{ session()->get('message') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="container">
                <form action="{{ url('add_user') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                    </div>

                    <div class="form-group">
                        <label for="usertype">User Type:</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="userstatus">User Status:</label>
                        <select class="form-control" id="userstatus" name="userstatus">
                            <option value="student" selected>Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="{{ url('user_page') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
