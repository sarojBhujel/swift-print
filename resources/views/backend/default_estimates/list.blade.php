
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
                            <h4>Default Estimates</h4>
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
                                        <th scope="col">Particular Name</th>
                                        <th scope="col">Default Unit</th>
                                        <th scope="col">Default Quantity</th>
                                        <th scope="col">Default Rate</th>
                                        <th scope="col">Amount</th>
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
                                    <label for="particular_name" class="col-sm-12 control-label">Particular Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="particular_name" name="particular_name"
                                            placeholder="Enter Particular Name" value="" maxlength="250" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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

                ajax: "{{ route('getDefaultEstimatesData') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'particular_name',
                        name: 'particular_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'unit',
                        name: 'unit',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'qunatity',
                        name: 'qunatity',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'rate',
                        name: 'rate',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'amount',
                        name: 'amount',
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
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }],
                // "initComplete": function(settings, json) {
                // }
            });

            //add modal
            $('#createNewEstimate').click(function() {
                $('#saveBtn').val("create-customer");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Default Estimate");
                $('#ajaxModel').modal('show');
                $(".oldImage").hide();

            });
            $('body').on('click', '.editItem', function() {
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

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                let formdata=new FormData($('#productForm')[0]);
                    $.ajax({
                        data: formdata,
                        url: "{{ route('default-estimate-particulars.store') }}",
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
