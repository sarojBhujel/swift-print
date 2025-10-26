@extends('backend.layouts.master')
@section('title', '| Equipment')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
@endpush

@section('main-content')
<div style="background-color: #0030ff5e;">

    <h4 class="p-2">Equipments</h4>
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
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Action</th>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Equipment Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Equipment Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Equipment Size</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="size" name="size"
                                            placeholder="Enter Equipment Size" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Equipment Status</label>
                                    <div class="col-sm-12">
                                        {{-- <input type="text" class="form-control" id="status" name="status"
                                            placeholder="Equipment Status" value="" maxlength="50" required=""> --}}
                                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                                <option selected>Open this select menu</option>
                                                <option value="1">Active</option>
                                                <option value="0">In Active</option>
                                                {{-- <option value="3">Three</option> --}}
                                              </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Paper
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
                ajax: "{{ route('getMachineData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    
                    {
                        data: 'size'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            
            //add modal
            $('#createNewCustomer').click(function() {
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Paper");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('equipments') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Equipment");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#size').val(data.size);
                    $('#status').val(data.status);
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation=$("#productForm").validate();
                // console.log(formvalidation['a'],formvalidation['errorList'],'list');
                if($("#productForm").valid()) {
                $(this).html('Sending..');
                $(this).toggleClass('btn-primary btn-success');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('equipments.store') }}",
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
                    url: "{{ url('equipments') }}" + '/' + product_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
                        Swal.fire({
                            
                            title: 'Deleted!',
                            text: 'Equipment Has has been deleted.',
                            icon:  'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                })

                
            });
        });
    </script>
@endpush
