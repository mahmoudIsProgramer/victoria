$(document).ready(function () {

    var materials_selectbox_names = [];

    $( ".level_id" ).change(function() {
        // $('.class_id').find('option[value!=""]').remove(); 
        $(document).find('.years').empty();
        // alert($(this).val()); 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        
            url:"/admin/get_years",
            method:'get',
            data:{ level_id: $(this).val() },
            success:function(data)
            {
                // console.log(data.years);
                $( data.years ).each(function( index , year  ) {
                    
                    $('.years').append(
                        '<div  class = "form-check" >'+
                            '<input class="form-check-input year_id" type="checkbox" value="'+year['id']+'">'+
                            '<label class="form-check-label" for="defaultCheck1">'+ year['name'] +'</label>'+
                            '<div id="year_'+year['id']+'"></div>'+
                        '</div>'
                    ); 
                    
                });
            
            },error:function(){
            }

        });
    });

    $(document).on('change','.year_id',function(){
        

        // if uncheck year remove the classes blongs to it  and remove the materials  also 
        if ($(this).is(':checked')  == false ) {
            $("#year_"+$(this).val()).empty();  
            $('#materials_year_'+$(this).val()).remove(); 

            // remove  select box name from  array materials_selectbox
            var removedSelectBox = "select_material_"+$(this).val();
            materials_selectbox_names = jQuery.grep(materials_selectbox_names, function(value) {
                    return value !=removedSelectBox ;
                });
            $("input[name=materials_selectbox_names]").val(materials_selectbox_names) ; 
            
            console.log(materials_selectbox_names) ; 
            return ; 
        };

        // else get all classes from database 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        
            url:"/admin/teacher/get_classes",
            method:'get',
            data:{ year_id: $(this).val() },
            success:function(data)
            {
                // alert(data.year_id) ; 
                $( data.classes ).each(function( index , classe  ) {

                    //  display  classes 
                    $('#year_'+data.year['id']).append(
                        ' <div class="form-check form-check-inline">'+
                            '<input class="form-check-input" name = "classes[]" type="checkbox" value="'+classe['id']+'">'+
                            '<label class="form-check-label" for="inlineCheckbox1">'+classe['name']+'</label>'+
                        '</div>'
                    ); 

                });

                // start display materials in this year 
                var div  = $('<div class="input-group mb-2" id = "materials_year_'+data.year['id'] + '"> </div>') ; 
                var sel = $('<select required autofocus name = "select_material_'+data.year['id'] + '" >'+
                                    '<option value = "">Materials '+data.year['name']+ '</option> '+
                                '</select>');

                $(data.materials).each(function(index  , material) {
                    sel.append($("<option>").attr('value',material['id']).text( material['name'] ));
                }); 
                div.append(sel); 
                div.appendTo('.materials'); 

                // end display materialvs in this year 
                // add select box name to array materials_selectbox
                materials_selectbox_names.push("select_material_"+data.year['id']);
                $("input[name=materials_selectbox_names]").val(materials_selectbox_names) ; 

                console.log(materials_selectbox_names) ;  
            },error:function(){
            
            }

        });
    });

    

});