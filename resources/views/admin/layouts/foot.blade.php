    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
        </div>
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
        </div>
      </footer> 
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>   
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script>
  let BASE_URL = '{!! url('/') !!}';
  let YEAR = 2021;
</script>
<script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/admin/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/js/dataTables.select.min.js')}}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/admin/js/off-canvas.js')}}"></script>
<script src="{{ asset('assets/admin/js/hoverable-collapse.js')}}"></script>
<script src="{{ asset('assets/admin/js/template.js')}}"></script>
<script src="{{ asset('assets/admin/js/settings.js')}}"></script>
<script src="{{ asset('assets/admin/js/todolist.js')}}"></script>
<script src="{{ asset('assets/admin/js/file-upload.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/admin/js/dashboard.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- End custom js for this page-->
<script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    function selectBox(id, placeholder,table,param,select) {
        let dropdown = $(id);
        dropdown.empty();

        dropdown.append(`<option selected="true" disabled>${placeholder}</option>`);
        dropdown.prop('selectedIndex', 0);

        const url = `${BASE_URL}/api/${table}`;
        // Populate dropdown with list of provinces
        $.getJSON(url, function (result) {
            $.each(result.data, function (key, entry) {
              dropdown.append($('<option></option>').attr('selected',(entry.id == select) ? 'selected' : undefined).attr('value', entry.id).text(eval(`entry.${param}`)));
            });
        });
    }

    let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    let today  = new Date();

    $('#navToogle').on('click', function(e){
      e.preventDefault();
      $.ajax({
        url: `${BASE_URL}/changeNav`,
        method: 'get',
        success: function(result){
          console.log(result);
        },
      });
    });
</script>
@stack('js')
</body>

</html>