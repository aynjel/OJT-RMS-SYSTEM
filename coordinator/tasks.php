<?php
require_once('init.php');

$title = 'Tasks';
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
                        <div class="page-header-icon"><i data-feather="users"></i></div>
                        <span>
                            <?= $title; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-white mr-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#createTaskModal">
                            <i class="fas fa-plus mr-2"></i>
                            Create Task
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Tasks (<?= count($tasks); ?>)
                </div>
                <div class="card-body">
                    <?php if(count($tasks) > 0) : ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Deadline</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($tasks as $task) : ?>
                                <tr>
                                    <td><?= $task['task_name']; ?></td>
                                    <td><?= $task['task_description']; ?></td>
                                    <td><?= $task['task_deadline']; ?></td>
                                    <td><?= $get_coordinator->getCoordinator($task['user_id'])['first_name'] . ' ' . $get_coordinator->getCoordinator($task['user_id'])['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php if($task['task_status'] == 'Undecided') : ?>
                                        <span class="badge badge-warning"><?= $task['task_status']; ?></span>
                                        <?php elseif($task['task_status'] == 'Approved') : ?>
                                        <span class="badge badge-success"><?= $task['task_status']; ?></span>
                                        <?php elseif($task['task_status'] == 'Rejected') : ?>
                                        <span class="badge badge-danger"><?= $task['task_status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="task.php?task_id=<?= $task['task_id']; ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        No organization found.
                    </div>
                    <?php endif; ?>
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
                                        <input type="text" class="form-control" id="task_name"
                                            name="task_name" placeholder="Enter task Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="task_deadline">Deadline (Optional) </label>
                                        <input type="date" class="form-control" id="task_deadline"
                                            name="task_deadline" placeholder="Enter task Deadline" required>
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