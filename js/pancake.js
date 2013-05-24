var minorHidden = false;

$(document).ready(function() {
    $('#hide-minor').click(function() {
        if(minorHidden) {
            $('.minor').each(function() {
                $(this).css('display', 'block');
            });
            $(this).html('Hide minor releases');
            minorHidden = false;
        } else {
            $('.minor').each(function() {
                $(this).css('display', 'none');
            });
            $(this).html('Show minor releases');
            minorHidden = true;
        }
    });
});
