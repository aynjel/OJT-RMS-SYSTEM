<?php
require_once('init.php');

$title = 'Dashboard';
$curr_page = basename(__FILE__);

?>

<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title d-inline-block">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        <span>
                            <?= $organization['organization_name']; ?>
                        </span>
                    </h1>

                    <a class="btn btn-white float-right" id="create_new" href="javascript:void(0);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon text-white-600 mr-2">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">
                            Create New
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                        aria-labelledby="create_new">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                data-target="#createTaskModal">
                                <span class="icon text-primary-600 mr-2">
                                    <i class="fas fa-tasks"></i>
                                </span>
                                <span class="text">
                                    Task
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                data-target="#createAnnouncementModal">
                                <span class="icon text-primary-600 mr-2">
                                    <i class="fas fa-bullhorn"></i>
                                </span>
                                <span class="text">
                                    Announcement
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <!--Card Primary-->
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                OJT Students
                            </p>
                            <p>
                                <?=count($enrollments); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="students.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                Coordinator
                            </p>
                            <p>
                                <?=count($coordinators); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="coordinators.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- create task modal -->
        <div class="modal fade" id="createTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="createTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="task_create.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTaskModalLabel">Create task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" value="<?=$user_id; ?>">
                            <input type="hidden" name="organization_id" value="<?=$organization['organization_id']; ?>">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="task_name">Name</label>
                                        <input type="text" class="form-control" id="task_name" name="task_name"
                                            placeholder="Enter task Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="task_deadline">Deadline (Optional) </label>
                                        <input type="date" class="form-control" id="task_deadline" name="task_deadline"
                                            placeholder="Enter task Deadline" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="task_description">Description</label>
                                        <textarea class="form-control" id="task_description" rows="3"
                                            name="task_description" placeholder="Enter task Description"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="create_task" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end create task modal -->


    </main>

    <?php require_once('components/footer.php'); ?>