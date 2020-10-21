

$(document).ready(function () {


    $.ajax({
        url: '/dashboard/getdata',
        type: 'get',
        success : function (data) {

            var to_table = '';
            var arr_base = [['Expenses Category','Total']];

            for (var ctr = 0; ctr < data['data'].length; ctr++)
            {
                arr_base.push([data['data'][ctr]['category'],data['data'][ctr]['total']]);

                to_table += '<tr><td>'+data['data'][ctr]['category']+'</td><td>$'+data['data'][ctr]['total']+'</td></tr>'
            }
            console.log(arr_base);
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {

                var data = google.visualization.arrayToDataTable(arr_base);

                // // Optional; add a title and set the width and height of the chart
                // var options = {'title':'My Average Day'};

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data);
            }


            $("#table_dashboard").last().append(to_table);


        },
        error : function (e) {
            alert(e.responseText);
        }
    })



});