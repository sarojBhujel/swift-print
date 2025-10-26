@extends('backend.layouts.master')
@section('title', '| User')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
@endpush

@section('main-content')
<div style="background-color: #0030ff5e;">

    <h4 class="p-2">Users</h4>
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
                            <td>Email</td>
                            <td>Address</td>
                            <td>Mobile</td>
                            <td>Role</td>
                            <td>Image</td>
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
                    <form id="productForm" name="productForm" class="form-horizontal " enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Mobile</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter Mobile" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter Address" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Password</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Enter Password" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Choose Role</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="role_id"
                                            id="role_id" required>
                                            <option value="">--Select Role--</option>
                                            
                                            {{-- <option value="3">Three</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Image</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Signature" value="" maxlength="250" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 oldImage" style="display: none;">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Old Image</label>
                                    <div class="col-sm-12">
                                        <img src="" alt="" id="editImage" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        


                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Signature
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
                ajax: "{{ route('getUserData') }}",
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
                        data: 'email'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'mobile'
                    },
                    {
                        data: 'role_id'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "initComplete": function(settings, json) {
                    $.ajax({
                        url: '/roles-list', // Replace with your server endpoint URL
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var select = $('#role_id');

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
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New User");
                $('#ajaxModel').modal('show');
                $(".oldImage").hide();
                $("#password").prop('required',true);
            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                $('#saveBtn').html('Edit');
                $('#password').html('Change password??');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $(".oldImage").show();
                $.get("{{ url('users') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#mobile').val(data.mobile);
                    $('#address').val(data.address);
                    $('#role_id').val(data.role_id);
                    $("#password").prop('required',false);
                    $("#image").prop('required',false);
                    $("#editImage").attr("src", data.image);
                })
            });
            

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation=$("#productForm").validate();
                if($("#productForm").valid()) {
                    $(this).html('Sending..');
                    $(this).toggleClass('btn-primary btn-success');
                    var fd = new FormData();
                    var files = $('#image')[0].files[0];
                    fd.append('image',files);
                    fd.append('product_id',$('#product_id').val());
                    fd.append('name',$('#name').val());
                    fd.append('email',$('#email').val());
                    fd.append('address',$('#address').val());
                    fd.append('mobile',$('#mobile').val());
                    fd.append('role_id',$('#role_id').val());
                    if ($('#password').val()!='') {
                        fd.append('password',$('#password').val());
                        
                    }
                    $.ajax({
                        data: fd,
                        url: "{{ route('users.store') }}",
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
                    url: "{{ url('users') }}" + '/' + product_id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
                        Swal.fire({
                            
                            title: 'Deleted!',
                            text: 'User Has has been deleted.',
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
