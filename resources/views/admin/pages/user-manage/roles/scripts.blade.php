<script type="text/javascript">

    // trigger a button after dom is loaded
    $(document).ready(function() {
        $('#check_all_permissions').click(function() {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            }else{
                // uncheck all the check
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    });

    function checkPermissionsCreateByGroup(classname, checkthis) {
        const groupidname = $('#'+checkthis.id);
        const classcheckbox = $('.'+classname+' input');
        if (groupidname.is(':checked')) {
            // check all the checkbox
            classcheckbox.prop('checked', true);
        }else{
            // uncheck all the check
            classcheckbox.prop('checked', false);
        }
        implementCreateAllCheck();
    }
    function checkCreateSinglePermission(groupclassname, groupid, counttotalpermission) {
        const classcheckbox = $('.'+groupclassname+' input');
        const groupidbox = $('#'+groupid);
        // if there is any occureance were something is not selected make checked == false
        if ($('.'+groupclassname+' input:checked').length == counttotalpermission) {
            // check all the checkbox
            groupidbox.prop('checked', true);
        }else{
            // uncheck all the check
            groupidbox.prop('checked', false);
        }
        implementCreateAllCheck();
    }
    function implementCreateAllCheck() {
        const countpermissions = {{ count($permissions) }};
        const countpermissionsgroups = {{ count($permission_groups) }};
        // if there is any occureance were something is not selected make checked == false
        if ($('input[type="checkbox"]:checked').length >= (countpermissions+countpermissionsgroups)) {
            // check all the checkbox
            $('#check_all_permissions').prop('checked', true);
        }else{
            // uncheck all the check
            $('#check_all_permissions').prop('checked', false);
        }
    }

</script>
