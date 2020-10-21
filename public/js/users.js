



$(document).ready(function () {

    $('#users_table tr').click(function() {
        var get_info = $(this).find("a").attr("name");
        var spilt_info = get_info.split('||');

        var id = spilt_info[0];
        var user_name = spilt_info[1];
        var user_email = spilt_info[2];
        var user_roll_id = spilt_info[3];

        $('#hidden_id').attr('name',id);
        $('#modal_update_user_disp_name').val(user_name);
        $('#modal_update_user_email').val(user_email);
        $('#modal_update_user_role').val(user_roll_id);
        $('#modal_update_user_role').change();

        console.log(get_info);

        $('#update_user_modal').modal('show');
    });

    //update
    $('#btn_update_user').click(function () {

        var id =  $('#hidden_id').attr('name');

        var user_name =  $('#modal_update_user_disp_name').val();
        var user_email =  $('#modal_update_user_email').val();
        var user_role =  $('#modal_update_user_role').val();


        $.ajax({
            url: '/user_manage/users/update',
            data : {
                'id' : id,
                'user_name' : user_name,
                'user_email' : user_email,
                'user_role' : user_role,
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);

                $('#td_users_name_'+id+'').html(data['user_name']);
                $('#td_users_email_'+id+'').html(data['user_email']);
                $('#td_users_role_'+id+'').html(data['user_role']);

                $('#update_user_modal').modal('hide');

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });

    //delete
    $('#btn_delete_user').click(function () {

        var id =  $('#hidden_id').attr('name');

        $.ajax({
            url: '/user_manage/users/delete',
            data : {
                'id' : id
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);
                $('#tr_id_' + id + '').remove();
                $('#update_user_modal').modal('hide');

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });


});
