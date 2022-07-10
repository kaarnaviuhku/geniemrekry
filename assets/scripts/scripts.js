window.DustPressStarter = (function(window, document, $) {

    var button = $('button.toggle-button');
    var futureEventsContainer = $('div#future-events');
    var allEventsContainer = $('div#all-events');

    button.on('click', function() {
        var target = $(this);

        target.addClass('active');
        target.siblings().removeClass('active');

        if (target.attr('id') == 'future-events-button') {
            futureEventsContainer.addClass('open');
            allEventsContainer.removeClass('open');
        } else {
            futureEventsContainer.removeClass('open');
            allEventsContainer.addClass('open');
        }
    });

}(window, document, jQuery));