$(document).ready(function () {

    $( ".year_id" ).change(function() {
        $('.class_id').find('option[value!=""]').remove(); 
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        
            url:"/admin/get_classes?year_id="+$(this).val(),
            method:'get',
            data:{  },
            beforeSend: function () {  },
            success:function(data)
            {
                $('.class_id').append(data.options);
            
            },error:function(){
            }

        });
    });

});