@extends('backend.layouts.master')
@section('title', '| Roles')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
@endpush

@section('main-content')
<div style="background-color: #0030ff5e;">

    <h4 class="p-2">Role</h4>
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
                            <td>Name</td>
                            <td>Petmission</td>
                            {{-- <td></td>
                            <td>Size</td>
                            <td>Weight</td> --}}
                            <td>Action</td>
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
                                    <label for="name" class="col-sm-12 control-label "><b> Role Name:</b></label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Role Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <h6 class="ml-2 headingTagg">Assign Permissions To This User</h6>
                            <div class="col-md-6 offset-md-3">
                                <div class="row">

                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="jobs"
                                                value="1"
                                                >Jobs
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="quotation"
                                                value="2"
                                                >Quotation
                                                
                                              </label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="signatures"
                                                value="3"
                                                >Signatures
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="paper"
                                                value="4"
                                                >Paper
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="customer"
                                                value="5"
                                                >Customer
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="inventory"
                                                value="6"
                                                >Inventory/Stock
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="role"
                                                value="7"
                                                >role
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="users"
                                                value="8"
                                                >Users
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="machines"
                                                value="9"
                                                >Machine
                                                
                                              </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
    
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="jobs[]"  id="chalan"
                                                value="10"
                                                >Chalan
                                                
                                              </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>


                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Role
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
                ajax: "{{ route('getRoleData') }}",
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
                        data: 'permissions'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                
            });
            
            //add modal
            $('#createNewCustomer').click(function() {
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Role");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $.get("{{ url('roles') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Paper");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#jobs').val(data.jobs);
                    $('#quotation').val(data.jobs);
                    $('#paper').val(data.jobs);
                    $('#signatures').val(data.jobs);
                    $('#customer').val(data.jobs);
                    $('#inventory').val(data.jobs);
                    $('#role').val(data.jobs);
                    $('#users').val(data.jobs);
                    $('#machines').val(data.jobs);
                    $('#chalan').val(data.jobs);
                    // $('#type').val(data.type);
                    // $('#size').val(data.size);
                    // $('#weight').val(data.weight);
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
                    url: "{{ route('roles.store') }}",
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
                    url: "{{ url('roles') }}" + '/' + product_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
                        Swal.fire({
                            
                            title: 'Deleted!',
                            text: 'Role Has has been deleted.',
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
