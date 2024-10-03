<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="{{route('admin.dashboard')}}" class="nav-link has-dropdown">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Objects</li>

            <li class="dropdown {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Category</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">All</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.categories.trash') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.categories.trash') }}">Trash</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Stisla</li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
