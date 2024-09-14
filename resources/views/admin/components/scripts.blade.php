<script src="{{ asset("admin_assets/js/oneui.app.min.js") }}"></script>
<script src="{{ asset("admin_assets/js/lib/jquery.min.js") }}"></script>
<script src="{{ asset("admin_assets/js/plugins/chart.js/chart.min.js") }}"></script>
<script src="{{ asset("admin_assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>
<script src="{{ asset("admin_assets/js/my_scripts.js") }}"></script>
<script src="{{ asset("admin_assets/js/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("admin_assets/js/plugins/dropzone/min/dropzone.min.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
    .products {
        position: fixed;
        bottom: 0px;
        background: white;
        width: 100%;
        z-index: 1004;
    }

    .products div div {
        margin-bottom: 15px;
    }

    @media screen and (min-width: 769px) {
        .products div div:first-child {
            padding-left: 80px;
        }

        .products div div:last-child {
            padding-right: 80px;
        }
    }

    .close_products {
        position: relative;
        float: right;
    }

    #ui-datepicker-div {
        z-index: 100000 !important;
    }
</style>

<script>
    One.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-maxlength', 'jq-select2', 'jq-rangeslider',
        'jq-colorpicker']);
</script>

<script>
    //start 3 ckeditors in for direfernt language
    initSampleRo();
    initSampleRu();
    initSampleEn();
</script>

<script>
    $('.table-responsive').on('show.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "inherit");
    });

    $('.table-responsive').on('hide.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "auto");
    })
</script>
@yield("scripts")
@stack("scripts")
