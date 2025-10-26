<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="{{asset('dashboard')}}">
          <img src="{{asset('backend/images/epress-logo.png')}}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{asset('dashboard')}}">
          <img src="{{asset('backend/images/favicon.png')}}" alt="logo" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top"> 
      
      <ul class="navbar-nav ms-auto">
       
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth()->user()->image)
            <img class="img-xs rounded-circle" src="{{asset('img/'.Auth()->user()->image)}}" alt="Profile image">
            @else
            <img class="img-xs rounded-circle" src="{{asset('backend/images/faces/face8.jpg')}}" alt="Profile image"> 
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img class="img-md rounded-circle" src="{{asset('img/'.Auth()->user()->image)}}" alt="Profile image" width="100px">
              <p class="mb-1 mt-3 font-weight-semibold">{{Auth()->user()->name}}</p>
              <p class="fw-light text-muted mb-0">{{Auth()->user()->email}}</p>
            </div>
            {{-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a> --}}
            
            <a class="dropdown-item" href="{{route('logout.perform')}}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>