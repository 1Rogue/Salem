jQuery(document).ready(function($) {

    var upload = 0;

    $(function() {
        var addfile = function() {
            var newRow = $("<tr><td class=\"field_name span4\"><strong></strong></td>"
                    + "<td class=\"field_option\"><input type=\"file\" class=\"file" + (upload + 1).toString() + "\" name=\"pictures[]\">")
                    .insertAfter($(this).closest('tr'));
            newRow.find('input.file' + (upload + 1).toString()).change(addfile);
            $("input.file" + upload.toString()).off('change');
            upload++;
        };
        $("input.file" + upload.toString()).change(addfile);
    });
});