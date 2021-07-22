<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <a href="<?= base_url('auth/about'); ?>">
                <span>Event Management App Copyright &copy; by <?= date('Y'); ?> v. 1.0.0</span>
            </a>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function() {
        /*timeline(document.querySelectorAll('.timeline'), {
        mode: 'horizontal',
	    visibleItems: 4,
	    forceVerticalWidth: 800
    });*/
        //jQuery('.timeline').timeline();
        jQuery('.timeline').timeline({
            mode: 'horizontal',
            visibleItems: 2,
            forceVerticalWidth: 800
        });
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/vendor/jquerytimeline/'); ?>jquery.roadmap.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>