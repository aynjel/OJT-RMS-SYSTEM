<!--Side Nav-->
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <?php if($curr_page == 'index.php' || $curr_page == 'organization.php') : ?>
                    <a class="nav-link collapsed pt-4 active" href="index.php">
                        <div class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </div>
                        Dashboard
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed pt-4" href="index.php">
                        <div class="nav-link-icon">
                            <i data-feather="activity"></i>
                        </div>
                        Dashboard
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'coordinators.php' || $curr_page == 'coordinator.php') : ?>
                    <a class="nav-link collapsed active" href="coordinators.php">
                        <div class="nav-link-icon">
                            <i data-feather="user-check"></i>
                        </div>
                        Coordinator
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="coordinators.php">
                        <div class="nav-link-icon">
                            <i data-feather="user-check"></i>
                        </div>
                        Coordinator
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'students.php' || $curr_page == 'student.php') : ?>
                    <a class="nav-link collapsed active" href="students.php">
                        <div class="nav-link-icon">
                            <i data-feather="users"></i>
                        </div>
                        Students
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="students.php">
                        <div class="nav-link-icon">
                            <i data-feather="users"></i>
                        </div>
                        Students
                    </a>
                    <?php endif; ?>

                    <?php if($curr_page == 'courses.php' || $curr_page == 'course.php') : ?>
                    <a class="nav-link collapsed active" href="courses.php">
                        <div class="nav-link-icon">
                            <i data-feather="book"></i>
                        </div>
                        Courses
                    </a>
                    <?php else : ?>
                    <a class="nav-link collapsed" href="courses.php">
                        <div class="nav-link-icon">
                            <i data-feather="book"></i>
                        </div>
                        Courses
                    </a>
                    <?php endif; ?>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                        data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="nav-link-icon"><i data-feather="layout"></i></div>
                        Posts
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                            <a class="nav-link" href="all-post.html">All Posts</a>
                            <a class="nav-link" href="add-new.html">Add New Post</a>
                        </nav>
                    </div>

                    <a class="nav-link" href="users.html">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Users
                    </a>

                    <a class="nav-link" href="comments.html">
                        <div class="nav-link-icon"><i data-feather="package"></i></div>
                        Comments
                    </a>

                    <a class="nav-link" href="messages.html">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                    </a>

                    <a class="nav-link" href="profile.html">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        Profile
                    </a>
                </div>
            </div>

            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title">
                        <?= $user['user_nickname']; ?>
                    </div>
                </div>
            </div>

        </nav>
    </div>