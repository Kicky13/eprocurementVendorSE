<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-1 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block"> Copyright  &copy; <span class="brand-text" style="margin-top: 50px; color: #337ab7; font-weight: bold; font-size: 18px">supre<span style="color: #ff3333">m</span>e energy</span> <?= date("Y"); ?></span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block"> All rights reserved.</span></p>
    <!-- <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block"> <a href="#" class="text-bold-800 grey darken-2">PT. SUPREME ENERGY</a>, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Copyright  &copy; <?= date("Y"); ?></span></p> -->
</footer>

<!-- <script src="<?= base_url() ?>ast11/assets_lm/js/bootstrap.min.js"></script> -->
<!-- <script src="<?= base_url() ?>ast11/js/plugins/staps/jquery.steps.min.js"></script> -->
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/js/plugins/validation/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/js/plugins/validation/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/js/plugins/validation/form-validation.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"  type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js"  type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script>  
<script src="<?= base_url() ?>ast11/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/js/core/app.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/jquery-number/jquery.number.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/localization/indonesia.js" type="text/javascript"></script>
<script src="<?= base_url() ?>ast11/app-assets/vendors/js/localization/localization.js" type="text/javascript"></script>

<script src="<?= base_url() ?>ast11/js/plugins/sweetalert/sweetalert.min.js"></script>

<?=isset($js) ? $js : ""?>
<script>
    function coalesce(str, to) {
    if (str == null) {
        if (to) {
            return to;
        } else {
            return '';
        }
    } else {
        return str;
    }
}

function toFloat(value) {
    value = parseFloat(value);
    if (!$.isNumeric(value)) {
        return 0;
    } else {
        return value;
    }
}
</script>
</body>
</html>
