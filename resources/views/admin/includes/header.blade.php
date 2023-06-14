 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="/home" class="logo d-flex align-items-center">
             <img src="assets/img/logo.png" alt="">
             <span class="d-none d-lg-block">NiceAdmin</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->

     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">

             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                     data-bs-toggle="dropdown">
                     <img src="{{ asset('admin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                     <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                 </a><!-- End Profile Iamge Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                         <h6>{{ auth()->user()->name }}</h6>
                         <span>Web Designer</span>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="#">
                             <i class="bi bi-person"></i>
                             <span>My Profile</span>
                         </a>
                     </li>
                     <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('editPassword') }}">
                            <i class="bi bi-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center"
                             onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                             <i class="bi bi-box-arrow-right"></i>
                             <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                                 style="display: none;">
                                 {{ csrf_field() }}
                             </form>
                             <span>Sign Out</span>
                         </a>
                     </li>

                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
