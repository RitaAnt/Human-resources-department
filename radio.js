$(document).ready(function () {
    $('#RadioForm input').on('change', function() {
        let result = $('input[name=HR_radio]:checked', '#RadioForm').val();
        $.ajax({
            url:  "query.php",
            type: 'GET',
            data: {result : result},
            success: function(data) 
            {
                $('#result_print').html(data);

            },
            error: function(){
	            console.log('ERROR');
            }           
        })
    })
})
