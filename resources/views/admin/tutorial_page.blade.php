<!DOCTYPE html>
<html>
<head>
    <title>Tutorial Page</title>
    @include('admin.css')
</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation -->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end -->

        <div class="page-content">
            <h1 class="show_taital text-center">Tutorials</h1>

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{ session()->get('message') }}
            </div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                {{ session()->get('error') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Schedule</th>
                            <th>Mode</th>
                            <th>Rate</th>
                            <th>Students</th>
                            <th>Image</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tutorials as $tutorial)
                        <tr>
                            <td>{{ $tutorial->title }}</td>
                            <td>{{ $tutorial->description }}</td>
                            <td>{{ $tutorial->schedule }}</td>
                            <td>{{ ucfirst($tutorial->mode) }}</td>
                            <td>${{ $tutorial->rate }}</td>
                            <td>{{ $tutorial->students }}</td>
                            <td>
                                @if ($tutorial->image)
                                    <img src="/tutorial_images/{{ $tutorial->image }}" alt="Tutorial Image" class="img-thumbnail" style="width: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('delete_tutorial', $tutorial->id) }}" 
                                    class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this tutorial?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No tutorials found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>
