<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img src="<?php echo URL::to('assets\images\logo.svg'); ?> " alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="<?php echo URL::to('assets\images\logo-mini.svg'); ?>" alt="logo" /></a>
  </div>
  <ul class="nav">
    
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">Administrator</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <?php 
          // echo request()->segment(2);
          //  $active = '';
          //  if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
          //      $active = 'active';
          //  }
            // $active = '';
            // $getUrl = \Request::path();
            // $url = \Request::route()->getName();
            // echo $url;
            // if($getUrl === $url){
            //   $active = 'active';
            // }

          ?>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'roles')  ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'product_type')  ? 'active' : '' }}" href="{{ route('product_type.index') }}">Product Type</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'product')  ? 'active' : '' }}" href="{{ route('product.index') }}">Products</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'users')  ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'commands')  ? 'active' : '' }}" href="{{ route('commands.index') }}">Commands</a></li>
          <li class="nav-item"> <a class="nav-link {{ Request::segment(1) }} {{ (Request::segment(1) == 'permissions')  ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permissions</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>