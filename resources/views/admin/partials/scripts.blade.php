<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('admin-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->


<script src="{{ asset('admin-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
