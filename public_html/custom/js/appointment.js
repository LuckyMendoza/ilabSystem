$(document).ready(function () {
    // Set the placeholder text

    const user = $("#user_type").val();
    var table = $("#services_table").DataTable({
        processing: true,
        serverSide: true,
        responsive: false,
        autoWidth: false,
        buttons: false,
        order: [[0, "asc"]],
        ajax: {
            url: "/scheduleList",
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
                data: "patient",
                name: "patient",
                searchable: true,
                defaultContent: "",
            },
            {
                data: "service",
                name: "services",
                searchable: true,
                defaultContent: "",
            },
            {
                data: "price",
                name: "price",
                searchable: true,
                defaultContent: "",
            },
            {
                data: "schedule_date",
                name: "schedule_date",
                searchable: true,
                defaultContent: "",
            },
            {
                data: "time_from",
                name: "time_from",
                searchable: true,
                render: function (data, type) {
                    if (type === "sort") {
                        return data;
                    } else {
                        return data === "00:00:00"
                            ? "00:00:00"
                            : moment(data, "HH:mm:ss").format("h:mm A");
                    }
                },
                defaultContent: "",
            },
            {
                data: "time_to",
                name: "time_to",
                searchable: true,
                render: function (data, type) {
                    if (type === "sort") {
                        return data;
                    } else {
                        return data === "00:00:00"
                            ? "00:00:00"
                            : moment(data, "HH:mm:ss").format("h:mm A");
                    }
                },
                defaultContent: "",
            },
            {
                data: "doctor_name",
                name: "doctor_name",
                searchable: true,
                defaultContent: "",
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                class: 'text-right',
                render: function(data, type, row) {
                    console.log(data.status);
                    if (data.status == '0') {
                        return 'PENDING';
                    }else if (data.status == '1') {
                        return 'APPROVED';
                    }else if (data.status == '2'){
                        return 'DISAPPROVED';
                    } else if (data.status == '3') {
                        return 'Done Appointment / For Result Releasing';
                    } else if (data.status == '4') {
                        let usertype = null;
                        if (user == 'patient') 
                        {
                            usertype = 'Download Result';
                        }else{
                            usertype = 'For Accounting';
                        }
                        return usertype;
                    } else if (data.status == '5') {
                        return 'Done Transaction';
                    } else {
                        return "Unknown Status";
                    }
                },
                defaultContent: "",
            },
            {
                data: "created_at",
                name: "created_at",
                searchable: true,
                class: "v-middle",
                render: function (data, type) {
                    return type === "sort"
                        ? data
                        : moment(data).isValid()
                        ? moment(data).format("ll")
                        : "---";
                },
                defaultContent: "",
            },
			{
            data: null,
            orderable: false,
            searchable: false,
            class: 'text-right',
            render: function(data, type, row) {

                    if (user == 'patient') {
                        console.log(data)
                        if (data.status == 0) {
                            return '<button type="button"  data-id=' + data.id + ' data-doctor="' + data.doctor
                                + '" data-service="' + data.service_id
                                + '" data-schedule_date="' + data.schedule_date
                                + '" data-time_from="' + data.time_from
                                + '" data-time_to="' + data.time_to
                                + '"  data-bs-toggle="modal" data-bs-target="#modal_add" class="edit btn btn-sm btn-secondary"><i class="fa fa-pencil-alt"></i></button>';
                        }else if (data.status == 1) {
                            return '<button type="button"  data-id=' + data.id
                                + '" data-patient="' + data.patient
                                + '" data-patient_id="' + data.user_id
                                + '" data-schedule_date="' + data.schedule_date
                                + '"  data-bs-toggle="modal" data-bs-target="#modal_pending" id="pending-prescription" class="btn btn-sm btn-secondary"><i class="fa fa-clock"></i></button>';
                        }
                        else if (data.status == 2) {
                            return '❌';
                        }else if (data.status == 3) {
                            return 'Waiting';
                        }  else if (data.status == 4) {
                            return '<button type="button"  data-id=' + data.id
                                + '" data-service="' + data.service_id
                                + '" data-patient="' + data.patient
                                + '" data-patient_id="' + data.user_id
                                + '" data-schedule_date="' + data.schedule_date
                                + '"  data-bs-toggle="modal" data-bs-target="#modal_download" id="download-prescription" class="btn btn-sm btn-secondary"><i class="fa fa-download"></i></button>';
                        }
                    } else if (user == "doctor") {
                        if (data.status == 0) {
                            return (
                                '<button type="button"  data-id=' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-schedule_date="' +
                                data.schedule_date +
                                '"  data-bs-toggle="modal" data-bs-target="#modal_approve" id="approve" class="btn btn-sm btn-secondary"><i class="fa fa-thumbs-up"></i></button>'
                            );
                        } else if (data.status == 1) {
                            return (
                                '<button type="button" data-id="' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-service="' +
                                data.service_id +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#change-status-to-done-appointment-modal" id="prescription" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>'
                            );
                        } else if (data.status == 3) {
                            console.log('dito',data);
                            return (
                                '<button type="button" data-id="' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-service="' +
                                data.service_id +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#modal_prescription" id="prescription_pres" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>'
                            );
                        } else if (data.status == 4) {
                            return (
                                '<button type="button" data-id="' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-service="' +
                                data.service_id +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#change-status-to-done-transaction-modal" id="prescription" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>'
                            );
                        } else {
                            return "<span>No available</span>";
                        }
                    } else if (user == "admin") {
                        if (data.status == 0) {
                            return (
                                '<button type="button"  data-id=' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-schedule_date="' +
                                data.schedule_date +
                                '"  data-bs-toggle="modal" data-bs-target="#modal_approve" id="approve" class="btn btn-sm btn-secondary"><i class="fa fa-thumbs-up"></i></button>'
                            );
                        } else if (data.status == 1) {
                            return (
                                '<button type="button" data-id="' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-service="' +
                                data.service_id +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#change-status-to-done-appointment-modal" id="prescription" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>'
                            );
                        } else if (data.status == 3) {
                            console.log('dito',data);
                            return '<button type="button" data-id="' + data.id +
                                '" data-patient="' + data.patient +
                                '" data-service="' + data.service_id +
                                '" data-patient_id="' + data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#modal_prescription" id="prescription_pres" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>';
                        } else if (data.status == 4) {
                            return (
                                '<button type="button" data-id="' +
                                data.id +
                                '" data-patient="' +
                                data.patient +
                                '" data-service="' +
                                data.service_id +
                                '" data-patient_id="' +
                                data.user_id +
                                '" data-bs-toggle="modal" data-bs-target="#change-status-to-done-transaction-modal" id="prescription" class="btn btn-sm btn-secondary"><i class="fa fa-prescription"></i></button>'
                            );
                        } else {
                            return "<span>No available</span>";
                        }
                    } else {
                        return "<span>No available</span>";
                    }
                },
                defaultContent: "",
            },
        ],
        drawCallback: function (settings, json) {
            $(".tooltips").tooltip();
        },
    });

    $("#new").on("click", function (e) {
        $("#data_id").val(0);
        $("#service").val("");
        $("#doctor").val("");
        $("#schedule_date").val("");
    });

    $("#save_btn").on("click", function (e) {
        e.preventDefault();

        var btn = $(this);
        var form = $(this).closest("form");

        form.validate({
            rules: {
                service_name: {
                    required: true,
                },
                price: {
                    required: true,
                },
            },
        });

        if (!form.valid()) {
            return;
        }

        btn.attr("disabled", true);
        var data = new FormData(form[0]);

        //$('#msg').css('display', 'block');
        let url =
            $("#data_id").val() == 0
                ? "/createAppointment"
                : "/updateAppointment";

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#msg").empty();
            },
           

            success: function (result) {
                let swalConfig = {}; // Configure SweetAlert2 options

                if (result === "warning_past_date") {
                    swalConfig = {
                        icon: "warning",
                        title: "You cannot book an appointment in the past. Please choose a future date.",
                    };
                } else if (result === "warning") {
                    swalConfig = {
                        icon: "warning",
                        title: "Someone has already booked an appointment at the same time. Please choose a different time.",
                    };
                } else if (result === "warning_limit") {
                    swalConfig = {
                        icon: "warning",
                        title: "Doctor appointment limit reached. Please wait for availability or try another time slot.",
                    };
                } else if (result === "success") {
                    swalConfig = {
                        icon: "success",
                        title: "Your appointment has been received and is under review. Please wait for confirmation.",
                    };
                } else if (result === "update") {
                    swalConfig = {
                        icon: "success",
                        title: "Appointment updated successfully!",
                    };
                } else {
                    swalConfig = {
                        icon: "error",
                        title: "Error: " + result,
                    };
                }

                // Display SweetAlert2 with configured options
                Swal.fire(swalConfig).then(() => {
                    // This block will be executed after the user clicks the "OK" button
                    btn.attr("disabled", false);
                    window.location.reload();
                });
            },
        });
    });

    // Edit - with universal route
    $('table tbody').on('click', '.edit', function() {
        console.log($(this).data())
        $('#data_id').val($(this).data('id'));
        $('#service').val($(this).data('service'));
        $('#doctor').val($(this).data('doctor'));
        $('#schedule_date').val($(this).data('schedule_date'));
        $('#time_from').val($(this).data('time_from'));
        $('#time_to').val($(this).data('time_to'));
    });

    $('table tbody').on('click', '#approve', function() {
        $('#data_id').val($(this).data('id'));
        $('#patient_id').val($(this).data('patient_id'));
        $('#client_info').html('patient ' + $(this).data('patient') + ' on ' + $(this).data('schedule_date'));
    });

    $('#approve_btn').click(function() {
        var btn = $(this);

        $.ajax({
            type: 'GET',
            url: '/approveAppointment/' + $('#data_id').val() + '/approved/' + $('#patient_id').val(),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#msg').empty();
            },
            success: function(result) {
                let swalConfig = {}; // Configure SweetAlert2 options

                if (result === 'success') {
                    swalConfig = {
                        icon: 'success',
                        title: 'Appointment approved successfully!',
                    };
                } else {
                    swalConfig = {
                        icon: 'error',
                        title: 'Error: ' + result,
                    };
                }

                // Display SweetAlert2 with configured options
                Swal.fire(swalConfig).then(() => {
                    // This block will be executed after the user clicks the "OK" button
                    btn.attr('disabled', false);
                    window.location.reload();
                });
            }
        });
    });

    $('#done_btn').click(function() {
        var btn = $(this);

        $.ajax({
            type: 'GET',
            url: '/doneAppointment/' + $('#download_data_id_stat').val() + '/3/' + $('#download_patient_id_stat').val(),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#msg').empty();
            },
            success: function(result) {
                let swalConfig = {};
                if (result === 'success') {
                    swalConfig = {
                        icon: 'success',
                        title: 'Patient medical result is release!',
                    };
                } else {
                    swalConfig = {
                        icon: 'error',
                        title: 'Error: ' + result,
                    };
                }
                Swal.fire(swalConfig).then(() => {
                    btn.attr('disabled', false);
                    window.location.reload();
                });
            }
        });
    });
    $("#cancel_btn").click(function () {
        $.ajax({
            type: "GET",
            url:
                "/approveAppointment/" +
                $("#data_id").val() +
                "/approved/" +
                $("#patient_id").val(),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#msg").empty();
            },
            success: function (result) {
                let swalConfig = {}; // Configure SweetAlert2 options

                if (result === "success") {
                    swalConfig = {
                        icon: "success",
                        title: "Appointment approved successfully!",
                    };
                } else {
                    swalConfig = {
                        icon: "error",
                        title: "Error: " + result,
                    };
                }

                // Display SweetAlert2 with configured options
                Swal.fire(swalConfig).then(() => {
                    // This block will be executed after the user clicks the "OK" button
                    btn.attr("disabled", false);
                    window.location.reload();
                });
            },
        });
    });
    
    //Save Prescription
    $('table tbody').on('click', '#prescription', function() {
        console.log('dito');
        $('#download_data_id_stat').val($(this).data('id'));
        $('#download_patient_id_stat').val($(this).data('patient_id'));
        $('#service').val($(this).data('service'));
    });
    $('table tbody').on('click', '#prescription_pres', function() {
        console.log('dito_pres');
        if($(this).data('service') == 1)
        {
            $('#urinalDiv').show();
            $('#cbcDiv').hide();
        }
        if($(this).data('service') == 2)
        {
            $('#cbcDiv').show();
            $('#urinalDiv').hide();
        }
        $('#patient_id_pres').val($(this).data('patient_id'));
        $('#data_id_pres').val($(this).data('id'));
        $('#service_pres').val($(this).data('service'));
    });
    //lappy
    $('#prescribe_btn').on('click', function() {
        let results = null;
        if($('#service_pres').val() == 1)
        {
            //urine
            results = `{ 
                    "sugar": "${$('#sugar').val()}",
                     "blood": "${$('#blood').val()}", 
                     "ketones": "${$('#ketones').val()}", 
                     "phospates": "${$('#phospates').val()}"
                    }`;
        }
        if($('#service_pres').val() == 2)
        {
            //cbc
            results = `{ 
                "glucose": "${$('#glucose').val()}",
                 "choles": "${$('#choles').val()}", 
                 "bua": "${$('#bua').val()}", 
                 "bun": "${$('#bun').val()}",
                 "sgot": "${$('#sgot').val()}",
                 "cal": "${$('#cal').val()}",
                 "chl": "${$('#chl').val()}",
                }`;
        }
        var prescriptionData = {
            id: $('#patient_id_pres').val(),
            result: results,
            service: $('#service_pres').val(),
            appointment_id: $('#data_id_pres').val()
        };
        console.log(results);
        $.ajax({
            type: "POST",
            url: "prescription",
            data: prescriptionData,
            beforeSend: function () {
                $("#msg").empty();
            },
            success: function (result) {
                console.log(result,'dsad');
                if (result != "success") {
                    alert(result);
                } else {
                    alert("save");
                    window.location.reload();
                }
            },
        });
    });

    //Download Prescription
    $('table tbody').on('click', '#download-prescription', function() {
        $('#download_data_id').val($(this).data('id'));
        $('#download_patient_id').val($(this).data('patient_id'));
        $('#download_data_service').val($(this).data('service'));
        console.log('dsadsa');
    });
    $('#download-prescription').click(()=>{
        console.log('1111');
        $('#download-prescription-close').trigger('click');
    })
    $('table tbody').on('click', '#pending-prescription', function() {
        $('#download_data_id').val($(this).data('id'));
        $('#download_patient_id').val($(this).data('patient_id'));
    });
    $('#confirm_download_btn').on('click', function() {
        // var prescriptionData = {
        //     id: $('#data_id').val(),
        //     patientId: $('#patient_id').val(),
        // };

        var appointmentId = $("#data_id").val();
        console.log(appointmentId);

        $.ajax({
            type: "POST",
            url: "/update-appointment-status",
            data: {
                data_id: appointmentId,
                status: "3",
            },
            success: function (response) {
                if (response.success) {
                    toastr.success("Appointment status updated successfully!");

                    window.location.reload();
                } else {
                    toastr.error("Failed to update appointment status.");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                toastr.error(
                    "An error occurred while updating appointment status."
                );
            },
        });
    });
});
