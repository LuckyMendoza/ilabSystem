$(document).ready(function () {
    var table = $("#handlers_perf_table").DataTable({
        processing: true,
        serverSide: true,
        responsive: false,
        autoWidth: false,
        buttons: false,
        searching: false,
        info: false,
        order: [[0, "asc"]],
        ajax: {
            url: "/get_handler_perf",
            error: function (xhr) {
                if (xhr.status == 401) {
                    window.location.replace("/login");
                } else {
                    toastr.error("An error occured, please try again later");
                }
            },
        },
        columns: [
            {
                data: "name",
                name: "name",
                searchable: true,
            },
            {
                data: null,
                name: null,
                searchable: true,
                class: "text-center",
                render: function (data, type) {
                    if (data.percentage < 15) {
                        return '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    } else if (data.percentage > 15 && data.percentage <= 50) {
                        return '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    } else if (data.percentage > 50) {
                        return '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    }
                },
            },
        ],
        drawCallback: function (settings, json) {
            $(".tooltips").tooltip();
        },
    });

    // JavaScript code
    $.ajax({
        type: "GET",
        url: "/monthlyAnalytics",
        success: function (result) {
            console.log(result);

            let data = result.data;
            let label = result.label;

            // Define allMonths array
            let allMonths = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];

            // If data is not available for all months, initialize missing months with 0
            for (let i = 0; i < 12; i++) {
                if (!label.includes(allMonths[i])) {
                    label.splice(i, 0, allMonths[i]);
                    data.splice(i, 0, 0);
                }
            }

            // ApexCharts configuration
            var options = {
                series: [
                    {
                        name: "Patients",
                        data: data,
                    },
                ],
                chart: {
                    height: 350,
                    type: "bar",
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                        distributed: true,
                    },
                },
                xaxis: {
                    categories: label,
                    labels: {
                        style: {
                            fontSize: "12px",
                        },
                    },
                },
            };

            // Create ApexCharts instance
            var chart = new ApexCharts(
                document.querySelector("#patientChart"),
                options
            );

            // Render the chart
            chart.render();
        },
    });
});

function gotoMenu(href) {
    window.location.href = href;
}

// function displayChart(label,data){
//     const ctx = document.getElementById('patientChart');

//     new Chart(ctx, {
//         type: 'doughnut',
//         data: {
//         labels: label,
//         datasets: [{
//             label: '',
//             data: data,
//             borderWidth: 1,
//             backgroundColor: [
//                 'rgb(255, 99, 132)',
//                 'rgb(54, 162, 235)',
//                 'rgb(255, 205, 86)'
//               ]
//         }]
//         },
//     });
// }
