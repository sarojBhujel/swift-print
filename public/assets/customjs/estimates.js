$(document).ready(function () {
    getData();
    $("#customer_id").select2({
                    tags: true
                });
    $("#job_ids").select2({
                    tags: true
                });
});

function getData() {
    $("#datatables-reponsive").DataTable({
        processing: true,
        serverSide: true,
        ajax: "estimates",
        dom: "Blfrtip",
        buttons: [
            {
                extend: "csv",
                text: '<i class="fas fa-file-csv"></i>',
                titleAttr: "CSV",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: "excel",
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: "Excel",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
            {
                extend: "print",
                text: '<i class="fas fa-print"></i>',
                titleAttr: "Print",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                },
            },
        ],

        columns: [
            {
                data: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "client_name",
            },
            {
                data: "is_vat_included",
            },
            {
                data: "jobs_ids",
            },
            {
                data: "action",
            },
        ],
    });
}

$(document).on('click', "#addData", function (e) {
    e.preventDefault();
    $("#formModal").modal("show");
    $(".form").attr("id", "dataForm");
    // $(".includeUser").addClass("d-none");
    // $("#include_user_ids").prop("disabled", true);
    // $("#include_user_ids").val("").trigger("change");
    $("#dataForm")[0].reset();
    $("#btnSubmit").show();
    $("#btnUpdate").hide();
});

$(document).off("submit", "#dataForm", function () {});
$(document).on("submit", "#dataForm", function (e) {
    e.preventDefault();
    let dataurl = $("#dataForm").attr("action");
    let postdata = new FormData(this);
    // let is_holiday = $("#is_holiday").is(":checked") ? "Y" : "N";
    // postdata.append("is_holiday", is_holiday);
    var request = ajaxRequest(dataurl, postdata, "POST", true);
    request.done(function (res) {
        if (res.status === true) {
            showNotification(res.message, "success");
            $("#formModal").modal("hide");
            $("#dataForm")[0].reset();
            $("#datatables-reponsive").dataTable().fnClearTable();
            $("#datatables-reponsive").dataTable().fnDestroy();
            getData();
        } else {
            showNotification(res.message, "error");
        }
    });
});
$(document)
    .off("change", "#is_holiday")
    .on("change", "#is_holiday", function () {
        if ($(this).prop("checked")) {
            $("#include_user_ids").prop("disabled", false);
            $(".includeUser").removeClass("d-none");
        } else {
            $("#include_user_ids").prop("disabled", true);
            $(".includeUser").addClass("d-none");
        }
    });

$(document).off("click", ".editData", function () {});
$(document).on("click", ".editData", function (e) {
    e.preventDefault();
    $(".modal-title").html("Edit Project Module");
    let id = $(this).attr("data-pid");
    let dataurl = $(this).attr("data-url");
    var request = getRequest(dataurl);
    request.done(function (res) {
        if (res.status === true) {
            $("#btnSubmit").hide();
            $("#btnUpdate").show();
            $(".form").attr("id", "updatedataForm");
            $("#formModal").modal("show");
            $("#title").val(res.response.title);
            $("#start_date").val(res.response.start_date);
            $("#end_date").val(res.response.end_date);
            $("#start_time").val(res.response.start_time);
            if (res.response.is_holiday == "Y") {
                $("#is_holiday").prop("checked", true).trigger("change");
            } else {
                $("#is_holiday").prop("checked", false).trigger("change");
            }
            $("#include_user_ids")
                .val(res.response.include_user_ids)
                .trigger("change");

            $("#id").val(res.response.id);
        } else {
            showNotification(res.message, "error");
        }
    });
});

$(document).off("submit", "#updatedataForm", function () {});
$(document).on("submit", "#updatedataForm", function (e) {
    e.preventDefault();
    let id = $("#id").val();
    let dataurl = "events/" + id;
    let postdata = new FormData(this);
    postdata.append("_method", "PATCH");
    let is_holiday = $("#is_holiday").is(":checked") ? "Y" : "N";
    postdata.append("is_holiday", is_holiday);
    var request = ajaxRequest(dataurl, postdata, "POST", true);
    request.done(function (res) {
        if (res.status === true) {
            showNotification(res.message, "success");
            $("#formModal").modal("hide");
            $("#updatedataForm")[0].reset();
            $("#datatables-reponsive").dataTable().fnClearTable();
            $("#datatables-reponsive").dataTable().fnDestroy();
            getData();
        } else {
            showNotification(res.message, "error");
        }
    });
});

$(document).off("click", ".deleteData", function () {});
$(document).on("click", ".deleteData", function (e) {
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            let currbtn = $(this);
            let dataurl = currbtn.attr("data-url");
            var request = ajaxRequest(dataurl, {}, "DELETE");
            request.done(function (res) {
                if (res.status === true) {
                    //   currbtn.closest("tr").remove();
                    showNotification(res.message, "success");
                    $("#datatables-reponsive").dataTable().fnClearTable();
                    $("#datatables-reponsive").dataTable().fnDestroy();
                    getData();
                } else {
                    showNotification(res.message, "error");
                }
            });
        } else {
            swal("Your Data Is Safe!");
        }
    });

    function customers(){
                            $.ajax({
                        url: '/customer-list', // Replace with your server endpoint URL
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var select = $('#customer_id');

                            // Iterate over the response data and append options to the select element
                            $.each(response, function(index, option) {
                                select.append($('<option></option>').val(option
                                    .id).html(option.name));
                            });
                        },
                    });
    }
});
