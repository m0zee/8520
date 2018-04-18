$(document).ready(function() {
        var base_url = $('#base_url').val();
        $('#category').on('change', function() {
            $this = $(this);
            get_sub_category($this);
        });

        if ( $('#category').val() > 0 ) 
        {
            $this = $('#category');
            get_sub_category($this);
        }

        function get_sub_category($this) {
            var category_id = $this.val();

            $.ajax({
                url: base_url + '/get_sub_category',
                type: 'POST',
                dataType: 'JSON',
                data: {category_id: category_id},
                success:function (response){
                    var rows = makeRows(response);
                    $('#sub_category').html(rows);

                    if ( $('#sub_category_id').val() > 0 ) 
                    {
                        $('#sub_category').val( $('#sub_category_id').val() );
                    }
                }
            });
            
        }

        function makeRows(response) {
            var row = '<option value="0"> Please Select </options>';
            $.each(response, function(index, val) {
                row +=  '<option value="'+val.id+'"> '+val.name+' </options>';
            });
            return row;
        }
    });