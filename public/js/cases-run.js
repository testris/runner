var Cases = function() {

    function generateSteps(element, name) {
        var steps = $(element).find('.node__steps').data(name);

        var output = '';
        if (/\n/.exec(steps)) {
            steps = steps.split("\n");

            for (var i=0; i < steps.length; i++) {
                output += '<li>' + steps[i].replace(/# /, '') + '</li>';
            }
        } else {
            output = steps;
        }

        return output;
    };

    function generateTitle(element) {
        var id = $(element).find('.node-title').data('id');
        var status = $(element).find('.node-title').data('status');
        $('#case-edit-btn').attr('href', '/test-cases/' + id + '/edit');
        $('#case-delete-btn').attr('href', '/test-cases/' + id + '/delete');
        return getIdLabel(id, status) + $(element).find('.node__name').text();
    };

    function generateClass(element) {
        var className = $(element).find('.node-title').data('class');
        return '<i class="fa fa-code fa-lg"></i> ' + className;
    };

    function generateSite(element) {
        var site = $(element).find('.node-title').data('site');
        return '<i class="fa fa-globe fa-lg"></i> ' + site;
    };

    function getIdLabel(id, status) {
        var statusLabel = '';
        
        switch (status)  {
            case 'untested':
                statusLabel = '<span class="label label_status_unknown rounded-3">Untested</span>&nbsp;';
                break;
            case 'passed':
                statusLabel = '<span class="label label_status_passed rounded-3">Passed</span>&nbsp;';
                break;
            case 'failed':
                statusLabel = '<span class="label label_status_failed rounded-3">Failed</span>&nbsp;';
                break;
            case 'broken':
                statusLabel = '<span class="label label_status_broken rounded-3">Broken</span>&nbsp;';
                break;
        }

        return statusLabel + '<span class="label label-primary rounded-3">#' + id + '</span>&nbsp;&nbsp;';
    };

    function generateExecutionSteps(element) {
        var resultId = $(element).find('.node-title').data('result-id');
        return $('#result-steps-' + resultId).html();
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
                $('#execution-steps').html(generateExecutionSteps(this));
                Steps.init();
            });

            $('[data-case]').on('change', function () {
                var id = $(this).attr('data-case');
                if( $(this).prop('checked') ) {
                    // for sections
                    $(this).closest('.node').find('.node-children').children('.node').children('label').find('input').each(function () {
                        if(!$(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                    // for cases
                    $(this).closest('.node').find('.node-children').children('div').children('label').find('input').each(function () {
                        if(!$(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                } else {
                    // for sections
                    $(this).closest('.node').find('.node-children').children('.node').children('label').find('input').each(function () {
                        if($(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                    // for cases
                    $(this).closest('.node').find('.node-children').children('div').children('label').find('input').each(function () {
                        if($(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                }
            });

            $('#all-cases-checkbox').on('change', function () {
                if( $(this).prop('checked') ) {
                    $('.cases-list input[type=checkbox]').each(function () {
                        if(!$(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.cases-list input[type=checkbox]').each(function () {
                        if($(this).prop('checked')) {
                            $(this).click();
                        }
                    });
                }
            });

            $(".node-title.long-line").each(function(index) {
                var unknownCount = $(this).next().find('.fa-question-circle').length;
                var failedCount = $(this).next().find('.fa-times-circle').length;
                var brokenCount = $(this).next().find('.fa-exclamation-circle').length;
                var passedCount = $(this).next().find('.fa-check-circle').length;

                var unknownCounter = '';
                if (unknownCount) {
                    unknownCounter = '<span class="badge badge-default badge-roundless label_status_unknown">' + unknownCount + '</span> ';
                }

                var failedCounter = '';
                if (failedCount) {
                    failedCounter = '<span class="badge badge-default badge-roundless label_status_failed">' + failedCount + '</span> ';
                }

                var brokenCounter = '';
                if (brokenCount) {
                    brokenCounter = '<span class="badge badge-default badge-roundless label_status_broken">' + brokenCount + '</span> ';
                }

                var passedCounter = '';
                if (passedCount) {
                    passedCounter = '<span class="badge badge-default badge-roundless label_status_passed">' + passedCount + '</span> ';
                }

                $(this).append(
                    '<span class="node__stats">' +
                        passedCounter +
                        brokenCounter +
                        failedCounter +
                        unknownCounter +
                    '</span>');
            });

            $(".node").each(function(index) {
                if ($(this).hasClass('case-node')) {
                    return;
                }

                if ($(this).has(".case-node").length == 0) {
                    $(this).remove();
                }
            });

            var hash = window.location.hash;
            if (hash.search(/#testCase/) != -1) {
                var testCaseHash = hash.split('-');
                var testCaseId = testCaseHash[1];
                $('.node-title[data-id=' + testCaseId + ']').click();
            }
        }
    }
}();

jQuery(document).ready(function() {
    Cases.init();
});