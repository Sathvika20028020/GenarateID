<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper d-flex align-items-center gap-2">
            <a href="index.html" class="d-flex align-items-center">
                <img class="img-fluid for-light" src="{{asset('/theme/images/small-white-logo.png') }}" alt="">
                <img class="img-fluid for-dark" src="{{asset('/theme/images/small-white-logo.png') }}" alt="">
            </a>
            <h5 class="mb-0 ms-1 fw-bold fs-6 ">Genarate ID - Admin</h5>
            <div class="back-btn ms-3">
                <i class="fa fa-angle-left"></i>
            </div>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid"
                                src="{{asset('/theme/images/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"> </i></div>
                    </li>


                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <span><i class="bi bi-speedometer2"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('genaratelist') ? 'active' : '' }}"
                            href="{{ route('genaratelist') }}">
                            <span><i class="bi bi-person-badge-fill"></i></span>
                            <span>Generate ID</span>
                        </a>
                    </li>


                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title d-flex flex-row gap-2" href="#">
                            <span><i class="bi bi-gear-fill"></i></span>
                            <span>Master</span>
                        </a>

                        <ul class="sidebar-submenu">

                            <li>
                                <a class="{{ request()->routeIs('departmentlist') ? 'active' : '' }}"
                                    href="{{ route('departmentlist') }}">
                                    <i class="bi bi-diagram-3-fill me-2"></i> Department
                                </a>
                            </li>
                            <li>
                               <a class="{{ request()->routeIs('departmentlist') ? 'active' : '' }}"
   href="{{ route('departmentlist') }}">
   <i class="bi bi-geo-alt-fill me-2"></i> Constituency
</a>
                            </li>

                            <li>
                                <a class="{{ request()->routeIs('corporationlist') ? 'active' : '' }}"
                                    href="{{ route('corporationlist') }}">
                                    <i class="bi bi-building me-2"></i> Corporation
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->routeIs('designationlist') ? 'active' : '' }}" href="{{ route('designationlist') }}">
                                    <i class="bi bi-person-workspace me-2"></i> Designation
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->routeIs('wardlist') ? 'active' : '' }}"
                                    href="{{ route('wardlist') }}">
                                    <i class="bi bi-map me-2"></i> Wards
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->routeIs('zonelist') ? 'active' : '' }}"
                                    href="{{ route('zonelist') }}">
                                    <i class="bi bi-globe2 me-2"></i> Zones
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->routeIs('userslist') ? 'active' : '' }}"
                                    href="{{ route('userslist') }}">
                                    <i class="bi bi-people-fill me-2"></i> Users
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>


<style>
.sidebar-list .sidebar-link.active {
    background: #ededed75 !important;
    color: #ffffff !important;
}

.sidebar-list .sidebar-link.active:hover {
    background: #ededed75 !important;
    color: #ffffff !important;
}

/* Make icon also black when active */
.sidebar-list .sidebar-link.active i,
.sidebar-list .sidebar-link.active span {
    color: #ffffff !important;
}


.sidebar-wrapper {
    /* width: 260px !important; */
    /* height: 100vh !important; */
    background: #354973 !important;
    position: fixed !important;
    left: 0 !important;
    top: 0 !important;

    transition: all 0.3s ease !important;
    color: #ffffff !important;
}

/* ============================= */
/* SIDEBAR LINKS */
/* ============================= */

.sidebar-links {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
    color: white !important;
}

.sidebar-link {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 12px 20px !important;
    text-decoration: none !important;
    color: white !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border-left: 4px solid transparent !important;
    transition: all 0.3s ease !important;
}



.sidebar-link svg path {
    stroke: #ededed75 !important;
    transition: all 0.3s ease !important;
}


.sidebar-link.active {
    background: #ededed75 !important;
    border-left: 4px solid #e6c22b !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}

.sidebar-link.active span {
    color: #ffffff !important;
}

.sidebar-link.active svg path {
    stroke: #ededed75 !important;
}


.sidebar-submenu {
    padding-left: 30px;
    background: transparent;
}

.sidebar-submenu li a {
    display: block;

    color: #b5c9b7 !important;
    text-decoration: none;
    transition: 0.3s;
}



.page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links li a span {
    color: #ffffff !important;
}

/* ============================= */
/* SIDEBAR HOVER EFFECT */
/* ============================= */

.sidebar-link:hover {
    background: #ededed75 !important;
    color: #ffffff !important;
    border-left: 4px solid #2563eb !important;
}

.sidebar-link:hover span {
    color: #ffffff !important;
}

.sidebar-link:hover svg path {
    stroke: #ffffff !important;
}
</style>