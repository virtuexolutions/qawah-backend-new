<style>
  .nav-treeview{
    background-color: #000000 !important;
  }
  .card-outline{
    border-top: 3px solid #93652b !important;
  }
  .btn-sidebar, [class*=sidebar-dark] .form-control-sidebar{
    background-color:black !important;
  }
</style>
<!-- Sidebar Menu -->
      <nav class="mt-2" style="font-size: 14px;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('dashboard')}}" class="nav-link <?php if(Request::segment(2) == "dashboard"){ ?> active <?php } ?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            
          </li>

          {{--<li class="nav-item ">
            <a href="{{route('menus')}}" class="nav-link <?php if(Request::segment(2) == "menus"){ ?> active <?php } ?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Menus
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>--}}



          <li class="nav-header">Pages Section</li>
          <li class="nav-item <?php if(Request::segment(2) == "pages" ){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Pages
                <i class="fas fa-angle-left right"></i>
               <!--  <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('pages.index')}}" class="nav-link <?php if(Request::segment(2) == "pages"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ADD PAGE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sections.index')}}" class="nav-link <?php if(Request::segment(2) == "sections"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ADD Sections</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('faqs.index')}}" class="nav-link <?php if(Request::segment(2) == "faqs"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Faq's</p>
                </a>
              </li>
				
            </ul>
          </li> 

          <li class="nav-header">Packages Managment</li>
          <li class="nav-item<?php if(Request::segment(2) == "packages-catogeries" || Request::segment(2) == "package"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Packages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- <li class="nav-item">
                <a href="{{route('packages-catogeries')}}" class="nav-link <?php if(Request::segment(2) == "packages-catogeries" ){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages Catogery list</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="{{route('packages.index')}}" class="nav-link <?php if(Request::segment(2) == "packages" || Request::segment(2) == "add-package" || Request::segment(2) == "package"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages list</p>
                </a>
             {{-- </li>
				<li class="nav-item">
                <a href="{{route('promotions.index')}}" class="nav-link <?php if(Request::segment(2) == "promotions" ){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion Packages list</p>
                </a>
              </li>--}}
            </ul>
          </li>
          <li class="nav-item <?php if(Request::segment(2) == "promos"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Promo Codes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('promos.index')}}" class="nav-link <?php if(Request::segment(2) == "promos"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promo Code list</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item <?php if(Request::segment(2) == "subscription" || Request::segment(2) == "subscription"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Subscription
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('subscription')}}" class="nav-link <?php if(Request::segment(2) == "subscription"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subscription list</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-header">Event Section</li>
          <li class="nav-item<?php if(Request::segment(2) == "events"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Manage Events
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('events_list')}}" class="nav-link <?php if(Request::segment(2) == "events" || Request::segment(2) == "add-package"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Events list</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-header">Users Management</li>
          <li class="nav-item <?php if(Request::segment(2) == "users" || Request::segment(2) == "user"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link <?php if(Request::segment(2) == "users"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users list</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item <?php if(Request::segment(2) == "verification" ){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Verification Request
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('verification')}}" class="nav-link <?php if(Request::segment(2) == "verification"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Verification List</p>
                </a>
              </li>
              
            </ul>
          </li>
         

          {{-- <li class="nav-header">Subscription Section</li>
        --}}
          <li class="nav-header">Reports</li>
          <li class="nav-item <?php if(Request::segment(2) == "userspackages" || Request::segment(2) == "userspackages"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Packages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('userspackages')}}" class="nav-link <?php if(Request::segment(2) == "userspackages"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Packages list</p>
                </a>
              </li>
              
            </ul>
          </li>
       
       {{-- <li class="nav-header">Promo Code Section</li>
          <li class="nav-item <?php if(Request::segment(2) == "promos"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Promo Code
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('promos.index')}}" class="nav-link <?php if(Request::segment(2) == "promos"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promo Code list</p>
                </a>
              </li>
              
            </ul>
          </li> --}}
          {{-- <li class="nav-header">User Verification</li> --}}
            {{-- <li class="nav-header">Role Section</li> --}}
               <li class="nav-header">Manage employee Section</li>
       <li class="nav-item <?php if(Request::segment(2) == "managers" || Request::segment(2) == "managers"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Employee Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('managers.index')}}" class="nav-link <?php if(Request::segment(2) == "managers"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee List</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item <?php if(Request::segment(2) == "roles" || Request::segment(2) == "roles"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Role Managment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link <?php if(Request::segment(2) == "roles"){ ?> active <?php } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role List</p>
                </a>
              </li>
              
            </ul>
          </li>

          

          <li class="nav-item <?php if(Request::segment(2) == "change_password" || Request::segment(2) == "change_password"){ ?> menu-is-opening menu-open <?php } ?>">
            <a href="{{route('change_password')}}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>Change Password
              </p>
            </a>
            
          </li>
            </ul>
          </li>


        



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>