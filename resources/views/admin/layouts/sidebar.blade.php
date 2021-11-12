<aside class="main-sidebar sidebar-light-danger elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin::dashboard')}}" class="brand-link">
        <img src="{{asset('images/logo.png')}}" alt="Sabka Mandi Logo" class="brand-image img-circle elevation-2">
        <span class="brand-text font-weight-light">CEGA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin::dashboard')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin::categories')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::categories') active @endif">
                        <i class="nav-icon fa fa-layer-group"></i>
                        <p>
                            Nominee Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin::nominees')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::nominees') active @endif">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Nominees
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin::voters')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::voters') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Voters
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin::votes')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::votes') active @endif">
                        <i class="nav-icon fas fa-vote-yea"></i>
                        <p>
                            Votes
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin::importers')}}"
                       class="nav-link @if(\Request::route()->getName() == 'admin::importers') active @endif">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Import Data
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
