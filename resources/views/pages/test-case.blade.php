@extends('.layouts.default')
@section('title', 'Test Case')

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
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col">
          <div class="card shadow">
            <div class="card-header pb-0 p-3">
              <h4 class="mb-0 float-start ms-2">Test Case Info</h4>
              <a href="/test-steps?id={{$_GET['id']}}" class="float-end ms-2 btn btn-success btn-lg px-4"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Proceed">
                <i class="fas fa-chevron-right fa-3x"></i>
              </a>
              <button type="button" class="btn btn-lg btn-primary float-end px-3 mb-0" id="btnSave" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save">
                <i class="fas fa-save"></i>
              </button>
              <a href="test-cases" class="float-end px-3 me-2 btn btn-secondary btn-lg px-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Go Back">
                <i class="fas fa-chevron-left fa-3x"></i>
              </a>
            </div>
            <div class="card-body p-3 pt-1">
              <form action="" method="post" id="newTCForm">
                <input type="hidden" name="tc_id" id="tc_id" value="{{$_GET['id']}}">
                <div class="form-group">
                  <label for="tc_title">Test Case Title:</label>
                  <input type="text" name="tc_title" id="tc_title" class="form-control modalField" value="{{$result['tc_title']}}">
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_num">Test Case No:</label>
                      <input type="number" name="tc_num" id="tc_num" class="form-control modalField" value="{{$result['tc_num']}}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_des_by">Test Case Designed By:</label>
                      <select name="tc_des_by" id="tc_des_by" class="form-control modalField">
                        <option selected hidden value="{{$result['tc_des_by']}}">{{$result['tc_des_by']}}</option>
                         @if(is_array($members))
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
                      <select name="tc_prio" id="tc_prio" class="form-control modalField">
                        <option selected hidden value="{{ $result['tc_priority'] }}">{{ $result['tc_priority'] }}</option>
                        <option value="High">High</option>
                        <option value="Normal">Normal</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_des_date">Test Case Design Date:</label>
                      <input type="date" name="tc_des_date" id="tc_des_date" class="form-control modalField bg-white" value="{{ $result['tc_des_date'] }}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_mod_name">Module Name:</label>
                      <input type="text" name="tc_mod_name" id="tc_mod_name" class="form-control modalField" value="{{$result['tc_module_name']}}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_exec_by">Test Case Executed By:</label>
                      <select name="tc_exec_by" id="tc_exec_by" class="form-control modalField">
                        <option selected hidden value="{{$result['tc_exec_by']}}">{{ $result['tc_exec_by'] }}</option>
                         @if(is_array($members))
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
                      <textarea name="tc_desc" id="tc_desc" rows="8" class="form-control modalField">{{ $result['tc_desc'] }}</textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tc_exec_date">Test Executed Date:</label>
                      <input type="text" name="tc_exec_date" id="tc_exec_date" class="form-control modalField bg-white" value="{{ $result['tc_exec_date'] }}">
                    </div>

                    <div class="form-group">
                      <label for="tc_precon" class="">Pre-Condition:</label>
                      <div class="float-end">
                        @if($result['tc_precon'] == 'None')
                          <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_precon">
                          </div>
                        @else
                          <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_precon" checked>
                          </div>
                        @endif
                      </div>
                      <input type="text" name="tc_precon" id="tc_precon" class="form-control modalField" value="{{ $result['tc_precon'] }}">
                    </div>

                    <div class="form-group">
                      <label for="tc_postcon">Post-Condition:</label>
                      <div class="float-end">

                        @if($result['tc_postcon'] == 'None')
                          <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_postcon">
                          </div>
                        @else
                          <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="toggle_postcon" checked>
                          </div>
                        @endif
                        
                      </div>
                      <input type="text" name="tc_postcon" id="tc_postcon" class="form-control modalField" value="{{$result['tc_postcon']}}">
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
      // Tooltips
      $('[data-bs-toggle="tooltip"]').each(function () { new bootstrap.Tooltip(this); });

      // Getting Previous values
      let prevPostCon = $('#tc_postcon').val(); 
      let prevPreCon = $('#tc_precon').val();

      if(prevPostCon == "None")
      {$('#tc_postcon').addClass('fw-bolder').prop('readonly', true);}

      if(prevPreCon == "None")
      {$('#tc_precon').addClass('fw-bolder').prop('readonly', true);}

      $('#toggle_precon').on('change', function(){
        let input = $('#tc_precon');

        if(!$(this).is(':checked'))
          {input.val('None').addClass('fw-bolder').prop('readonly', true);}
        else
          {input.val(prevPreCon).removeClass('fw-bolder').prop('readonly', false);}
      });

      $('#toggle_postcon').on('change', function(){
        let input = $('#tc_postcon');

        if(!$(this).is(':checked'))
          {input.val('None').addClass('fw-bolder').prop('readonly', true);}
        else
          {input.val(prevPostCon).removeClass('fw-bolder').prop('readonly', false);}
      });

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

      $("#tc_exec_date").flatpickr({
          enableTime: false,
          dateFormat: "M. d, Y",
      });

      $('#btnSave').on('click', function(){

          let formData = new FormData($("#newTCForm")[0]);
          formData.append("saveTestCase", true);
          $.ajax({
              url: "{{ route('saveTestCase') }}",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
                // console.log("Success:", response);
                $('#btnSave').addClass('btn-success').html('<i class="fas fa-check"></i> Saved');

                setTimeout(function() {
                  $('#btnSave').removeClass('btn-success').html('<i class="fas fa-save"></i>');
                }, 2000);
                // Handle the success response
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