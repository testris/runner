$(function() {
    $('.toggle-period').change(function() {
        var $el = $(this);
        var $portletBody = startLoader($el);

        $.get(
            $(this).data('url'),
            {
                criteria: $el.data('criteria'),
                period: $el.val()
            },
            function (response) {
                stopLoader($el, $portletBody);

                $portletBody.find('.table-scrollable').empty().append(response);
            }
        );
    });

    $('.toggle-period:checked').each(function() {
        var $el = $(this);
        startLoader($el);

        setTimeout(function() {
            $el.change();
        }, 3000);
    });

    function startLoader($el) {
        if ($el.startLoadr) {
            return;
        }

        $el.startLoadr = true;
        var $portletBody = $el.closest(".portlet").children(".portlet-body");
        App.blockUI({
            target: $portletBody
        });

        return $portletBody;
    }
    function stopLoader($el, $portletBody) {
        $el.startLoadr = false;
        App.unblockUI($portletBody);
    }

    var Dashboard = function() {
        function initMorisCharts() {
            if (Morris.EventEmitter && $('#run_statistics').size() > 0) {

                function getRandomInt(min, max) {
                    return Math.floor(Math.random() * (max - min)) + min;
                }

                var runStatisticData = [];

                for( var i=1; i<=31; i++) {
                    var fail = getRandomInt(0, 7);
                    runStatisticData.push({ period: i + ', Nov', fail: fail, pass: (140 - fail) });
                }

                // // Use Morris.Area instead of Morris.Line
                dashboardMainChart = Morris.Area({
                    element: 'run_statistics',
                    padding: 0,
                    behaveLikeLine: false,
                    gridEnabled: false,
                    gridLineColor: false,
                    axes: false,
                    fillOpacity: 1,
                    data: runStatisticData,
                    lineColors: ['#EF4836', '#399a8c'],
                    xkey: 'period',
                    ykeys: ['fail', 'pass'],
                    labels: ['fail', 'pass'],
                    pointSize: 0,
                    lineWidth: 0,
                    hideHover: 'auto',
                    resize: true
                });

            }
        }

        return {
            init: function() {
                initMorisCharts();
            }
        };
    }();

    Dashboard.init();
});