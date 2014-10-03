$(window).load(function () {
    var parser = document.createElement('a');
    parser.href = document.URL;
    var prefixUriMatch = parser.pathname.match(/(\/env\/[0-9]+)/);
    var prefixUri = prefixUriMatch ? prefixUriMatch[1] : '';

    $.getJSON(prefixUri + '/dashboard/stats', function (data) {
        $('#os-distribution-title').html(data.osDistributionTitle);
        $('#unchanged-count').html(data.unchangedCount);
        $('#changed-count').html(data.changedCount);
        $('#failed-count').html(data.failedCount);
        $('#os-distribution').html('');
        $.each(data.osDistribution, function (index, val) {
            $('#os-distribution').append(val);
        });
        $.each(data.recentlyRebooted, function (index, val) {
            $('#recently-rebooted').append(val);
        });
    });
});
