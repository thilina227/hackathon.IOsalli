$( document ).ready(function() {
    $('#panel').hide();
});

$( document ).on('click', '#panel_head', function() {
    $('#panel').slideToggle();
});

jQuery( document ).ready(function(  ) {
jQuery('.manual-effect-filter').slider({
	});
});


$( document ).on('click', '#panel_head', function() {

    $.ajax({ 
        type: 'POST', 
        url: 'http://localhost/koding.Hackathon/Hack/service.php?from=2010-2-25&to2020-3-3', 
        // The key needs to match your method's input parameter (case-sensitive).
            data: JSON.stringify({ Markers: title }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){alert('data');},
            failure: function(errMsg) {
                alert(errMsg);
            }
        /*data: { get_param: '@attributes' }, 
        dataType: 'json',
        success: function(data){
        	console.log('ss');
        }*//*,
        done: function (data) { 
            $.each(data, function(index, element) {
                $('#panel_head').append($('<div>', {
                text: element.name
            }));
            console.log('element');
            });
        }*/
    });
});