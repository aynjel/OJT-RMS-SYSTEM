<?php
require_once('init.php');

date_default_timezone_set('Asia/Manila');

$title = 'Attendance';
$curr_page = basename(__FILE__);

?>

<?php require_once('components/header.php'); ?>
<style>
    .form {
        font-family: Helvetica, sans-serif;
        max-width: 400px;
        margin: 0 auto;
        padding: 16px;
        background: #f7f7f7;
    }

    .form h1 {
        background: #5868bf;
        padding: 20px 0;
        font-weight: 300;
        text-align: center;
        color: #fff;
        margin: -16px -16px 16px -16px;
        font-size: 25px;
    }

    .form input[type="text"],
    .form input[type="website"] {
        box-sizing: border-box;
        width: 100%;
        background: #fff;
        margin-bottom: 4%;
        border: 1px solid #ccc;
        padding: 3%;
        color: #555;
    }

    .form input[type="text"]:focus,
    .form input[type="website"]:focus {
        box-shadow: 0 0 5px #5868bf;
        padding: 3%;
        border: 1px solid #5868bf;
    }

    .form button {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 150px;
        margin: 0 auto;
        padding: 3%;
        background: #5868bf;
        border-bottom: 2px solid #5868bf;
        border-top-style: none;
        border-right-style: none;
        border-left-style: none;
        color: #fff;
        cursor: pointer;
    }

    .form button:hover {
        background: rgba(88, 104, 191, 0.5);
    }

    #qrcode-container-morning, #qrcode-container-afternoon {
        display: none;
    }

    .qrcode-morning, .qrcode-afternoon {
        padding: 16px;
    }

    .qrcode-morning img, .qrcode-afternoon img {
        margin: 0 auto;
    }
</style>
<?php require_once('components/sidebar.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title d-inline-block">
                        <div class="page-header-icon"><i data-feather="calendar"></i></div>
                        <span>
                            <?= $title; ?>
                        </span>
                    </h1>

                    <div class=float-right>

                        <span class="badge badge-pill badge-light badge-lg p-2">
                            <i class="fas fa-clock"></i> <?= date('l, F d, Y'); ?> - <span id="time"></span>
                        </span>

                        <script>
                            function display_c() {
                                var refresh = 1000;
                                mytime = setTimeout('display_ct()', refresh)
                            }

                            function display_ct() {
                                var strcount
                                var x = new Date()
                                var ampm = x.getHours() >= 12 ? 'PM' : 'AM';
                                hours = x.getHours() % 12;
                                hours = hours ? hours : 12;
                                minutes = x.getMinutes() < 10 ? '0' + x.getMinutes() : x.getMinutes();
                                seconds = x.getSeconds() < 10 ? '0' + x.getSeconds() : x.getSeconds();
                                var x1 = hours + ":" + minutes + ":" + seconds + " " + ampm;
                                document.getElementById('time').innerHTML = x1;
                                tt = display_c();
                            }

                            display_ct();
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="row">
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Attendance
                        </div>

                        <div class="card-body" id="attendance_display"></div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="morning-tab" data-toggle="tab" data-target="#morning" href="#morning"
                                        role="tab" aria-controls="morning" aria-selected="true">Morning</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="afternoon-tab" data-toggle="tab" data-target="#afternoon" href="#afternoon"
                                        role="tab" aria-controls="afternoon" aria-selected="false">Afternoon</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="morning" role="tabpanel"
                                    aria-labelledby="morning-tab">
                                    
                                    <div id="qrcode-container-morning">
                                        <div id="qrcode-morning" class="qrcode-morning"></div>
                                    </div>

                                    <input type="hidden" id="coordinator_id" name="coordinator_id"
                                        value="<?= $coordinator['coordinator_id']; ?>">
                                    <input type="hidden" id="organization_id" name="organization_id"
                                        value="<?= $coordinator['organization_id']; ?>">
                                    <input type="hidden" id="attendance_date_morning" name="attendance_date_morning"
                                        value="<?= date('l, F d, Y'); ?>">
                                    <input type="hidden" id="attendance_time_morning" name="attendance_time_morning"
                                        value="<?= date('h:i A'); ?>">
            
                                    <button type="button" onclick="generateQRCodeMorning()" class="btn btn-primary btn-block">
                                        Generate QR Code
                                    </button>
                                </div>

                                <div class="tab-pane fade" id="afternoon" role="tabpanel"
                                    aria-labelledby="afternoon-tab">
                                    
                                    <div id="qrcode-container-afternoon">
                                        <div id="qrcode-afternoon" class="qrcode-afternoon"></div>
                                    </div>

                                    <input type="hidden" id="coordinator_id" name="coordinator_id"
                                        value="<?= $coordinator['coordinator_id']; ?>">
                                    <input type="hidden" id="organization_id" name="organization_id"
                                        value="<?= $coordinator['organization_id']; ?>">
                                    <input type="hidden" id="attendance_date_afternoon" name="attendance_date_afternoon"
                                        value="<?= date('l, F d, Y'); ?>">
                                    <input type="hidden" id="attendance_time_afternoon" name="attendance_time_afternoon"
                                        value="<?= date('h:i A'); ?>">

                                    <button type="button" onclick="generateQRCodeAfternoon()" class="btn btn-primary btn-block">
                                        Generate QR Code
                                    </button>

                                </div>


                            </div>

                        </div>

                            <script type="text/javascript">
                                function generateQRCodeMorning() {
                                    let coordinator_id = $('#coordinator_id').val();
                                    let organization_id = $('#organization_id').val();
                                    let attendance_log = 'Morning';
                                    let attendance_date = $('#attendance_date_morning').val();
                                    let attendance_time = $('#attendance_time_morning').val();

                                    let qrcodeContainer = document.getElementById("qrcode-morning");
                                    qrcodeContainer.innerHTML = "";

                                    let text =
                                        `coordinator_id=${coordinator_id}&organization_id=${organization_id}&attendance_log=${attendance_log}&attendance_date=${attendance_date}&attendance_time=${attendance_time}`;

                                    new QRCode(qrcodeContainer, {
                                        text: text,
                                        width: 256,
                                        height: 256,
                                        colorDark: "#000000",
                                        colorLight: "#ffffff",
                                        correctLevel: QRCode.CorrectLevel.H
                                    });
                                    document.getElementById("qrcode-container-morning").style.display = "block";
                                }

                                function generateQRCodeAfternoon() {
                                    let coordinator_id = $('#coordinator_id').val();
                                    let organization_id = $('#organization_id').val();
                                    let attendance_log = 'Afternoon';
                                    let attendance_date = $('#attendance_date_afternoon').val();
                                    let attendance_time = $('#attendance_time_afternoon').val();

                                    let qrcodeContainer = document.getElementById("qrcode-afternoon");
                                    qrcodeContainer.innerHTML = "";

                                    let text =
                                        `coordinator_id=${coordinator_id}&organization_id=${organization_id}&attendance_log=${attendance_log}&attendance_date=${attendance_date}&attendance_time=${attendance_time}`;

                                    new QRCode(qrcodeContainer, {
                                        text: text,
                                        width: 256,
                                        height: 256,
                                        colorDark: "#000000",
                                        colorLight: "#ffffff",
                                        correctLevel: QRCode.CorrectLevel.H
                                    });
                                    document.getElementById("qrcode-container-afternoon").style.display = "block";
                                }
                            </script>
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
                                <input type="hidden" name="organization_id"
                                    value="<?=$organization['organization_id']; ?>">
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