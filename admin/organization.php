<?php
require_once('init.php');

if(!isset($_GET['organization_id']) || empty($_GET['organization_id']) || !is_numeric($_GET['organization_id'])){
    header('Location: index.php');
}

$organization_id = $_GET['organization_id'];
$organization = $get_organization->getOrganization($organization_id);

$title = 'Organization Details';
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
                        <span>
                            <?= $organization['organization_name']; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="index.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-danger btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deleteOrganizationModal">
                            <span class="icon text-white-600">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editOrganizationModal">
                            <span class="icon text-gray-600">
                                <i class="fas fa-edit"></i>
                            </span>
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
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="students-tab" data-toggle="tab" data-target="#students"
                                href="#students" role="tab" aria-controls="students" aria-selected="false">OJT
                                Students</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="coordinators-tab" data-toggle="tab" data-target="#coordinators"
                                href="#coordinators" role="tab" aria-controls="coordinators"
                                aria-selected="false">Coordinators</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="organization-tab" data-toggle="tab" data-target="#organization"
                                href="#organization" role="tab" aria-controls="organization" aria-selected="true">
                                Details
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="graduates-tab" data-toggle="tab" data-target="#graduates"
                                href="#graduates" role="tab" aria-controls="graduates" aria-selected="false">
                                Graduated
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <!-- Organization Details -->
                        <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                            <div class="card border-0 bg-transparent shadow-none">
                                <div class="card-header">
                                    <span class="d-inline-block">
                                        Organization Details
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_name">Name</label>
                                                <input type="text" class="form-control" id="organization_name"
                                                    name="organization_name"
                                                    value="<?= $organization['organization_name']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_email">Email</label>
                                                <input type="text" class="form-control" id="organization_email"
                                                    name="organization_email"
                                                    value="<?= $organization['organization_email']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_contact_number">Contact Number</label>
                                                <input type="text" class="form-control" id="organization_contact_number"
                                                    name="organization_contact_number"
                                                    value="<?= $organization['organization_contact_number']; ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_address">Address</label>
                                                <input type="text" class="form-control" id="organization_address"
                                                    name="organization_address"
                                                    value="<?= $organization['organization_address']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="organization_description">Description</label>
                                                <textarea class="form-control" id="organization_description"
                                                    name="organization_description" rows="3"
                                                    disabled><?= $organization['organization_description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--coordinators-->
                        <div class="tab-pane fade" id="coordinators" role="tabpanel" aria-labelledby="coordinators-tab">

                            <div class="card border-0 bg-transparent shadow-none">
                                <?php $coordinators_by_organization = $get_coordinator->getCoordinatorByOrganization($organization['organization_id']); ?>
                                <div class="card-header d-inline-block">
                                    <span>
                                        Coordinators (<?= count($coordinators_by_organization); ?>)
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($coordinators_by_organization as $coordinator) : ?>
                                                <tr>
                                                    <td><?= $coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>
                                                    </td>
                                                    <td><?= $get_user->getUser($coordinator['coordinator_id'])['user_email']; ?>
                                                    </td>
                                                    <td><?= $coordinator['contact_number']; ?></td>
                                                    <td>
                                                        <a href="coordinator.php?coordinator_id=<?= $coordinator['coordinator_id']; ?>"
                                                            class="btn btn-primary btn-sm" target="_blank">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--students-->
                        <div class="tab-pane fade show active" id="students" role="tabpanel"
                            aria-labelledby="students-tab">
                            <?php $enrollments_by_organization = $get_enrollment->getEnrollmentByOrganization($organization['organization_id']); ?>
                            <div class="card border-0 bg-transparent shadow-none">
                                <div class="card-header d-inline-block">
                                    <span>
                                        Students (<?= count($enrollments_by_organization); ?>)
                                    </span>

                                    <div class="float-right">
                                        <a class="btn btn-info shadow btn-icon-split ml-2" href="javascript:void(0);"
                                            data-toggle="modal" data-target="#createEnrollmentModal">
                                            <span class="icon text-white">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Start Date</th>
                                                    <th>Total Training Hours</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($enrollments_by_organization as $enrollment) : ?>
                                                <tr>
                                                    <td><?= $get_student->getStudent($enrollment['student_id'])['first_name'] . ' ' . $get_student->getStudent($enrollment['student_id'])['last_name']; ?>
                                                    </td>
                                                    <!-- format date -->
                                                    <td><?= date('F d, Y', strtotime($enrollment['start_date'])); ?></td>
                                                    <td><?= $enrollment['total_training_hours']; ?></td>
                                                    <td>
                                                        <a href="student.php?student_id=<?= $enrollment['student_id']; ?>"
                                                            class="btn btn-primary btn-sm" target="_blank">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="graduates" role="tabpanel" aria-labelledby="graduates-tab">
                            <div class="card border-0 bg-transparent shadow-none">
                                <div class="card-header d-inline-block">
                                    <span>
                                        Graduated (1)
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Organization</th>
                                                    <th>Coordinator</th>
                                                    <th>Created At</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- delete enrollment modal -->
        <div class="modal fade" id="deleteEnrollmentModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="deleteEnrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="enrollment_delete.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteEnrollmentModalLabel">
                                Delete Enrollment
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this enrollment?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="enrollment_id" id="enrollment_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Delete Modal-->

        <!-- create enrollment modal -->
        <div class="modal fade" id="createEnrollmentModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="createEnrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="enrollment_create.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createEnrollmentModalLabel">
                                Enroll Student to <?= $organization['organization_name']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="organization_id" value="<?= $organization['organization_id']; ?>">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_id">Student</label>
                                        <select class="form-control" name="student_id" id="student_id" required>
                                            <option selected hidden disabled>Select Student</option>
                                            <?php $students_not_enrolled = $get_student->getStudentNotEnrolled(); ?>
                                            <?php foreach ($students_not_enrolled as $student) : ?>
                                            <option value="<?= $student['student_id']; ?>">
                                                <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="school_year">School Year</label>
                                        <select class="form-control" name="school_year" id="school_year" required>
                                            <option selected hidden disabled>Select School Year</option>
                                            <option value="2022-2023">2022-2023</option>
                                            <option value="2021-2022">2023-2024</option>
                                            <option value="2020-2021">2024-2025</option>
                                            <option value="2019-2020">2025-2026</option>
                                            <option value="2018-2019">2026-2027</option>
                                            <option value="2017-2018">2027-2028</option>
                                            <option value="2016-2017">2028-2029</option>
                                            <option value="2015-2016">2029-2030</option>
                                            <option value="2014-2015">2030-2031</option>
                                            <option value="2013-2014">2031-2032</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" id="start_date"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_training_hours">Total Training Hours</label>
                                        <input type="number" class="form-control" name="total_training_hours"
                                            id="total_training_hours" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- edit organization modal -->
        <div class="modal fade" id="editOrganizationModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="editOrganizationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="organization_edit.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editOrganizationModalLabel">Update Organization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <input type="hidden" name="organization_id"
                                    value="<?= $organization['organization_id']; ?>">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_name">Name</label>
                                        <input type="text" class="form-control" id="organization_name"
                                            name="organization_name" placeholder="Enter Organization Name"
                                            value="<?= $organization['organization_name']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_address">Address</label>
                                        <input type="text" class="form-control" id="organization_address"
                                            name="organization_address" placeholder="Enter Organization Address"
                                            value="<?= $organization['organization_address']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_email">Email</label>
                                        <input type="email" class="form-control" id="organization_email"
                                            name="organization_email" placeholder="Enter Organization Email"
                                            value="<?= $organization['organization_email']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="organization_contact_number"
                                            name="organization_contact_number"
                                            placeholder="Enter Organization Contact Number"
                                            value="<?= $organization['organization_contact_number']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="organization_description">Description</label>
                                        <textarea class="form-control" id="organization_description" rows="3"
                                            name="organization_description" placeholder="Enter Organization Description"
                                            required><?= $organization['organization_description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="edit_organization" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end edit organization modal -->

        <!-- delete organization modal -->
        <div class="modal fade" id="deleteOrganizationModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="deleteOrganizationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="organization_delete.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteOrganizationModalLabel">
                                <?= $organization['organization_name']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this organization?
                            <input type="hidden" name="organization_id"
                                value="<?= $organization['organization_id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="organization_delete">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end delete organization modal -->

    </main>

    <?php require_once('components/footer.php'); ?>