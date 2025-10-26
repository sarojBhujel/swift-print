<script src="{{asset('backend/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('backend/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('backend/vendors/progressbar.js/progressbar.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('backend/js/off-canvas.js')}}"></script>
  <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('backend/js/template.js')}}"></script>
  <script src="{{asset('backend/js/settings.js')}}"></script>
  <script src="{{asset('backend/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="{{asset('backend/js/dashboard.js')}}"></script>
  <script src="{{asset('backend/js/Chart.roundedBarCharts.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>
  <script>

    $(document).ready(function () {
      // Initialize Nepali Date Picker
      $("#date").nepaliDatePicker({
          container: "#ajaxModel",
      });
      $("#plate_date").nepaliDatePicker({
          container: "#ajaxModel",
      });
  });
  </script>
  @stack('scripts')