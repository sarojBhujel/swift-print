@extends('backend.layouts.master')
@section('title', '| Customers')
@push('styles')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">

        <style>
            .viewDesign{
                border-bottom: 1px dotted black;
            }
            .select2-selection--single{
                height: 1% !important;
                padding-top: 2px !important;
                padding-bottom: 2px !important;
            }
        </style> --}}
@endpush

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">

                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Customers Table</h4>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact Person</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Contact Email</th>
                                        <th scope="col">Contact Mobile</th>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Client Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Client Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Enter Address" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Email Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter Email Address" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Mobile</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            placeholder="Enter Mobile" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Contact Person</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="contact_person"
                                            name="contact_person" placeholder="Enter Contact Person" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Department</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="department" name="department"
                                            placeholder="Enter Department" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Contact Email Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="contact_email"
                                            name="contact_email" placeholder="Enter Contact Email Address" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Contact Telephone</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="contact_mobile"
                                            name="contact_mobile" placeholder="Enter Contact Telephone" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-offset-2 col-sm-10 text-right">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Client
                            </button>
                        </div>
                    </form>
                </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
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
                ajax: "{{ route('getCustomerData') }}",
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
                        data: 'address'
                    },
                    {
                        data: 'mobile'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'contact_person'
                    },
                    {
                        data: 'department'
                    },
                    {
                        data: 'contact_email'
                    },
                    {
                        data: 'contact_mobile'
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
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Customer");
                $('#ajaxModel').modal('show');
            });
            $('body').on('click', '.editProduct', function() {
                var product_id = $(this).data('id');
                $.get("{{ url('customers') }}" + '/' + product_id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Customer");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#mobile').val(data.mobile);
                    $('#email').val(data.email);
                    $('#contact_person').val(data.contact_person);
                    $('#department').val(data.department);
                    $('#contact_email').val(data.contact_email);
                    $('#contact_mobile').val(data.contact_mobile);
                })
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                var formvalidation = $("#productForm").validate();
                // console.log(formvalidation['a'],formvalidation['errorList'],'list');
                if ($("#productForm").valid()) {
                    $(this).html('Sending..');

                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ route('customers.store') }}",
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
                            url: "{{ url('customers') }}" + '/' + product_id,
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
        });
    </script>
@endpush
