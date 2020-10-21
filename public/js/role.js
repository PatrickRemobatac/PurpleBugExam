

$(document).ready(function () {

function clickable_table() {
    $('#role_table tr').click(function() {
        var get_info = $(this).find("a").attr("name");
        var spilt_info = get_info.split('||');

        var id = spilt_info[0];
        var role_name = spilt_info[1];
        var role_decrip = spilt_info[2];

        $('#hidden_id').attr('name',id);
        $('#modal_role_disp_name').val(role_name);
        $('#modal_role_desc').val(role_decrip);

        console.log(get_info);

        $('#edit_role_modal').modal('show');
    });
}

    clickable_table();

    //add
    $('#btn_add_role').click(function () {

        var role_name = $('#modal_add_role_disp_name').val();
        var role_decrip = $('#modal_add_role_desc').val();

        $.ajax({
            url: '/user_manage/role/add',
            data : {
                'role_name' : role_name,
                'role_desc' : role_decrip
            },
            type: 'get',
            success : function (data) {

                if(data['status'] === 'denied')
                {
                    alert(data['response']);
                }
                else
                {
                    alert(data['response']);

                    //add table data
                    $("#role_table").last().append("<tr id='tr_id_"+data['role_id']+"'>" +
                        "<td hidden> <a id='a_table_role' name='"+data['role_id']+"||"+data['role_name']+"||"+data['role_desc']+"'>"+data['role_id']+"</a> </td>" +
                        "<td id='td_role_name_"+data['role_id']+"'>"+data['role_name']+"</td>" +
                        "<td id='td_role_desc_"+data['role_id']+"'>"+data['role_desc']+"</td>" +
                        "<td>"+data['role_created']+"</td>" +
                        "</tr>");

                    $('#add_role_modal').modal('hide');
                    clickable_table()
                }
            },
            error : function (e) {
                alert(e.responseText);
            }
        })

    });

    //update
    $('#btn_update_role').click(function () {

        var id =  $('#hidden_id').attr('name');
        var role_name =  $('#modal_role_disp_name').val();
        var role_decrip =  $('#modal_role_desc').val();


        $.ajax({
            url: '/user_manage/role/update',
            data : {
                'id' : id,
                'role_name' : role_name,
                'role_desc' : role_decrip
            },
            type: 'get',
            success : function (data) {

                if(data['status'] === 'denied')
                {
                    alert(data['response']);
                }
                else
                {
                    alert(data['response']);

                    $('#td_role_name_'+id+'').html(data['role_name']);
                    $('#td_role_desc_'+id+'').html(data['role_desc']);

                    $('#edit_role_modal').modal('hide');
                }
            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });

    //delete
    $('#btn_delete_role').click(function () {

        var id =  $('#hidden_id').attr('name');

        $.ajax({
            url: '/user_manage/role/delete',
            data : {
                'id' : id
            },
            type: 'get',
            success : function (data) {
                if(data['status'] === 'denied')
                {
                    alert(data['response']);
                }
                else
                {
                    alert(data['response']);
                    $('#tr_id_' + id + '').remove();
                    $('#edit_role_modal').modal('hide');
                }

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });

})