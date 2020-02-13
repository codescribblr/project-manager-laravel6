<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-clock"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Project Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Clients -->
    <li class="nav-item">
        <a class="nav-link" href="{{ action('ClientController@index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Clients</span></a>
    </li>

    <!-- Nav Item - Projects -->
    <li class="nav-item">
        <a class="nav-link" href="{{ action('ProjectController@index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Projects</span></a>
    </li>

    <!-- Nav Item - Tasks -->
    <li class="nav-item">
        <a class="nav-link" href="{{ action('TaskController@index') }}">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Tasks</span></a>
    </li>

    <!-- Nav Item - Servers -->
    <li class="nav-item">
        <a class="nav-link" href="servers/list.html">
            <i class="fas fa-fw fa-server"></i>
            <span>Servers</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->