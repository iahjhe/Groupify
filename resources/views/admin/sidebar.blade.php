<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="admincss/img/iahjhe.png" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5">Groupify</h1>
        <p>KCP Study and Tutor Finder</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li><a href="post_page"> <i class="icon-grid"></i>Add Post</a></li>
            <li><a href="{{('show_post')}}"> <i class="fa fa-bar-chart"></i>Show Post</a></li>
            <li><a href="{{('tutorial_page')}}"> <i class="icon-padnote"></i>Tutourial</a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Users</a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{'user_page'}}">Users</a></li>
                <li><a href="{{'create_user'}}">Create Users</a></li>
              </ul>
            </li>
            <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
    </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
      <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul>
  </nav>