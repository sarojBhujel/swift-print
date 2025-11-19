@extends('backend.layouts.master')
@section('title', '| Jobs')
@push('styles')
@endpush
@section('main-content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">

                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Estimates</h4>
                            <div class="box_right d-flex lms_block">

                                <button type="button" class="btn btn-primary" id="createNewEstimate">
                                    Add
                                </button>
                            </div>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table " id='empTable'>
                                <thead>
                                    <tr class="mt-1">
                                        <th scope="col">S.N.</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Vat Type</th>
                                        <th scope="col">jobs</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="ajaxModel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formModal" name="productForm" class="form-horizontal form">
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="col-sm-12 control-label">Client</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="client_id" multiple id="client_id">
                                            @foreach ($clients as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="col-sm-12 control-label">Client</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="job_ids[]" multiple id="job_ids">
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id }}" data-id="{{ $job->id }}" data-client-id="{{$job->customer_id}}">
                                                    {{ $job->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="col-sm-12 control-label">Default Unit</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="unit" name="unit"
                                            placeholder="Enter Default Unit" value="" maxlength="250" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity" class="col-sm-12 control-label">Default Quantity</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            placeholder="Enter Quantity" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Default Rate</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                    class="fas fa-close"></i>
                                Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSubmit" value="create">Save Job
                            </button>
                            <button type="submit" id="btnUpdate" class="btn btn-success"><i class="fas fa-save"></i>
                                Update</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endpush
@push('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            getData();
            $("#include_user_ids").select2({
                placeholder: "Select users",
                dropdownParent: $("#formModal"),
            });
        });

        function getData() {
            $("#datatables-reponsive").DataTable({
                processing: true,
                serverSide: true,
                ajax: "estimates",
                dom: "Blfrtip",
                buttons: [{
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

                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "client_name"
                    },
                    {
                        data: "is_vat_included"
                    },
                    {
                        data: "jobs_ids"
                    },
                    {
                        data: "action"
                    },
                ],
            });
        }

        $(document).off("click", "#addData", function() {});
        $(document).on("click", "#addData", function(e) {
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

        $(document).off("submit", "#dataForm", function() {});
        $(document).on("submit", "#dataForm", function(e) {
            e.preventDefault();
            let dataurl = $("#dataForm").attr("action");
            let postdata = new FormData(this);
            // let is_holiday = $("#is_holiday").is(":checked") ? "Y" : "N";
            // postdata.append("is_holiday", is_holiday);
            var request = ajaxRequest(dataurl, postdata, "POST", true);
            request.done(function(res) {
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
        $(document).off("change", "#is_holiday").on("change", "#is_holiday", function() {
            if ($(this).prop("checked")) {
                $("#include_user_ids").prop("disabled", false);
                $(".includeUser").removeClass("d-none");
            } else {
                $("#include_user_ids").prop("disabled", true);
                $(".includeUser").addClass("d-none");
            }
        })

        $(document).off("click", ".editData", function() {});
        $(document).on("click", ".editData", function(e) {
            e.preventDefault();
            $(".modal-title").html("Edit Project Module");
            let id = $(this).attr("data-pid");
            let dataurl = $(this).attr("data-url");
            var request = getRequest(dataurl);
            request.done(function(res) {
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
                    $("#include_user_ids").val(res.response.include_user_ids).trigger("change");

                    $("#id").val(res.response.id);
                } else {
                    showNotification(res.message, "error");
                }
            });
        });

        $(document).off("submit", "#updatedataForm", function() {});
        $(document).on("submit", "#updatedataForm", function(e) {
            e.preventDefault();
            let id = $("#id").val();
            let dataurl = "events/" + id;
            let postdata = new FormData(this);
            postdata.append("_method", "PATCH");
            let is_holiday = $("#is_holiday").is(":checked") ? "Y" : "N";
            postdata.append("is_holiday", is_holiday);
            var request = ajaxRequest(dataurl, postdata, "POST", true);
            request.done(function(res) {
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

        $(document).off("click", ".deleteData", function() {});
        $(document).on("click", ".deleteData", function(e) {
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
                    request.done(function(res) {
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
@endpush
