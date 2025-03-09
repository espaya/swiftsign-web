<aside class="sidebar-wrapper">
            <div class="sidebar sidebar-collapse" id="sidebar">
                <div class="sidebar__menu-group">
                    <ul class="sidebar_nav">
                        <li class="menu-title">
                            <span>Main menu</span>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <span data-feather="home" class="nav-icon"></span>
                                <span class="menu-text">Dashboard</span>
                                <span class="toggle-icon"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.employees') }}" class="{{ request()->routeIs('dashboard.employees') ? 'active' : '' }}">
                                <span data-feather="user" class="nav-icon"></span>
                                <span class="menu-text">Employees</span>
                                <span class="toggle-icon"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.attendance') }}" class="{{ request()->routeIs('dashboard.attendance') ? 'active' : '' }}">
                            <i class="fas fa-user-check nav-icon"></i>
                                <span class="menu-text">Attendance</span>
                                <span class="toggle-icon"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.qr.code') }}" class="{{ request()->routeIs('dashboard.qr.code') ? 'active' : '' }}">
                                <span data-feather="code" class="nav-icon"></span>
                                <span class="menu-text">QR Code</span>
                                <span class="toggle-icon"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>