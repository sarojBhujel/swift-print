@extends('backend.layouts.master')
@section('title', '| Signatures')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
@endpush

@section('main-content')
<div style="background-color: #0030ff5e;">

    <h4 class="p-2">Signatures</h4>
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
                            <td>Position</td>
                            <td>Image</td>
                            <td>Image</td>
                            <td>Is Active</td>
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
                                    <label for="name" class="col-sm-12 control-label">Position</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="position" name="position"
                                        placeholder="Enter Position" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Signature</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Signature" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 oldImage" style="display: none;">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Old Signature</label>
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
                ajax: "{{ route('getSignatureData') }}",
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
                        data: 'position'
                    },

                    {
                        data: 'image'
                    },
                    {
                        data: 'old_image'
                    },
                    {
                        data: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                'columnDefs' : [
                    //hide the second & fourth column
                    { 'visible': false, 'targets': [3] }
                ]
            });

            //add modal
            $('#createNewCustomer').click(function() {
                $(".oldImage").hide();
                $('#saveBtn').html('Save');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Signature");
                $('#ajaxModel').modal('show');
                $("#image").prop('required',true);

            });
            $('body').on('click', '.editProduct', function() {
                $('#saveBtn').html('Update');
                $("#saveBtn").toggleClass('btn-success btn-primary');
                $(".oldImage").show();
                $("#image").prop('required',false);
                var product_id = $(this).data('id');
                $.get("{{ url('signatures') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Signature");
                    $('#saveBtn').val("edit-user");
                    $("#editImage").attr("src", data.image);
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#position').val(data.position);
                    // $('#image').val(data.image);
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation=$("#productForm").validate();
                // console.log(formvalidation['a'],formvalidation['errorList'],'list');
                if($("#productForm").valid()) {
                        $(this).html('Sending..');
                        var fd = new FormData();
                        var files = $('#image')[0].files[0];
                        console.log(files,$('#product_id').val());
                        fd.append('image',files);
                        fd.append('product_id',$('#product_id').val());
                        fd.append('name',$('#name').val());
                        fd.append('position',$('#position').val());
                $.ajax({
                    data: fd,
                    url: "{{ route('signatures.store') }}",
                    type: "POST",
                    // enc: 'application/octet-stream',
                    dataType: 'json',
                    contentType: false,
                        processData: false,
                    // enctype:"multipart/form-data",
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
                            url: "{{ url('signatures') }}" + '/' + product_id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({

                            title: 'Deleted!',
                            text: 'Signature Has has been deleted.',
                            icon: 'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                })


            });

            $('body').on('change','.customSwitchsizemd',function(){
                $(this).prop('checked', true);
                var id= $(this).data("id");
                var isChecked = $(this).is(':checked');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to make this signature Active",
                    icon: 'warning',
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Made Active'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "{{ url('signatures-active') }}" + '/' + id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({

                            title: 'Made Active!',
                            text: 'Signature Has has Made Active Successfully.',
                            icon: 'success',
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false,
                            timer: 1300
                        })
                    }
                    else if (result.isDenied){
                        if (isChecked) {
                            $(this).prop('checked', false);
                        }
                    }
                })
            });
            
        });
    </script>
@endpush
