@if (Auth::user()->role->name == "Admin")
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ (Route::current()->getName() == 'dashboard') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ str_contains(Route::current()->getName(), 'surat') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="ti-email menu-icon"></i>
          <span class="menu-title">Surat</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('surat.masuk') }}">Surat Masuk</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('surat.keluar') }}">Surat Keluar</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ (str_contains(url()->current(), 'user')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('user') }}">
          <i class="ti-user menu-icon"></i>
          <span class="menu-title">Pengguna</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::current()->getName() == 'roles') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('roles') }}">
          <i class="ti-key menu-icon"></i>
          <span class="menu-title">Peran</span>
        </a>
      </li>
      <li class="nav-item {{ (Route::current()->getName() == 'divisi') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('divisi') }}">
          <i class="ti-briefcase menu-icon"></i>
          <span class="menu-title">Divisi</span>
        </a>
      </li>
    </ul>
  </nav>
@else
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ (Route::current()->getName() == 'dashboard') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{ (str_contains(url()->current(), 'users')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('user') }}">
          <i class="ti-user menu-icon"></i>
          <span class="menu-title">Pengguna</span>
        </a>
      </li>
    </ul>
  </nav>
@endif