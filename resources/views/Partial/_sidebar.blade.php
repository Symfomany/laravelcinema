    <!-- Start: Sidebar -->
    <aside id="sidebar_left" class="nano nano-light affix">

      <!-- Start: Sidebar Left Content -->
      <div class="sidebar-left-content nano-content">

        <!-- Start: Sidebar Header -->
        <header class="sidebar-header">

          <!-- Sidebar Widget - Author -->
          <div class="sidebar-widget author-widget">
            <div class="media">
              <a class="media-left" href="#">
                <img src="assets/img/avatars/3.jpg" class="img-responsive">
              </a>
              <div class="media-body">
                <div class="media-links">
                   <a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="{{ url('auth/logout') }}">Logout</a>
                </div>
                <div class="media-author">{{ Auth::user()->getFullname() }}</div>
              </div>
            </div>
          </div>

          <!-- Sidebar Widget - Menu (slidedown) -->
          <div class="sidebar-widget menu-widget">
            <div class="row text-center mbn">
              <div class="col-xs-4">
                <a href="{{ route('homepage') }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
                  <span class="glyphicon glyphicon-home"></span>
                </a>
              </div>
            </div>
          </div>

          <!-- Sidebar Widget - Search (hidden) -->
          <div class="sidebar-widget search-widget hidden">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-search"></i>
              </span>
              <input type="text" id="sidebar-search" class="form-control" placeholder="Rechercher...">
            </div>
          </div>

        </header>
        <!-- End: Sidebar Header -->

        <!-- Start: Sidebar Menu -->
        <ul class="nav sidebar-menu">
          <li class="sidebar-label pt20">Menu</li>
          <li @if(\Request::route()->getName() == "homepage") class="active" @endif>
            <a href="{{ route('homepage') }}">
              <span class="glyphicon glyphicon-home"></span>
              <span class="sidebar-title">Dashboard</span>
            </a>
          </li>
          <li @if(\Request::route()->getName() == "movies_index" ) class="active" @endif>
            <a href="{{ route('movies_index') }}">
              <span class="glyphicon glyphicon-film"></span>
              <span class="sidebar-title">Gestion des films</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicon glyphicon-list"></span>
              <span class="sidebar-title">Gestion des catégories</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicon glyphicon-user"></span>
              <span class="sidebar-title">Gestion des acteurs</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicon glyphicon-facetime-video"></span>
              <span class="sidebar-title">Gestion des réalisateurs</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicon glyphicon-comment"></span>
              <span class="sidebar-title">Gestion des commentaires</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicon glyphicon-globe"></span>
              <span class="sidebar-title">Gestion des cinémas</span>
            </a>
          </li>
          <li>
            <a href="">
              <span class="glyphicons glyphicon-transfer"></span>
              <span class="sidebar-title">Gestion des utilisateurs</span>
            </a>
          </li>
          </ul>
        <!-- End: Sidebar Menu -->

	      <!-- Start: Sidebar Collapse Button -->
	      <div class="sidebar-toggle-mini">
	        <a href="#">
	          <span class="fa fa-sign-out"></span>
	        </a>
	      </div>
	      <!-- End: Sidebar Collapse Button -->

      </div>
      <!-- End: Sidebar Left Content -->

    </aside>
    <!-- End: Sidebar Left -->