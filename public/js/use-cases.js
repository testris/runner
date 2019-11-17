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

    function generateTitle(element) {
        let id = $(element).find('.node-title').data('id');
        let priority = $(element).find('.node-title').data('priority');
        $('#case-edit-btn').attr('href', '/use-cases/read/' + id);
        $('#case-delete-btn').data('id', id);
        return getIdLabel(id, priority) + $(element).find('.node__name').text();
    };

    function getIdLabel(id, priority) {
        let priorityLabel = '';
        switch (priority)  {
            case 3:
                priorityLabel = '<span class="label label-danger rounded-3">High</span>&nbsp;';
                break;
            case 2:
                priorityLabel = '<span class="label label-success rounded-3">Mid</span>&nbsp;';
                break;
            default:
                priorityLabel = '<span class="label label-info rounded-3">Low</span>&nbsp;';
                break;
        }
        return priorityLabel + '<span class="label label-primary rounded-3">#' + id + '</span>&nbsp;&nbsp;';
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
                $('#case-description').html(generateSteps(this, 'description'));
            });

            $('#case-delete-btn').click(function(){
                $('#delete-window .modal-body').html($('#case-title').html());
                $('#case-delete-btn-confirm').attr('href', '/use-cases/delete/' + $(this).data('id'));
            });
        }
    }
}();

jQuery(document).ready(function() {
    Cases.init();
});