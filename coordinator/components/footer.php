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
    $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#dataTable_Attendance').DataTable();
    });
</script>
</body>

</html>