<!--start footer-->
<footer class="footer mt-auto footer-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 small">Copyright &#xA9; Capstone Project <script>
                    document.write(new Date().getFullYear());
                </script>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->
</div>
</div>

<!--Script JS-->
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function TaostrAlert(type, message) {
        Command: toastr[type](message)

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    function displayAttendance() {
        $.ajax({
            url: "students_attendance.php",
            type: "POST",
            data: {
                organization_id: <?= $organization['organization_id']; ?>
            },
            success: function (data) {
                if (data == 'error') {
                    TaostrAlert('error', 'Error in fetching attendance');
                } else {
                    $("#attendance_display").html(data);
                }
            }
        });
    }

    $(document).ready(function () {

        setInterval(function () {
            displayAttendance();
        }, 1000);

        $('#dataTable').DataTable();
    });
</script>
</body>

</html>