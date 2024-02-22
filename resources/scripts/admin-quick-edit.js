jQuery(document).ready(function($) {
    // Initialize the DatePicker
    

    // When the Quick Edit link is clicked
    $(document).on('click', '.editinline', function() {
        // Get the post ID
        var postId = $(this).closest('tr').attr('id').replace('post-', '');

        // Use AJAX to fetch the post's ACF field values
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'fetch_acf_values',
                post_id: postId
            },
            success: function(response) {
                console.log("Returned tour_date:", response.data.tour_date);
        
                // If the response contains the ACF field values
                if (response.success) {
                    // Assuming the date is in DD.MM.YYYY format, convert it to YYYY-MM-DD
                    var dateParts = response.data.tour_date.split(".");
                    var formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
        
                    // Insert the values into the Quick Edit fields
                    $('input[name="acf[tour_date]"]').val(formattedDate);
                    $('input[name="acf[tour_time]"]').val(response.data.tour_time);
                }
            }
        });
        

       
    });


});
