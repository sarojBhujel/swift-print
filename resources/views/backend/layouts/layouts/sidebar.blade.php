<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item ">
        <a class="nav-link" href="{{asset('dashboard')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @if(auth()->user()->can('customer') )
        
      <li class="nav-item">
        <a class="nav-link" href="{{route('customers.index')}}">
          <i class="menu-icon mdi mdi-account-box-outline"></i>
          <span class="menu-title">Cliensdfts</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('paper'))
      <li class="nav-item">
        <a class="nav-link" href="{{asset('papers')}}">
          <i class="menu-icon mdi mdi-animation"></i>
          <span class="menu-title">Papers</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('quotation'))
      <li class="nav-item">
        <a class="nav-link" href="{{route('quotations.index')}}">
          <i class="menu-icon mdi mdi-amplifier"></i>
          <span class="menu-title">Quotation</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('job'))
      <li class="nav-item">
        <a class="nav-link" href="{{route('jobs.index')}}">
          <i class="menu-icon mdi mdi-amplifier"></i>
          <span class="menu-title">Jobs Creator</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('machine'))
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipments.index')}}">
          <i class="menu-icon mdi mdi-printer-settings"></i>
          <span class="menu-title">Equipment</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->can('users')||auth()->user()->can('role'))
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon  mdi mdi-account-key"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i> 
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            @if(auth()->user()->can('users'))
                      <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Users</a></li>
            @endif
            @if(auth()->user()->can('role'))
                      <li class="nav-item"> <a class="nav-link" href="{{route('roles.index')}}">Roles</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif
      {{-- <li class="nav-item nav-category">UI Elements</li> --}}
          @if(auth()->user()->can('signature'))
          <li class="nav-item">
            <a class="nav-link" href="{{route('signatures.index')}}">
              <i class="menu-icon mdi mdi-clipboard-alert-outline"></i>
              <span class="menu-title">Signatures</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('chalan'))
          <li class="nav-item">
            <a class="nav-link" href="{{route('chalans.index')}}">
              <i class="menu-icon mdi mdi-clipboard-alert-outline"></i>
              <span class="menu-title">Chalan</span>
            </a>
          </li>
          @endif
      
    </ul>
  </nav>