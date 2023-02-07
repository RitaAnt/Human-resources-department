$(document).ready(function () {
    $('#ButtonForm input').on('click', function() {
        let result = $(this).val();
        console.log(result);
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