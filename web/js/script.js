$(document).ready(function(){
    $(function(){
        $("#from_date").datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $("#to_date").datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $('#filter').click(function(){
        var from = $('#from').val();
        var to = $('#to').val();
        if(from_date != '' && to_date != '')
        {
            $.ajax({
                url:"result.php",
                method:"POST",
                data:{from_date:from, to_date:to},
                success:function(data)
                {
                    $('#result').html(data);
                }
            });
        }
        else
        {
            alert("Please Select Date");
        }
    });
});
