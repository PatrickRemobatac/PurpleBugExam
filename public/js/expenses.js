


$(document).ready(function () {

    function clickable_table() {
        $('#expenses_table tr').click(function() {
            var get_info = $(this).find("a").attr("name");
            var spilt_info = get_info.split('||');

            var id = spilt_info[0];
            var cat_id = spilt_info[1];
            var amount = spilt_info[2];
            var entry_date = spilt_info[3];

            $('#hidden_id').attr('name',id);
            $('#modal_delete_expenses_disp_name').val(cat_id);
            $('#modal_delete_expenses_disp_name').change();

            $('#modal_delete_expenses_amount').val(amount);
            $('#modal_delete_expenses_entry_date').val(entry_date);

            console.log(get_info);

            $('#update_expenses_modal').modal('show');

        });
    }

    clickable_table();


    //add
    $('#btn_add_expenses').click(function () {

        var category = $('#modal_add_expenses_disp_name').val();
        var amount = $('#modal_add_expenses_amount').val();
        var entry_date = $('#modal_add_expenses_entry_date').val();

        // alert(entry_date);

        $.ajax({
            url: '/expense_manage/expenses/add',
            data : {
                'category' : category,
                'amount' : amount,
                'entry_date' : entry_date,
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);

                // //add table data
                $("#expenses_table").last().append("<tr id='tr_id_"+data['exp_id']+"'>" +
                    "<td hidden> <a id='a_table_role' name='"+data['exp_id']+"||"+data['exp_name']+"||"+data['exp_amount']+"||"+data['exp_entry_date']+"'>"+data['exp_id']+"</a> </td>" +
                    "<td id='td_expenses_name_"+data['exp_id']+"'>"+data['exp_name']+"</td>" +
                    "<td id='td_expenses_amount_"+data['exp_id']+"'>$"+data['exp_amount']+"</td>" +
                    "<td id='td_expenses_entry_"+data['exp_id']+"'>"+data['exp_entry_date']+"</td>" +
                    "<td>"+data['exp_created']+"</td>" +
                    "</tr>");

                $('#add_expenses_modal').modal('hide');
                clickable_table();

            },
            error : function (e) {
                alert(e.responseText);
            }
        })

    });

    //update
    $('#btn_update_expenses').click(function () {

        var id =  $('#hidden_id').attr('name');
        var category = $('#modal_delete_expenses_disp_name').val();
        var amount = $('#modal_delete_expenses_amount').val();
        var entry_date = $('#modal_delete_expenses_entry_date').val();


        $.ajax({
            url: '/expense_manage/expenses/update',
            data : {
                'id' : id,
                'category' : category,
                'amount' : amount,
                'entry_date' : entry_date
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);

                $('#td_expenses_name_'+id+'').html(data['exp_category']);
                $('#td_expenses_amount_'+id+'').html('$'+data['exp_amount']);
                $('#td_expenses_entry_'+id+'').html(data['exp_entry']);

                $('#update_expenses_modal').modal('hide');

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });


    //delete
    $('#btn_delete_expenses').click(function () {

        var id =  $('#hidden_id').attr('name');

        $.ajax({
            url: '/expense_manage/expenses/delete',
            data : {
                'id' : id
            },
            type: 'get',
            success : function (data) {

                alert(data['response']);
                $('#tr_id_' + id + '').remove();
                $('#update_expenses_modal').modal('hide');

            },
            error : function (e) {
                alert(e.responseText);
            }
        })
    });
});