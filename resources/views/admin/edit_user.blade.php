<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
            <h1 class="show_taital text-center">Edit User</h1>

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{ session()->get('message') }}
            </div>
            @endif

            <div class="container">
                <form action="{{ url('update_user', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="usertype">User Type:</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="userstatus">User Status:</label>
                        <select class="form-control" id="userstatus" name="userstatus">
                            <option value="student" {{ $user->userstatus == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ $user->userstatus == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Password (Leave blank to keep current password):</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ url('user_page') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
