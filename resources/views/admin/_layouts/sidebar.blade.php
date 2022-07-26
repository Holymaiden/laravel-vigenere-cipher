<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('admin') }}">Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('admin') }}">A</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li class="@stack('dashboard')">
                <a class="nav-link" href="{{ url('admin') }}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown @stack('candidates')">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>Candidates</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@stack('candidates')">
                        <a class="nav-link" href="{{ url('admin/candidates') }}">
                            Candidate
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown @stack('student-settings')">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>Students</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@stack('students')">
                        <a class="nav-link" href="{{ url('admin/students') }}">
                            Student
                        </a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="@stack('classs')">
                        <a class="nav-link" href="{{ url('admin/classs') }}">
                            Class
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown @stack('votes')">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>Vote</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@stack('votes')">
                        <a class="nav-link" href="{{ url('admin/votes') }}">
                            Vote
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown @stack('user-settings')">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>User Settings</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@stack('users')">
                        <a class="nav-link" href="{{ url('admin/users') }}">
                            Users
                        </a>
                    </li>
                </ul>
                <!-- <ul class="dropdown-menu">
                    <li class="@stack('roles')">
                        <a class="nav-link" href="{{ url('admin/roles') }}">
                            Roles
                        </a>
                    </li>
                </ul> -->
            </li>
            <li class="nav-item dropdown @stack('settings')">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-list-alt"></i>
                    <span>Settings</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@stack('settings')">
                        <a class="nav-link" href="{{ url('admin/settings') }}">
                            Setting
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

    </aside>
</div>
