var Cases = function() {

    function generateSteps(element, name) {
        var steps = $(element).find('.node__steps').data(name);

        var output = '';
        if (/\#/.exec(steps)) {
            steps = steps.split("#");

            for (var i=1; i < steps.length; i++) {
                output += '<li>' + steps[i].replace(/# /, '').replace(/\n/g, '<br>') + '</li>';
            }
        } else {
            output = steps;
        }

        return output;
    };

    function generateClass(element) {
        var className = $(element).find('.node-title').data('class');
        return '<i class="fa fa-code fa-lg"></i> ' + className;
    };

    function generateSite(element) {
        var site = $(element).find('.node-title').data('site');
        return '<i class="fa fa-globe fa-lg"></i> ' + site;
    };

    function generateTitle(element) {
        var id = $(element).find('.node-title').data('id');
        var status = $(element).find('.node-title').data('status');
        $('#case-edit-btn').attr('href', '/test-cases/read/' + id);
        $('#case-delete-btn').data('id', id);
        return getIdLabel(id, status) + $(element).find('.node__name').text();
    };

    function getIdLabel(id, status) {
        switch (status)  {
            case 'active':
                statusLabel = '<span class="label label_status_passed rounded-3">Active</span>&nbsp;';
                break;
            case 'disabled':
                statusLabel = '<span class="label label_status_failed rounded-3">Disabled</span>&nbsp;';
                break;
        }

        return statusLabel + '<span class="label label-primary rounded-3">#' + id + '</span>&nbsp;&nbsp;';
    };

    return {
        init: function() {
            $('.node-title').click(function() {
                $(this).find('.angle').toggleClass('fa-angle-right fa-angle-down');
                $(this).parent().children('.node-children').toggle();
            });

            $('.node__leaf').click(function() {
                $('#case-wrapper').show();
                $('.node-title_active').removeClass('node-title_active');
                $(this).find('.node-title').addClass('node-title_active');
                $('#case-title').html(generateTitle(this));
                $('#case-class').html(generateClass(this));
                $('#case-site').html(generateSite(this));
                $('#case-preconditions').html(generateSteps(this, 'preconditions'));
                $('#case-steps').html(generateSteps(this, 'steps'));
                $('#case-result').html(generateSteps(this, 'result'));
            });

            $('#case-delete-btn').click(function(){
                $('#delete-window .modal-body').html($('#case-title').html());
                $('#case-delete-btn-confirm').attr('href', '/test-cases/delete/' + $(this).data('id'));
            });
        }
    }
}();

jQuery(document).ready(function() {
    Cases.init();
});