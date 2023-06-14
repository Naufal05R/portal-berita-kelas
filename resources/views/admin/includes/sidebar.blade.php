<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>News</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('category.index') }}">
              <i class="bi bi-circle"></i><span>Category</span>
            </a>
          </li>

          <li>
            <a href="{{ route('news.index') }}">
              <i class="bi bi-circle"></i><span>News</span>
            </a>
          </li>

          <li>
            <a href="{{ route('slider.index') }}">
              <i class="bi bi-circle"></i><span>Slider</span>
            </a>
          </li>

        </ul>
      </li><!-- End Components Nav -->

      

    </ul>

  </aside><!-- End Sidebar-->