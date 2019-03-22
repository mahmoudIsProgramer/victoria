$(document).ready(function () {
    $( ".materials" ).change(function() {

        var material = $(this) ; 

        // if un select the material remove the teachers select box  
        if(material.val() == "") 
        {
            material.prop('required',false); 
            material.next().empty().append("<option value = '' >Teacher</option>").prop('required',false); 
        
            return   0 ;   // end script 
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        
            url:"/admin/schedule/teachers_on_material",
            method:'get',
            data:{  material_id:$(this).val() },
            beforeSend:function(){
            },
            success:function(data)
            {

                material.next().empty().append("<option value = '' >Teacher</option>"); 
                material.prop('required',true); 
                material.next().append(data.options).prop('required' , true );  

            },error:function(){
            }

        });
    });

});
