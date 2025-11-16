 <nav class="sidebar dark_sidebar  ">
     <div class="logo d-flex justify-content-between">
         <a class="large_logo" href="index.html"><img src="{{asset('assets/img/logo.png') }}" alt></a>
         <a class="small_logo" href="index.html"><img src="{{asset('assets/img/mini_logo.png') }}" alt></a>
         <div class="sidebar_close_icon d-lg-none">
             <i class="ti-close"></i>
         </div>
     </div>
     <ul id="sidebar_menu">

         <h4 class="menu-text"><span>Menus</span> <i class="fas fa-ellipsis-h"></i> </h4>
         {{-- <li class>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <div class="nav_icon_small">
                        <img src="{{asset('img/menu-icon/5.svg')}}" alt>
                    </div>
                    <div class="nav_title">
                        <span>Application </span>
                    </div>
                </a>
                <ul>
                    <li><a href="editor.html">editor</a></li>
                    <li><a href="mail_box.html">Mail Box</a></li>
                    <li><a href="chat.html">Chat</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </li> --}}
         {{-- <h4 class="menu-text"><span>LAYOUT</span> <i class="fas fa-ellipsis-h"></i> </h4> --}}
         {{-- <li>
             <a href="{{route('jobs.index')}}" aria-expanded="false">
                 <div class="nav_icon_small">
                     <img src="{{asset('assets/img/menu-icon/2.svg') }}" alt>
                 </div>
                 <div class="nav_title">
                     <span>Job </span>
                 </div>
             </a>
         </li> --}}
         <li class="nav-item ">
             <a class="nav-link" href="{{route('dashboard') }}">
                 <i class="mdi mdi-grid-large menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
             </a>
         </li>
         {{-- @if (auth()->user()->can('customer')) --}}

             <li class="nav-item">
                 <a class="nav-link" href="{{route('customers.index') }}">
                     <i class="menu-icon mdi mdi-account-box-outline"></i>
                     <span class="menu-title">Clients</span>
                 </a>
             </li>
         {{-- @endif
         @if (auth()->user()->can('paper')) --}}
             <li class="nav-item">
                 <a class="nav-link" href="{{route('papers.index') }}">
                     <i class="menu-icon mdi mdi-animation"></i>
                     <span class="menu-title">Papers</span>
                 </a>
             </li>
         {{-- @endif
         @if (auth()->user()->can('quotation')) --}}
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('quotations.index') }}">
                     <i class="menu-icon mdi mdi-amplifier"></i>
                     <span class="menu-title">Quotation</span>
                 </a>
             </li>
         {{-- @endif
         @if (auth()->user()->can('job')) --}}
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('jobs.index') }}">
                     <i class="menu-icon mdi mdi-amplifier"></i>
                     <span class="menu-title">Jobs Creator</span>
                 </a>
             </li>
         {{-- @endif --}}
         {{-- @if (auth()->user()->can('machine')) --}}
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('equipments.index') }}">
                     <i class="menu-icon mdi mdi-printer-settings"></i>
                     <span class="menu-title">Equipment</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('default-estimate-particulars.index') }}">
                     <i class="menu-icon mdi mdi-printer-settings"></i>
                     <span class="menu-title">Default Estinamtes</span>
                 </a>
             </li>
         {{-- @endif
         @if (auth()->user()->can('users') || auth()->user()->can('role')) --}}
             <li class="nav-item">
                 <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                     aria-controls="ui-basic">
                     <i class="menu-icon  mdi mdi-account-key"></i>
                     <span class="menu-title">User Management</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         {{-- @if (auth()->user()->can('users')) --}}
                             <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                         {{-- @endif
                         @if (auth()->user()->can('role')) --}}
                             <li class="nav-item"> <a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                         {{-- @endif --}}
                     </ul>
                 </div>
             </li>
     </ul>
 </nav>
