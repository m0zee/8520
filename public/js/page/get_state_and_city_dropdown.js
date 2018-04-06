$(document).ready(function() {
            var base_url = $('#base_url').val();

            $('#country').on('change', function() {
                var $this = $(this);
                get_state($this);
            });

            function get_state($this) {
                var country_id = $this.val();
                $.ajax({
                    url: base_url + '/get_country_state',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {country_id: country_id},
                    success:function (response) {
                        var rows = makeRows(response);
                        $('#state').html(rows);
                    }
                });
            }

            $('#state').on('change', function() {
                var $this = $(this);
                var state_id = $this.val();

                $.ajax({
                    url: base_url + '/get_state_city',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {state_id: state_id},
                    success:function (response) {
                        var rows = makeRows(response);
                        $('#city').html(rows);
                    }
                });
            });

            function makeRows(response) {
                var row = '<option value="0"> Please Select </options>';
                $.each(response, function(index, val) {
                    row +=  '<option value="'+val.id+'"> '+val.name+' </options>';
                });
                return row;
            }
        });