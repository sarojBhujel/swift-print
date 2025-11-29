@extends('backend.layouts.master')
@section('title', '| Jobs')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

                                <button type="button" class="btn btn-primary" id="addData">
                                    Add
                                </button>
                            </div>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table " id='datatables-reponsive'>
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
        aria-hidden="true" id="formModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataForm" name="productForm" class="form-horizontal form">
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="col-sm-12 control-label">Client</label>
                                    <div class="col-sm-12">
                                        <select class="js-example-basic-single select2" aria-label="Default select example"
                                            name="customer_id" id="customer_id" required=""
                                            style="width:100% ;height: 200% !important;" data-placeholder="Select Customer">
                                            @foreach ($clients as $job)
                                                <option value="{{ $job->id }}" data-id="{{ $job->id }}" >
                                                    {{ $job->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="col-sm-12 control-label">Jobs</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="job_ids[]"  id="job_ids" multiple data-placeholder="Select jobs" style="width:100% ;height: 200% !important;">
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
                                    <label for="paper" class="col-sm-12 control-label">Paper B/W</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="paper" name="paper"
                                            placeholder="Enter Paper B/W" value="" maxlength="250" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color" class="col-sm-12 control-label">Color</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="color" name="color"
                                            placeholder="Enter Color" value="" maxlength="250">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_page" class="col-sm-12 control-label">Total Page</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="total_page" name="total_page"
                                            placeholder="Enter Total Page" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size" class="col-sm-12 control-label">Size</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="size" name="size"
                                            placeholder="Enter Size" value="" maxlength="250" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="is_vat_included" class="col-sm-12 control-label">Vatable Type</label>
                                    <div class="col-sm-12">
                                       
                                            <select name="is_vat_included" id="is_vat_included">
                                                <option value="1">Included</option>
                                                <option value="0">Excluded</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="particular_div">

                        </div>
                        <div></div>
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
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets/customjs/estimates.js')}}"></script>
@endpush
