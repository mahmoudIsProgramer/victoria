$(document).ready(function () {

    $( ".year_id" ).change(function() {
        $('.class_id').find('option[value!=""]').remove(); 
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        
            url:"/admin/get_classes",
            method:'get',
            data:{ year_id:$(this).val() },
            success:function(data)
            {
                $('.class_id').append(data.options);
            
            },error:function(){
            }

        });
    });

});