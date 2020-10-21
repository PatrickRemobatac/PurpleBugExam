


$(document).ready(function () {


    function clickable_table() {
        $('#cat_table tr').click(function() {
            var get_info = $(this).find("a").attr("name");
            var spilt_info = get_info.split('||');

            var id = spilt_info[0];
            var cat_name = spilt_info[1];
            var cat_decrip = spilt_info[2];

            $('#hidden_id').attr('name',id);
            $('#modal_cat_update_disp_name').val(cat_name);
            $('#modal_cat_update_desc').val(cat_decrip);

            console.log(get_info);

            $('#expense_cat_update_modal').modal('show');
        });
    }

    clickable_table();

    //add
    $('#btn_add_cat').click(function () {

        var cat_name = $('#modal_cat_disp_name').val();
        var cat_desc = $('#modal_cat_desc').val();

        $.ajax({
            url: '/expense_manage/categories/add',
            data : {
                'cat_name' : cat_name,
                'cat_desc' : cat_desc
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);

                //add table data
                $("#cat_table").last().append("<tr id='tr_id_"+data['cat_id']+"'>" +
                    "<td hidden> <a id='a_table_role' name='"+data['cat_id']+"||"+data['cat_name']+"||"+data['cat_desc']+"'>"+data['cat_id']+"</a> </td>" +
                    "<td id='td_cat_name_"+data['cat_id']+"'>"+data['cat_name']+"</td>" +
                    "<td id='td_cat_desc_"+data['cat_id']+"'>"+data['cat_desc']+"</td>" +
                    "<td>"+data['cat_created']+"</td>" +
                    "</tr>");

                $('#expense_cat_add_modal').modal('hide');
                clickable_table();

            },
            error : function (e) {
                alert(e.responseText);
            }
        })

    });


    //update
    $('#btn_update_cat').click(function () {

        var id =  $('#hidden_id').attr('name');
        var cat_name =  $('#modal_cat_update_disp_name').val();
        var cat_desc =  $('#modal_cat_update_desc').val();


        $.ajax({
            url: '/expense_manage/categories/update',
            data : {
                'id' : id,
                'cat_name' : cat_name,
                'cat_desc' : cat_desc
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);

                $('#td_cat_name_'+id+'').html(data['cat_name']);
                $('#td_cat_desc_'+id+'').html(data['cat_desc']);

                $('#expense_cat_update_modal').modal('hide');

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });

    //delete
    $('#btn_delete_cat').click(function () {

        var id =  $('#hidden_id').attr('name');

        $.ajax({
            url: '/expense_manage/categories/delete',
            data : {
                'id' : id
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);
                $('#tr_id_' + id + '').remove();
                $('#expense_cat_update_modal').modal('hide');


            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });
});