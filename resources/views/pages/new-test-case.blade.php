@extends('.layouts.default')

@section('title', 'New Test Case')

@section('nav_items')
    <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('projects') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Projects</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('test-cases') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-ruler-pencil text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Test Cases</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('export') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-spaceship text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Export</span>
        </a>
    </li>
@endsection  

@section('body')
    <span id="ai_value" class="d-none">{{ $autoIncrementValue }}</span>
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col">
          <div class="card shadow">
            <div class="card-header pb-0 p-3">
              <h4 class="mb-0 float-start ms-2">Input Test Case Info</h4>  
              <button type="button" class="btn btn-lg btn-primary float-end mb-0" id="btnSave" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save"><i class="fas fa-save"></i></button>
              <a href="{{ route('test-cases') }}" class="float-end px-3 me-2 btn btn-secondary btn-lg px-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Go Back">
                <i class="fas fa-chevron-left fa-3x"></i>
              </a>
             
            </div>
            <div class="card-body p-3 pt-1">
              <form id="newTCForm">
                <div class="form-group">
                  <label for="tc_title">Test Case Title:</label>
                  <input type="text" name="tc_title" id="tc_title" class="form-control modalField" placeholder="Input Test Case Title" required>
                  <input type="number" name="tc_id" id="tc_id" value="{{ $autoIncrementValue }}" hidden>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_num">Test Case No:</label>
                      <input type="number" name="tc_num" id="tc_num" class="form-control modalField" placeholder="Input Test Case Number" required>
                      <span class="text-danger fw-bold text-xs d-none" id="tc_err">Test Case Already Exists!</span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_des_by">Test Case Designed By:</label>
                      <select name="tc_des_by" id="tc_des_by" class="form-control modalField" required>
                        @if(is_array($members))
                          <option selected hidden>-- Choose Member --</option>
                          @foreach ($members as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                          @endforeach
                        @else
                            <option selected value="{{ $members }}">{{ $members }}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_prio">Test Case Priority:</label>
                      <select name="tc_prio" id="tc_prio" class="form-control modalField" required>
                        <option selected hidden>-- Choose Priority --</option>
                        <option value="High">High</option>
                        <option value="Normal">Normal</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_des_date">Test Case Design Date:</label>
                      <input type="date" name="tc_des_date" id="tc_des_date" class="form-control modalField bg-white " placeholder="Choose Date">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_mod_name">Module Name:</label>
                      <input type="text" name="tc_mod_name" id="tc_mod_name" class="form-control modalField" placeholder="Input Module Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_exec_by">Test Case Executed By:</label>
                      <select name="tc_exec_by" id="tc_exec_by" class="form-control modalField">
                        @if(is_array($members))
                          <option selected hidden>-- Choose Member --</option>
                          @foreach ($members as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                          @endforeach
                        @else
                            <option selected value="{{ $members }}">{{ $members }}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_desc">Test Case Description:</label>
                      <textarea name="tc_desc" id="tc_desc" rows="8" class="form-control modalField" placeholder="Input Test Case Description"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_exec_date">Test Executed Date:</label>
                      <input type="text" name="tc_exec_date" id="tc_exec_date" class="form-control modalField bg-white " placeholder="Choose Date">
                    </div>

                    <div class="form-group">
                      <label for="tc_precon" class="">Pre-Condition:</label>
                      <div class="float-end">
                        <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_precon">
                        </div>
                      </div>
                      <input type="text" name="tc_precon" id="tc_precon" class="form-control modalField" placeholder="Input Pre-Condition" readonly>
                    </div>

                    <div class="form-group">
                      <label for="tc_postcon">Post-Condition:</label>
                      <div class="float-end">
                        <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_postcon">
                        </div>
                      </div>
                      <input type="text" name="tc_postcon" id="tc_postcon" class="form-control modalField" placeholder="Input Post-Condition" readonly>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
      <script>
    $('document').ready(function(){

      let valueAI = $('#ai_value').text();
      $('#tc_precon').val('None').addClass('fw-bolder');
      $('#tc_postcon').val('None').addClass('fw-bolder');

      // Initialize BS5 Tooltip
      $('[data-bs-toggle="tooltip"]').each(function () {
        new bootstrap.Tooltip(this);
      });

      // Check Tese Case Number
      $('#tc_num').on('keyup', function(){
        let val = $(this).val();
        
        // Check if testcase already exists
        $.ajax({
              url: "{{ route('checkTestCaseNum') }}",
              type: "POST",
              data: { 'tc_num': val },
              success: function(response){
                if(response != 0)
                {
                  $('#tc_err').text('Test Case ' + val + ' Already Exists!').removeClass('d-none')
                  $('#tc_num').addClass('is-invalid');
                }
                else
                {
                  $('#tc_err').text('').addClass('d-none');
                  $('#tc_num').removeClass('is-invalid');
                }
              },
              error: function(error){
                console.log("Error:", error);
                // Handle the error response
              }
            });
      });

      //Set Pre Condition State
      $('#toggle_precon').on('change', function(){
        let input = $('#tc_precon');

        if(!$(this).is(':checked'))
          {input.val('None').addClass('fw-bolder').prop('readonly', true);}
        else
          {input.val('').removeClass('fw-bolder').prop('readonly', false);}
      });

      //Set Post Condition State
      $('#toggle_postcon').on('change', function(){
        let input = $('#tc_postcon');

        if(!$(this).is(':checked'))
          {input.val('None').addClass('fw-bolder').prop('readonly', true);}
        else
          {input.val('').removeClass('fw-bolder').prop('readonly', false);;}
      });

      // Initialize flatpickr for TestCase Design Date
      $("#tc_des_date").flatpickr({
          enableTime: false,
          dateFormat: "M. d, Y",
          onChange: function(selectedDates, dateStr, instance) {
              // Get the selected date from input_design
              let selectedDate = instance.selectedDates[0];

              // Set the minDate of input_exec to the selected date
              $("#tc_exec_date").flatpickr({
                  minDate: selectedDate,
                  dateFormat: "M. d, Y",
                  // other options for input_exec...
              });
          }
      });

      // Initialize flatpickr for TestCase Execution Date
      $("#tc_exec_date").flatpickr({
          enableTime: false,
          dateFormat: "M. d, Y",
      });

      // Save Test Case
      $('#btnSave').on('click', function(){
          let formData = new FormData($("#newTCForm")[0]);
          formData.append("saveTestCase", true);
          $('#btnSave').removeClass('btn-success').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Redirecting</span>');

          $.ajax({
              url: "{{ route('saveTestCase') }}",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
                setTimeout(function() {
                  window.location.href = '/test-steps?id=' + valueAI;
                }, 1000);
              },
              error: function(error){
                console.log("Error:", error);
                // Handle the error response
              }
            });
      });
    });
  </script>
@endsection