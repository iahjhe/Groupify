<div class="header_main">
    <div class="mobile_menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo_mobile">
                <a href="index.html">
                    <img src="images/Untitled design.png" alt="Logo">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('services') }}">Blog</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            @php
                                $userRole = Auth::user()->userstatus; // Assuming 'userstatus' stores 'student' or 'instructor'
                            @endphp
                            <!-- Common Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('my_post') }}">My Post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('create_post') }}">Create Post</a>
                            </li>
                            <li class="nav-item">
                                <x-app-layout></x-app-layout>
                            </li>
                            @if ($userRole === 'student')
                                <!-- Student-Specific Links -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('tutors') }}">Browse Tutors</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('group') }}">Group</a>
                                </li>
                            @elseif ($userRole === 'instructor')
                                <!-- Instructor-Specific Links -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="tutorialDropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        Tutorials
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="tutorialDropdown">
                                        <a class="dropdown-item" href="{{ url('create_tutorial') }}">Create Tutorials</a>
                                        <a class="dropdown-item" href="{{ url('my_tutorials') }}">My Tutorials</a>
                                    </div>
                                </li>
                            @endif
                        @else
                            <!-- Guest Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid" style="position: relative; z-index: 10;">
        <div class="logo">
            <a href="index.html">
                <img src="images/Untitled design.png" alt="Logo">
            </a>
        </div>
        <div class="menu_main">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('services') }}">Blogs</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('my_post') }}">My Post</a></li>
                        <li><a href="{{ url('create_post') }}">Create Post</a></li>
                        <li>
                            <x-app-layout></x-app-layout>
                        </li>
                        @if ($userRole === 'student')
                            <li><a href="{{ url('tutors') }}">Browse Tutors</a></li>
                            <li><a href="{{ url('group') }}">Group</a></li>
                        @elseif ($userRole === 'instructor')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Tutorials
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('create_tutorial') }}">Create Tutorials</a></li>
                                    <li><a href="{{ url('my_tutorials') }}">My Tutorials</a></li>
                                </ul>
                            </li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</div>
