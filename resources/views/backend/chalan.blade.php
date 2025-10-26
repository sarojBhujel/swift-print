@extends('backend.layouts.master')
@section('title', '| Chalans')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
    <style>
        @media (min-width: 992px) {

            /* .modal-lg {
                max-width: 90% !important;
            } */
        }
        .viewDesign{
            border-bottom: 1px dotted black;
        }
    </style>
@endpush

@section('main-content')
    <div style="background-color: #0030ff5e;">

        <h4 class="p-2">Chalans</h4>
    </div>
    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-primary btn-rounded btn-fw" href="javascript:void(0)"
                    id="createNewCustomer"><i class="mdi mdi-plus"></i> Add</button>
            </div>
            <div class="col-12">

                <table id='empTable' class="table table-striped table-bordered mt-1" width="100%">
                    <thead>
                        <tr class="mt-1">
                            <td>S.N.</td>
                            <td>Chalan Number</td>
                            <td>Date</td>
                            <td>Customer</td>
                            <td>Customer Mobile</td>
                            <td>Address</td>
                            <th>Chalan By</th>
                            <td>Action</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal ">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label nepalidate">Chalan Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control " id="chalan_number" name="chalan_number"
                                            placeholder="Enter Chalan Number" value="" maxlength="250" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label ">Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="date" name="date"
                                            placeholder="Enter Date" value="" maxlength="50" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="customer" name="customer"
                                            placeholder="Enter Customer Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Phone Number</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="customer_mobile"
                                            name="customer_mobile" placeholder="Enter Customer Mobile Number "
                                            value="" maxlength="50" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Enter Customer Address" value="" maxlength="50"
                                            >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
    
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Delivery Boy</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="chalan_by" name="chalan_by"
                                            placeholder="Enter Delivery Boy" value="" maxlength="50"
                                            >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11 pl-5">
    
                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="is_billing" id="is_billing">Billing
                                      </label>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Chalan Details</h4>
                        
                       
                        <table class="table">
                            <thead>
                              <tr>
                                <th>S.N.</th>
                                <th>Particular</th>
                                <th>Unit Of Measure</th>
                                <th>Quantity</th>
                                <th>Remarks</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[0]" id="particulars" placeholder="Particular" required></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[0]" id="unit" placeholder="Unit" ></td>
                                <td><input type="text" class="form-control" name="quantity[0]" id="quantity" placeholder="Quantity" ></td>
                                <td><input type="text" class="form-control" name="remarks[0]" id="remarks" placeholder="Remarks" ></td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[1]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[1]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[1]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[1]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td class="col-4"><input type="text" class="form-control " name="particulars[2]" id="particulars" placeholder="Particular"></td>
                                  <td class="col-2"><input type="text" class="form-control" name="unit[2]" id="unit" placeholder="Unit"></td>
                                  <td ><input type="text" class="form-control" name="quantity[2]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[2]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[3]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[3]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[3]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[3]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[4]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[4]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[4]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[4]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[5]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[5]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[5]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[5]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[6]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[6]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[6]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[6]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[7]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[7]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[7]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[7]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[8]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[8]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[8]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[8]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td class="col-4"><input type="text" class="form-control " name="particulars[9]" id="particulars" placeholder="Particular"></td>
                                <td class="col-2"><input type="text" class="form-control" name="unit[9]" id="unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" name="quantity[9]" id="quantity" placeholder="Quantity"></td>
                                <td><input type="text" class="form-control" name="remarks[9]" id="remarks" placeholder="Remarks"></td>
                              </tr>
                              <!-- Add more rows as needed -->
                            </tbody>
                          </table>
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="button" id="closeBtn"class="btn btn-danger"
                            data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Chalan
                            </button>
                           
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModelView" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal ">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-12 control-label nepalidate">Chalan Number</label>
                                    
                                    <div class="col-sm-6 viewDesign">
                                        
                                        <span id="view_chalan_number" class=""></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label ">Date</label>
                                    
                                    <div class="col-sm-12 viewDesign">
                                        
                                        <span id="view_date" class=""></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Name</label>
                                    
                                    <div class="col-sm-12 viewDesign">
                                        
                                        <span id="view_customer" class=""></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Phone Number</label>
                                    
                                    <div class="col-sm-12 viewDesign">
                                        
                                        <span id="view_customer_mobile" class=""></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Customer Address</label>
                                   
                                    <div class="col-sm-12 viewDesign">
                                        
                                        <span id="view_address" class=""></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
    
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Delivery Boy</label>
                                    
                                    <div class="col-sm-12 viewDesign">
                                        
                                        <span id="view_chalan_by" class=""></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11 pl-5">
    
                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="is_billing" id="view_is_billing" disabled>Billing
                                      </label>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Chalan Details</h4>
                        
                       
                        <table class="table">
                            <thead>
                              <tr>
                                <th>S.N.</th>
                                <th>Particular</th>
                                <th>Quantity</th>
                                <th>Unit Of Measure</th>
                                <th>Remarks</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[0]" id="view_particulars" placeholder="Particular" ></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[0]" id="view_quantity" placeholder="Quantity" ></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[0]" id="view_unit" placeholder="Unit" ></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[0]" id="view_remarks" placeholder="Remarks" ></td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[1]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[1]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[1]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[1]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[2]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[2]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[2]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[2]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[3]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[3]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[3]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[3]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[4]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[4]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[4]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[4]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[5]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[5]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[5]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[5]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[6]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[6]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[6]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[6]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[7]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[7]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[7]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[7]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[8]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[8]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[8]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[8]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td class="col-4"><input type="text" class="form-control" disabled name="view_particulars[9]" id="view_particulars" placeholder="Particular"></td>
                                <td><input type="text" class="form-control" disabled name="view_quantity[9]" id="view_quantity" placeholder="Quantity"></td>
                                <td class="col-2"><input type="text" class="form-control" disabled name="view_unit[9]" id="view_unit" placeholder="Unit"></td>
                                <td><input type="text" class="form-control" disabled name="view_remarks[9]" id="view_remarks" placeholder="Remarks"></td>
                              </tr>
                              <!-- Add more rows as needed -->
                            </tbody>
                          </table>
                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="button" id="closeBtn"class="btn btn-danger"
                            data-dismiss="modal">Cancle</button>
                            {{-- <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Chalan
                            </button> --}}
                           
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#closeBtn").on('click', function() {
                $("#ajaxModel").modal('toggle');
            })
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
                ajax: "{{ route('getChalanData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'chalan_number'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'customer'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'chalan_by'
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
                        columns: [0, 1, 2, 3, 4, 5, 6,7]
                    }
                }]
            });

            //add modal
            $('#createNewCustomer').click(function() {
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Chalan");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('chalans') }}" + '/' + product_id + '/edit', function(data) {
                    var tableBody = $('tbody');
                    $('#modelHeading').html("Edit Chalan");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.chalan.id);
                    $('#customer').val(data.chalan.customer);
                    $('#customer_mobile').val(data.chalan.customer_mobile);
                    $('#address').val(data.chalan.address);
                    $('#date').val(data.chalan.date);
                    $('#chalan_number').val(data.chalan.chalan_number);
                    $('#is_billing').val(data.chalan.is_billing);
                    $('#chalan_by').val(data.chalan.chalan_by);
                    // $('#is_billing').val(data.is_billing);
                    // console.log('is biling is on=>'+data.chalan.is_billing);
                    if (data.chalan.is_billing==='on') {
                        console.log('is biling is on');
                        $( "#is_billing" ).prop( "checked", true );
                    }
                    for (var i = 0; i < data.count; i++) {
                        var chalanDetail = data.chalan.chalan_details[i];
                        var row = tableBody.find('tr').eq(i);
                        console.log( i,chalanDetail,'sdfds',row);
                        tableBody.find('input[name="particulars['+i+']"]').val(chalanDetail.particulars);
                        tableBody.find('input[name="quantity['+i+']"]').val(chalanDetail.quantity);
                        tableBody.find('input[name="unit['+i+']"]').val(chalanDetail.unit);
                        tableBody.find('input[name="remarks['+i+']"]').val(chalanDetail.remarks);
                        // Set the price and total values if you have them in the data
                        // row.find('input[name="price[]"]').val(chalanDetail.price);
                        // row.find('input[name="total[]"]').val(chalanDetail.total);
                    }
                })
            });
            $('body').on('click', '.viewProduct', function() {
                var product_id = $(this).data('id');
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('chalans') }}" + '/' + product_id + '/edit', function(data) {
                    var tableBody = $('tbody');
                    $('#modelHeading').html("View Chalan Details");
                    $('#ajaxModelView').modal('show');
                    $('#product_id').val(data.chalan.id);
                    $('#view_customer').html(data.chalan.customer);
                    $('#view_customer_mobile').html(data.chalan.customer_mobile);
                    $('#view_address').html(data.chalan.address);
                    $('#view_date').html(data.chalan.date);
                    $('#view_chalan_number').html(data.chalan.chalan_number);
                    $('#view_is_billing').html(data.chalan.is_billing);
                    $('#view_chalan_by').html(data.chalan.chalan_by);
                    // $('#is_billing').val(data.is_billing);
                    // console.log('is biling is on=>'+data.chalan.is_billing);
                    if (data.chalan.is_billing==='on') {
                        console.log('is biling is on');
                        $( "#view_is_billing" ).prop( "checked", true );
                    }
                    for (var i = 0; i < data.count; i++) {
                        var chalanDetail = data.chalan.chalan_details[i];
                        var row = tableBody.find('tr').eq(i);
                        console.log( i,chalanDetail,'sdfds',row);
                        tableBody.find('input[name="view_particulars['+i+']"]').val(chalanDetail.particulars);
                        tableBody.find('input[name="view_quantity['+i+']"]').val(chalanDetail.quantity);
                        tableBody.find('input[name="view_unit['+i+']"]').val(chalanDetail.unit);
                        tableBody.find('input[name="view_remarks['+i+']"]').val(chalanDetail.remarks);
                        // Set the price and total values if you have them in the data
                        // row.find('input[name="price[]"]').val(chalanDetail.price);
                        // row.find('input[name="total[]"]').val(chalanDetail.total);
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
                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ route('chalans.store') }}",
                        type: "POST",
                        dataType: 'json',
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
                            $('#saveBtn').html('Save Changes');
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
                            url: "{{ url('chalans') }}" + '/' + product_id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({

                            title: 'Deleted!',
                            text: 'Chalan Has has been deleted.',
                            icon: 'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                })


            });
        });
    </script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
@endpush
