<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
  <div class="container-fluid">
    <nav
      class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
    >
      
    </nav>
    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">             
      <li class="nav-item topbar-user dropdown hidden-caret">
        <a
          class="dropdown-toggle profile-pic"
          data-bs-toggle="dropdown"
          href="#"
          aria-expanded="false"
        >
          <div class="avatar-sm">
            <img
              src="{{ asset('img/Pass_22.7kb.jpg') }}"
              alt="..."
              class="avatar-img rounded-circle"
            />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-user animated fadeIn">
          <div class="dropdown-user-scroll scrollbar-outer">
            <li>
              <div class="user-box">
                
                <div class="u-text">
                  <h4>{{ auth()->user()->fullname }}</h4>
                  <p class="text-muted">{{ auth()->user()->email }}</p>
                </div>
              </div>
            </li>
            <li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Account Setting</a>
              <div class="dropdown-divider"></div>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item text-danger">Logout</button>
              </form>
            </li>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>