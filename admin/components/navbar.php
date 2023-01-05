<nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand d-none d-sm-block" href="index.php">Admin Panel</a><button
        class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i
            data-feather="menu"></i></button>
    <ul class="navbar-nav align-items-center ml-auto">

        <!--User Registration + New Comment Notification-->
        <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="#"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="bell"></i>
                <span class="badge badge-red">2</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="mr-2" data-feather="bell"></i>
                    Notification
                </h6>

                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                    <div class="dropdown-notifications-item-content">

                        <div class="dropdown-notifications-item-content-details">
                            December 29, 2019
                        </div>
                        <div class="dropdown-notifications-item-content-text">
                            This is an alert message. It&apos;s nothing serious, but it requires your attention.
                        </div>
                    </div>
                </a>

                <a class="dropdown-item dropdown-notifications-item" href="#!">
                    <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                    <div class="dropdown-notifications-item-content">

                        <div class="dropdown-notifications-item-content-details">
                            December 29, 2019
                        </div>
                        <div class="dropdown-notifications-item-content-text">
                            This is an alert message. It&apos;s nothing serious, but it requires your attention.
                        </div>
                    </div>
                </a>

                <a class="dropdown-item dropdown-notifications-footer" href="#">
                    View All Alerts
                </a>
            </div>
        </li>
        <!--User Registration + New Comment Notification-->

        <li class="nav-item dropdown no-caret mr-3 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i data-feather="user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <div class="dropdown-user-details text-center mx-auto">
                        <div class="dropdown-user-details-name">
                            <?= $user['user_nickname'] ?>
                        </div>
                        <div class="dropdown-user-details-email">
                            <?= $user['user_email'] ?>
                        </div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="profile.php">
                    <div class="dropdown-item-icon">
                        <i data-feather="settings"></i>
                    </div>
                    Profile
                </a>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <div class="dropdown-item-icon">
                        <i data-feather="log-out"></i>
                    </div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>


<!--logout modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
