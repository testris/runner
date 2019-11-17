var TestRun = function() {
    function generateFilename(element) {
        var filename = $(element).data('filename');
        $('#delete-source-form input[name="filename"]').val(filename);
    };

    function sendDeletePost(e) {
        e.preventDefault();

        var form = $('#delete-source-form');
        var action = form.attr('action');
        var filename = $(form).find('input[name="filename"]').val();

        $.ajax({
            type: "POST",
            url: action + '/' + filename,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: JSON.stringify({filename : filename}),
            success : function (response) {
                $('#delete-window').modal('hide');
            },
            error : function (error) {
                $('#delete-window').modal('hide');
                alert(error.responseJSON['filename'][0]);
            }
        });
    }

    return {
        init: function() {
            $('.source-delete-btn').click(function() {
                generateFilename(this);
            });
            $("#delete-source-form").submit(function(e) {
                sendDeletePost(e);
            });
        }
    }
}();

jQuery(document).ready(function() {
    TestRun.init();
});