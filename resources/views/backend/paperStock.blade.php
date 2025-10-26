@extends('backend.layouts.master')
@section('title', '| Paper Stocks')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
@endpush

@section('main-content')
<div style="background-color: #0030ff5e;">
    <div class="row">
        <div class="col-md-8">

            <h4 class="p-3">Papers Stock Of {{$paper->name}}</h4>
        </div>
        <div class="col-md-4">
            
            <h4 class="p-3">{{$paper->balance}} <small>(Balance in hand)</small>  </h4>
        </div>
    </div>
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
                            <th rowspan="2">S.N.</th>
                            {{-- <th>Pap</th> --}}
                            <th rowspan="2">Job/Bill No.</th>
                            <th rowspan="2">Date</th>
                            {{-- <th>Date</th> --}}
                            <th rowspan="2">Issue/Supplier</th>
                            <th colspan="2">Quantity</th>
                            {{-- <th rowspan="2">Balance In Hand</th> --}}
                            <th rowspan="2" class="actionCol">Action</th>
                        </tr>
                        <tr>
                            <th>Receive</th>
                            <th>Issue</th>
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
                    <form id="productForm" name="productForm" class="form-horizontal ">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="paper_id" id="paper_id" value="{{$paper->id}}">
                        <input type="hidden" name="originalBalance" id="originalBalance" value="">
                        <input type="hidden" name="originalQuantity" id="originalQuantity" value="">
                        <input type="hidden" name="originalType" id="originalType" value="">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Entry Type</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="">--Select Entry Type--</option>
                                        <option value="issue">Issue</option>
                                        <option value="receive">Receive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Job/Bill No</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="bill_no" name="bill_no"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Date</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="date" name="date"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Issue/Supplier</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="supplier" name="supplier"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Quantity</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="quantity" name="quantity"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                                    </div>
                                </div> --}}
                                <div class="input-group mb-3">
                                    <label for="name" class="col-sm-12 control-label">Quantity</label>
                                    <div class="col-sm-12 row">

                                        <input type="number" class="form-control col-6" id="quantity" name="quantity"
                                                placeholder="Enter Quantity" value="" maxlength="250" required min="0">
                                        <div class="input-group-append col-6 pl-0">
                                          <span class="input-group-text pl-0 py-0" id="basic-addon2">&nbsp; {{$paper->type}}</span>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Balance In Hand</label>
                                    <div class="col-sm-12 ">
                                        <input type="number" class="form-control " id="balance" name="balance"
                                         value="" maxlength="250" >
                                    </div>
                                    <div class="col-sm-12 " id="errorBalance"style="display:none" >
                                        <span style="font-color:red;">Balannce Cannot be null</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Remarks</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="5" id="remarks" name="remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Paper Entry
                            </button>
                        </div>
                    </form>
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
            var balance={{$balance}};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var paperId="{{ $paper->id}}";
            // Initialize
            console.log(paperId,'sdfsd');
            var table = $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ url('paper-stocks-datatables') }}" + '/' + paperId,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data:'bill_no'
                    },
                    {
                        data:'date'
                    },
                    {
                        data:'supplier'
                    },
                    {
                        data:'receive'
                    },
                    {
                        data:'issue'
                    },
                    // {
                    //     data:'balance'
                    // },
                    
                    // {
                    //     data:'note'
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                     {
                        extend:'excel',
                        exportOptions:{
                            columns:[0,1,2,3,4,5,6]
                        }
                     }
                ]
            });
            

            //add modal
            $('#createNewCustomer').click(function() {
                getBalance();
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Paper Entry");
                $('#ajaxModel').modal('show');
                var stock=$('#quantity').val(0);
               
                $('#quantity').on('input',function() {
                    calculateBalance();
                });
                $('#type').on('change',function() {
                    calculateBalance();
                });

            });
            $('body').on('click', '.editProduct', function() {
                console.log('clicked on eeit');
                var product_id = $(this).data('id');
                $('#saveBtn').html('Update');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('paper-stocks') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Paper Entry");
                    var originalQuantity=data.quantity;
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    // $('#paper_id').val(data.paper_id);
                    $('#bill_no').val(data.bill_no);
                    $('#date').val(data.date);
                    $('#supplier').val(data.supplier);
                    $('#quantity').val(data.quantity);
                    $('#originalQuantity').val(data.quantity);
                    $('#type').val(data.type);
                    $('#originalType').val(data.type);
                    $('#remarks').val(data.remarks);
                    // $('#balance').val(data.balance);
                })
                getBalance();

                $('#type').on('change',function() {
                    editCalculatebalance();
                });
                $('#quantity').on('input',function() {
                    editCalculatebalance();
                });
            });
            
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation=$("#productForm").validate();
                // console.log(formvalidation['a'],formvalidation['errorList'],'list');
                if($("#productForm").valid()) {
                     $(this).html('Sending..');
     
                     $.ajax({
                         data: $('#productForm').serialize(),
                         url: "{{ route('paperStocks.store') }}",
                         type: "POST",
                         dataType: 'json',
                         success: function(data) {
                            console.log(data,'success');
                            $('#saveBtn').html('Save');
                            $("#saveBtn").toggleClass('btn-success btn-primary');
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
                            console.log(data.error);
                            Swal.fire({
                                 icon: 'error',
                                 title: data.error,
                                 showConfirmButton: false,
                                 timer: 1500
                             })
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
                            url: "{{ url('paper-stocks') }}" + '/' + product_id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({

                            title: 'Deleted!',
                            text: 'Quotation Has has been deleted.',
                            icon: 'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                })


            });
            function getBalance(params) {
                var paper_id=$('#paper_id').val();
                $.get("{{ url('get-paper-balance') }}" + '/' + paper_id, function(data) {
                    
                    $('#originalBalance').attr('value',data.balance);
                    $('#balance').attr('value',data.balance);
                })
            }
            function calculateBalance() {
               
                
                var type=$('#type').val();
                var stock=$('#quantity').val();
                
                if (type==='issue') {
                    var newBalance=parseInt($('#originalBalance').val())-parseInt(stock);
                    $('#balance').attr('value',newBalance);
                }
                if (type==='receive') {
                    var newBalance=parseInt($('#originalBalance').val())+parseInt(stock);
                    $('#balance').attr('value',newBalance);
                }
            

                if (stock<=0) {
                    $('#balance').attr('value',$('#originalBalance').val());
                    $('#saveBtn').prop('disabled', true); 
                    $('#errorBalance').attr("display", "none");
                }else{
                    var newBalance=parseInt($('#originalBalance').val())+parseInt(stock);
                    $('#saveBtn').prop('disabled', false); 
                    $('#errorBalance').attr("display", "block");
                }
                if ($('#balance').val()<=0) {
                            console.log('less than zero');
                            $('#saveBtn').prop('disabled', true); 
                            $('#errorBalance').attr("display", "none");
                        }else{
                            $('#saveBtn').prop('disabled', false); 
                            $('#errorBalance').attr("display", "block");
                        }
            }
            function editCalculatebalance(){
                console.log('editCalculatebalance');
                var originalBalance= $('#originalBalance').val();
                var originalQuantity= $('#originalQuantity').val();
                var originalType= $('#originalType').val();
                var stock=$('#quantity').val();
                console.log(originalBalance,originalQuantity,stock);
                var type=$('#type').val();
                if (type==='issue') {
                    if (originalType==='issue') {
                        
                        var newBalance=parseInt(originalBalance)+parseInt(originalQuantity)-parseInt(stock);
                    } else {
                        
                        var newBalance=parseInt(originalBalance)-parseInt(originalQuantity)-parseInt(stock);
                    }
                    $('#balance').attr('value',newBalance);
                }
                if (type==='receive') {
                    if (originalType==='issue') {
                        
                        var newBalance=parseInt(originalBalance)+parseInt(originalQuantity)+parseInt(stock);
                    } else {
                        
                        var newBalance=parseInt(originalBalance)-parseInt(originalQuantity)+parseInt(stock);
                    }
                    $('#balance').attr('value',newBalance);
                }
                if ($('#balance').val()<=0) {
                    console.log('less than zero');
                    $('#saveBtn').prop('disabled', true); 
                    $('#errorBalance').attr("display", "none");
                }else{
                    $('#saveBtn').prop('disabled', false); 
                    $('#errorBalance').attr("display", "block");
                }
            }
        });
    </script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
@endpush
