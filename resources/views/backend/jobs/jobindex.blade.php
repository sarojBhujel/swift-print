{{-- @extends('backend.layouts.master')


@section('main-content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-primary btn-rounded btn-fw" href="javascript:void(0)"
                    id="createNewCustomer"><i class="mdi mdi-plus"></i> Add</button>
            </div>
            <div class="col-12">

                <table id='empTable' class="table table-striped table-bordered mt-1" width="100%">
                    <thead>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModelView" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title view_name" id=""> Job Details - </h4>
                </div>
                <div class="modal-body">
                   
                </div>
            </div>
        </div>
    </div>
@endsection --}}
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
                            <h4>Jobs Table</h4>
                            <div class="box_right d-flex lms_block">

                                <button type="button" class="btn btn-primary" id="createNewCustomer">
                                    Add
                                </button>
                            </div>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table " id='empTable'>
                                <thead>
                                    <tr class="mt-1">
                                        <th scope="col">S.N.</th>
                                        <th scope="col">Job Number</th>
                                        <th scope="col">Job Date</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Paper</th>
                                        <th scope="col">Equipment</th>
                                        <th scope="col">Print Color</th>
                                        <th scope="col">Print Type</th>
                                        <th scope="col">Plate Set</th>
                                        <th scope="col">Plate Date</th>
                                        <th scope="col">Plate Size</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Numbering</th>
                                        <th scope="col">Laminatin</th>
                                        <th scope="col">Binding</th>
                                        <th scope="col">Paper Weight</th>
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
                    <form id="productForm" name="productForm" class="form-horizontal ">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Job No.</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="job_number" name="job_number"
                                            placeholder="Enter Job Number" value="" maxlength="250" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Client Name</label>
                                    <div class="col-sm-12">
                                        <select class=" js-example-basic-single" aria-label="Default select example"
                                            name="customer_id" id="customer_id" required=""
                                            style="width:100% ;height: 200% !important;">
                                            <option selected value="">Select Cliensadfsdt</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Job Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="date" name="date"
                                            placeholder="Enter Job Date" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Delivery Date</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="delivery_date"
                                            name="delivery_date" placeholder="Enter Delivery Date" value=""
                                            maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="delivery_option" class="col-sm-12 control-label">Job Discription</label>
                                    <div class="col-sm-12 d-flex align-items-center gap-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="delivery_today"
                                                name="inner" value="inner">
                                            <label class="form-check-label" for="delivery_today">Inner</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="delivery_tomorrow"
                                                name="outer" value="outer">
                                            <label class="form-check-label" for="delivery_tomorrow">Outer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Job Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Quantity</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="quantity" name="quantity"
                                            placeholder="Enter Quantity" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="page_type" class="col-sm-12 control-label">Page Type</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="page_type"
                                            id="page_type">
                                            <option selected value="">Select Page Type</option>
                                            <option value="bw">BW</option>
                                            <option value="cmyk">CMYK</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_page" class="col-sm-12 control-label">Total Page</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="total_page" name="total_page"
                                            placeholder="Enter Total Page" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size" class="col-sm-12 control-label">Size</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="size" name="size"
                                            placeholder="Enter Size" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_plate" class="col-sm-12 control-label">Total Plate</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="total_plate" name="total_plate"
                                            placeholder="Enter Total Plate" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="plate_by" class="col-sm-12 control-label">Plate By</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="plate_by"
                                            id="plate_by">
                                            <option selected value="">Select Plate By</option>
                                            <option value="swift">Swift</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="plate_from" class="col-sm-12 control-label"> Plate From</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="plate_from" name="plate_from"
                                            placeholder="Enter Plate From" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="plate_size" class="col-sm-12 control-label">Plate Size</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="plate_size" name="plate_size"
                                            placeholder="Enter Plate Size" value="" maxlength="250">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="machine_id" class="col-sm-12 control-label">Machine</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="machine_id"
                                            id="machine_id">
                                            <option selected value="">Select Printing Machine</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paper_by" class="col-sm-12 control-label">Plate By</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="paper_by"
                                            id="paper_by">
                                            <option selected value="">Select Plate By</option>
                                            <option value="swift">Swift</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- for paper details  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lamination_thermal" class="col-sm-12 control-label">Lamination Thermal</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="lamination_thermal"
                                            id="lamination_thermal">
                                            <option selected value="">Select Plate By</option>
                                            <option value="matt">matt</option>
                                            <option value="gloss">gloss</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lamination_normal" class="col-sm-12 control-label">Lamination Normal</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="lamination_normal"
                                            id="lamination_normal">
                                            <option selected value="">Select Plate By</option>
                                            <option value="matt">matt</option>
                                            <option value="gloss">gloss</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Quotaion</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="image" name="image"
                                            placeholder="Enter Quotaion" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 oldImage" style="display: none;">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Old Quotaion</label>
                                    <div class="col-sm-12">
                                        <img src="" alt="" id="editImage" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Remarks</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="5" id="note" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="name" class="col-sm-12 control-label">Customers Supplied</label>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                    name="is_customer_supplied_paper" id="is_customer_supplied_paper"
                                                    value="1">Paper

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="customer_supplied_paper"
                                                name="customer_supplied_paper" maxlength="250">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                    name="is_customer_supplied_ctp" id="is_customer_supplied_ctp"
                                                    value="1">CTP
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="customer_supplied_ctp"
                                                name="customer_supplied_ctp" placeholder="" maxlength="250"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="office"
                                                    id="office">Office
                                            </label>

                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="market"
                                                    id="market">Market
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 offset-md-1">

                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="billing" id="billing"
                                            value="1">Billing

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Job
                            </button>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Initialize
            var table = $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,

                ajax: "{{ route('getDataTableData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'job_number',
                        name: 'job_number',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'customer_name',
                        orderable: true,
                        searchable: true,
                    },



                    {
                        data: 'name',
                        orderable: true,
                        searchable: true
                    },


                    {
                        data: 'paper_id',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'eqipment_id',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'print_color',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'print_type',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'plate_set',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'plate_date',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'paper_size',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'quantity',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'numbering',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'lamination',
                        orderable: true,
                        searchable: true
                    },

                    {
                        data: 'binding',
                        orderable: true,
                        searchable: true
                    },

                    // {
                    //     data:'is_customer_supplied_paper'
                    // },

                    // {
                    //     data:'customer_supplied_paper'
                    // },

                    // {
                    //     data:'is_customer_supplied_ctp'
                    // },

                    // {
                    //     data:'market'
                    // },

                    // {
                    //     data:'office'
                    // },

                    // {
                    //     data:'note'
                    // },

                    {
                        data: 'paper_weight',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                    }
                }],
                "initComplete": function(settings, json) {
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
                    $.ajax({
                        url: '/papers-list', // Replace with your server endpoint URL
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var select = $('#paper_id');

                            // Iterate over the response data and append options to the select element
                            $.each(response, function(index, option) {
                                select.append($('<option></option>').val(option
                                    .id).html(option.name));
                            });
                        },
                    });
                    $.ajax({
                        url: '/equipment-list', // Replace with your server endpoint URL
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var select = $('#machine_id');

                            // Iterate over the response data and append options to the select element
                            $.each(response, function(index, option) {
                                select.append($('<option></option>').val(option
                                    .id).html(option.name));
                            });
                        },
                    });
                }
            });

            //add modal
            $('#createNewCustomer').click(function() {
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Job");
                $('#ajaxModel').modal('show');
                $(".oldImage").hide();

            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                console.log($(this).data('id'), product_id);
                $('#saveBtn').html('Edit');
                $(".oldImage").show();
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('jobs') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Job");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#customer_id').val(data.customer_id);
                    $('#paper_id').val(data.paper_id);
                    $('#eqipment_id').val(data.eqipment_id);
                    $('#print_color').val(data.print_color);
                    $('#print_type').val(data.print_type);
                    $('#plate_set').val(data.plate_set);
                    $('#plate_date').val(data.plate_date);
                    $('#paper_size').val(data.paper_size);
                    $('#quantity').val(data.quantity);
                    $('#numbering').val(data.numbering);
                    $('#lamination').val(data.lamination);
                    $('#binding').val(data.binding);
                    $('#job_number').val(data.job_number);
                    $('#date').val(data.date);
                    $('#is_customer_supplied_paper').val(data.is_customer_supplied_paper);
                    if (data.is_customer_supplied_paper === true) {
                        $("#is_customer_supplied_paper").prop("checked", true);
                        $('#customer_supplied_paper').show()
                    } else {
                        $("#is_customer_supplied_paper").prop("checked", false);
                        $('#customer_supplied_paper').hide()
                    }
                    $('#customer_supplied_paper').val(data.customer_supplied_paper);
                    $('#is_customer_supplied_ctp').val(data.is_customer_supplied_ctp);
                    if (data.is_customer_supplied_ctp === true) {
                        $("#is_customer_supplied_ctp").prop("checked", true);
                        $('#customer_supplied_ctp').show()

                    } else {
                        $("#is_customer_supplied_ctp").prop("checked", false);
                        $('#customer_supplied_ctp').hide()
                    }
                    $('#customer_supplied_ctp').val(data.customer_supplied_ctp);
                    $('#market').val(data.market);
                    if (data.market === true) {
                        $("#market").prop("checked", true);


                    } else {
                        $("#market").prop("checked", false);
                    }
                    $('#office').val(data.office);
                    if (data.office === true) {
                        console.log('yes');
                        $("#office").prop("checked", true);

                    } else {
                        $("#office").prop("checked", false);
                    }
                    $('#billing').val(data.billing);
                    if (data.billing === true) {
                        console.log('yes');
                        $("#billing").prop("checked", true);

                    } else {
                        $("#billing").prop("checked", false);
                    }
                    $('#note').val(data.note);
                    $('#job_number').val(data.job_number);
                    $('#paper_weight').val(data.paper_weight);
                    $("#image").prop('required', false);
                    $("#editImage").attr("src", data.image);

                    // $("#customer_id").select2('data', { id:data.customer_id, text: "saroj bhujel"});
                    // $("#customer_id").select2("val", data.customer_id);
                    // $('[name=customer_id]').val(data.customer_id);
                    $("#customer_id").select2({
                        tags: true
                    });
                })
            });
            $('body').on('click', '.viewProduct', function() {
                var product_id = $(this).data('id');
                $(".oldImage").show();
                $.get("{{ url('jobs') }}" + '/' + product_id + '/edit', function(data) {

                    $('#ajaxModelView').modal('show');
                    $('#product_id').val(data.id);
                    $('#view_name').html(data.name);
                    $('#view_customer_id').html(data.customer_name);
                    $('#view_paper_id').html(data.paper_id);
                    $('#view_eqipment_id').html(data.eqipment_id);
                    $('#view_print_color').html(data.print_color);
                    $('#view_print_type').html(data.print_type);
                    $('#view_plate_set').html(data.plate_set);
                    $('#view_plate_date').html(data.plate_date);
                    $('#view_paper_size').html(data.paper_size);
                    $('#view_quantity').html(data.quantity);
                    $('#view_numbering').html(data.numbering);
                    $('#view_lamination').html(data.lamination);
                    $('#view_binding').html(data.binding);
                    $('#view_job_number').html(data.job_number);
                    $('#view_date').html(data.date);
                    $('#view_is_customer_supplied_paper').html(data.is_customer_supplied_paper);
                    $('#view_customer_supplied_paper').html(data.customer_supplied_paper);
                    $('#view_is_customer_supplied_ctp').html(data.is_customer_supplied_ctp);
                    $('#view_customer_supplied_ctp').html(data.customer_supplied_ctp);
                    if (data.is_customer_supplied_paper === true) {
                        $("#view_is_customer_supplied_paper").prop("checked", true);
                        $('#view_customer_supplied_paper').show()
                    } else {
                        $("#view_is_customer_supplied_paper").prop("checked", false);
                        $('#view_customer_supplied_paper').hide()
                    }
                    if (data.is_customer_supplied_ctp === true) {
                        $("#view_is_customer_supplied_ctp").prop("checked", true);
                        $('#view_customer_supplied_ctp').show()

                    } else {
                        $("#view_is_customer_supplied_ctp").prop("checked", false);
                        $('#view_customer_supplied_ctp').hide()
                    }
                    $('#customer_supplied_ctp').val(data.customer_supplied_ctp);
                    if (data.market === true) {
                        $("#view_market").prop("checked", true);


                    } else {
                        $("#view_market").prop("checked", false);
                    }
                    if (data.office === true) {
                        console.log('yes');
                        $("#view_office").prop("checked", true);

                    } else {
                        $("#view_office").prop("checked", false);
                    }
                    $('#view_market').html(data.market);
                    $('#view_office').html(data.office);
                    $('#view_note').html(data.note);
                    $('#view_paper_weight').html(data.paper_weight);
                    $("#view_image").attr("src", data.image);
                    $('#view_billing').val(data.billing);
                    $("#viewImage").attr("href", data.image);
                    if (data.billing === true) {
                        console.log('yes');
                        $("#view_billing").prop("checked", true);

                    } else {
                        $("#view_billing").prop("checked", false);
                    }
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation = $("#productForm").validate();
                // console.log(formvalidation['a'],formvalidation['errorList'],'list');
                if ($("#productForm").valid()) {
                    $(this).html('Sending..');
                    $(this).toggleClass('btn-primary btn-success');
                    var fd = new FormData();
                    var files = $('#image')[0].files[0];
                    fd.append('image', files);
                    fd.append('product_id', $('#product_id').val());
                    fd.append('name', $('#name').val());
                    fd.append('customer_id', $('#customer_id').val());
                    fd.append('paper_id', $('#paper_id').val());
                    fd.append('eqipment_id', $('#eqipment_id').val());
                    fd.append('print_color', $('#print_color').val());
                    fd.append('print_type', $('#print_type').val());
                    fd.append('plate_set', $('#plate_set').val());
                    fd.append('plate_date', $('#plate_date').val());
                    fd.append('paper_size', $('#paper_size').val());
                    fd.append('quantity', $('#quantity').val());
                    fd.append('numbering', $('#numbering').val());
                    fd.append('lamination', $('#lamination').val());
                    fd.append('binding', $('#binding').val());
                    fd.append('job_number', $('#job_number').val());
                    fd.append('is_customer_supplied_paper', $('#is_customer_supplied_paper').is(
                        ":checked"));
                    fd.append('customer_supplied_paper', $('#customer_supplied_paper').val());
                    fd.append('is_customer_supplied_ctp', $('#is_customer_supplied_ctp').is(":checked"));
                    fd.append('customer_supplied_ctp', $('#customer_supplied_ctp').val());
                    fd.append('market', $('#market').is(":checked"));
                    fd.append('office', $('#office').is(":checked"));
                    fd.append('note', $('#note').val());
                    fd.append('date', $('#date').val());
                    fd.append('paper_weight', $('#paper_weight').val());
                    fd.append('billing', $('#billing').is(":checked"));
                    $.ajax({
                        data: fd,
                        url: "{{ route('jobs.store') }}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            var message = (data.success);
                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save');
                        }
                    });
                }
            });
            $('body').on('click', '.deleteProduct', function() {

                var product_id = $(this).data("id");
                // confirm("Are You sure want to delete !");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('jobs') }}" + '/' + product_id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({

                            title: 'Deleted!',
                            text: 'Customer Has has been deleted.',
                            icon: 'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                })


            });
            $('#is_customer_supplied_paper').change(function() {
                var value = $(this).is(":checked")
                if (value == 1) {
                    $('#customer_supplied_paper').show()
                } else {
                    $('#customer_supplied_paper').hide()
                    $('#customer_supplied_paper').val(null)
                }
            });
            $('#is_customer_supplied_ctp').change(function() {
                var ctpvalue = $(this).is(":checked")
                // alert(ctpvalue);
                if (ctpvalue == 1) {
                    $('#customer_supplied_ctp').show()
                } else {
                    $('#customer_supplied_ctp').hide()
                    $('#customer_supplied_ctp').val(null)
                }
            });
            $("#customer_supplied_paper").hide();
            $("#customer_supplied_ctp").hide();
            $(document).ready(function() {
                $("#customer_id").select2({
                    tags: true
                });

                // $("#btn-add-state").on("click", function(){
                // var newStateVal = $("#new-state").val();
                // if ($("#customer_id").find("option[value='" + newStateVal + "']").length) {
                //     $("#customer_id").val(newStateVal).trigger("change");
                // } else { 
                //     var newState = new Option(newStateVal, newStateVal, true, true);
                //     $("#customer_id").append(newState).trigger('change');
                // } 
                // });  
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
@endpush
