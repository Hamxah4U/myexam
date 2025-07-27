<div class="sidebar-wrapper scrollbar scrollbar-inner">
  <div class="sidebar-content">
    <ul class="nav nav-secondary">
      <li class="nav-item active">
        <a
          data-bs-toggle="collapse"
          href="#dashboard"
          class="collapsed"
          aria-expanded="false"
        >
          <i class="fas fa-home"></i>
          <p>Dashboard</p>
          {{-- <span class="caret"></span> --}}
        </a>
        <div class="collapse" id="dashboard">
          
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#base">
          <i class="fas fa-users"></i>
          <p>Student</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="base">
          <ul class="nav nav-collapse">
            <li>
              <a href="{{ route('add-student') }}">
                <span class="sub-item">Add student</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="sub-item">Manage student</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#sidebarLayouts">
          <i class="fas fa-book"></i>
          <p>Courses</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="sidebarLayouts">
          <ul class="nav nav-collapse">
           {{--  <li>
              <a href="/add-school">
                <span class="sub-item">Add school</span>
              </a>
            </li> --}}

            <li>
              <a href="{{ route('add-course') }}">
                <span class="sub-item">Add course</span>
              </a>
            </li>
            <li>
              <a href="{{ route('manage-course') }}">
                <span class="sub-item">Manage course</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#forms">
          <i class="fas fa-question-circle"></i>
          <p>Questions</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="forms">
          <ul class="nav nav-collapse">
            <li>
              <a href="{{ route('add-questions') }}">
                <span class="sub-item">Add question</span>
              </a>
            </li>
            <li>
              <a href="forms/forms.html">
                <span class="sub-item">Manage question</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#tables">
          <i class="fas fa-book-open"></i>
          <p>Exams</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav nav-collapse">
            <li>
              <a href="tables/tables.html">
                <span class="sub-item">Basic Table</span>
              </a>
            </li>
            <li>
              <a href="tables/datatables.html">
                <span class="sub-item">Datatables</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#maps">
          <i class="fas fa-map-marker-alt"></i>
          <p>Results</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="maps">
          <ul class="nav nav-collapse">
            <li>
              <a href="maps/googlemaps.html">
                <span class="sub-item">Google Maps</span>
              </a>
            </li>
            <li>
              <a href="maps/jsvectormap.html">
                <span class="sub-item">Jsvectormap</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#charts">
          <i class="far fa-chart-bar"></i>
          <p>Charts</p>
          <span class="caret"></span>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav nav-collapse">
            <li>
              <a href="charts/charts.html">
                <span class="sub-item">Chart Js</span>
              </a>
            </li>
            <li>
              <a href="charts/sparkline.html">
                <span class="sub-item">Sparkline</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</div>