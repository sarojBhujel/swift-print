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
    console.log("called");
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
            // {
            //     extend: "print",
            //     text: '<i class="fas fa-print"></i>',
            //     titleAttr: "Print",
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4],
            //     },
            // },
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
        "initComplete": function(settings, json) {
                  customers();
        }
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
    // initialize particulars area with 6 default rows
    initParticularsDefaults();
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

// ---------- Particulars handling ----------

// Append default 6 rows when modal opens
function initParticularsDefaults(){
    var $wrap = $("#particular_div");
    $wrap.empty();
    // header row
    var header = '<div class="row mb-2 particular-row header-row">'
        + '<div class="col-md-6"><strong>Particular</strong></div>'
        + '<div class="col-md-2"><strong>Rate</strong></div>'
        + '<div class="col-md-2"><strong>Qty</strong></div>'
        + '<div class="col-md-2 text-end"><strong>Amount</strong></div>'
        + '</div>';
    $wrap.append(header);
    // use explicit array of 6 defaults (no loop)
    var defaults = ['particular 1','particular 2','particular 3','particular 4','particular 5','particular 6'];
    var r1 = createParticularRow(1, true, defaults[0]); $wrap.append(r1);
    var r2 = createParticularRow(2, true, defaults[1]); $wrap.append(r2);
    var r3 = createParticularRow(3, true, defaults[2]); $wrap.append(r3);
    var r4 = createParticularRow(4, true, defaults[3]); $wrap.append(r4);
    var r5 = createParticularRow(5, true, defaults[4]); $wrap.append(r5);
    var r6 = createParticularRow(6, true, defaults[5]); $wrap.append(r6);
    // controls: add new particular button
    var controls = '<div class="row mt-3"><div class="col-12">'
        + '<button type="button" id="addParticularBtn" class="btn btn-sm btn-secondary">Add Particular</button>'
        + '</div></div>';
    $wrap.append(controls);
}

// create a particular row. isDefault => not removable
function createParticularRow(id, isDefault, particularText){
    var idx = 'p_' + Date.now() + '_' + Math.floor(Math.random()*1000);
    var removable = isDefault ? '' : '<button type="button" class="btn btn-danger btn-sm remove-particular" data-row="'+idx+'">Remove</button>';
    var html = '<div class="row particular-row" data-rowid="'+idx+'" style="margin-top:8px;">'
        + '<div class="col-md-6">'
            + '<input type="text" name="particular[]" class="form-control particular-input" placeholder="Particular" value="'+(particularText? particularText : '')+'">'
        + '</div>'
        + '<div class="col-md-2">'
            + '<input type="number" name="rate[]" class="form-control particular-rate" step="0.01" min="0" value="0">'
        + '</div>'
        + '<div class="col-md-2">'
            + '<input type="number" name="qty[]" class="form-control particular-qty" step="1" min="0" value="1">'
        + '</div>'
        + '<div class="col-md-2 text-end">'
            + '<div class="d-flex justify-content-end align-items-center">'
                + '<input type="text" name="amount[]" class="form-control particular-amount text-end" value="0.00" readonly style="width:120px; margin-right:8px;">'
                + removable
            + '</div>'
        + '</div>'
    + '</div>';
    return html;
}

// function to append a new particular row (called externally)
function particularFunction(){
    var $wrap = $("#particular_div");
    // insert before controls (which is last child)
    var $controls = $wrap.find('#addParticularBtn').closest('.row');
    var $row = $(createParticularRow(null, false));
    if($controls.length){
        $controls.before($row);
    } else {
        $wrap.append($row);
    }
}

// wire add particular button
$(document).off('click', '#addParticularBtn').on('click', '#addParticularBtn', function(e){
    e.preventDefault();
    particularFunction();
});

// remove particular row
$(document).off('click', '.remove-particular').on('click', '.remove-particular', function(e){
    e.preventDefault();
    var rowid = $(this).data('row');
    $(this).closest('.particular-row').remove();
    calculateTotals();
});

// recalc amount on rate or qty change
$(document).off('input', '.particular-rate, .particular-qty').on('input', '.particular-rate, .particular-qty', function(){
    var $row = $(this).closest('.particular-row');
    var rate = parseFloat($row.find('.particular-rate').val()) || 0;
    var qty = parseFloat($row.find('.particular-qty').val()) || 0;
    var amount = rate * qty;
    $row.find('.particular-amount').val(amount.toFixed(2));
    calculateTotals();
});

function calculateTotals(){
    var total = 0;
    $("#particular_div .particular-row").each(function(){
        // skip header-row and controls
        if($(this).hasClass('header-row')) return;
        if($(this).find('#addParticularBtn').length) return;
        var amt = parseFloat($(this).find('.particular-amount').val()) || 0;
        total += amt;
    });
    // you can expose total somewhere if needed
    // console.log('Total particulars amount:', total.toFixed(2));
}
