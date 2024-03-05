@extends('.layouts.default')
@section('title', 'Test Steps')

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
    <div class="container-fluid py-3">
    <span id="tc_id" class="text-white d-none">{{ $_GET['id'] }}</span> 
      <div class="row mt-4">
        <div class="col">
          <div class="card shadow">
            <div class="card-header pb-0 p-3">
              <h4 class="mb-0 float-start ms-2">Test Steps</h4>
              <button type="button" id="exportBtn" class="float-end px-3 ms-2 btn btn-success btn-lg px-4"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Export">
                <i class="fas fa-file-export fa-3x"></i>
              </button>
              <button type="button" class="btn btn-lg btn-primary float-end px-3 mb-0 ms-2" id="btnSave" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save">
                <i class="fas fa-save"></i>
              </button>
              <button type="button" class="btn btn-lg btn-info float-end px-3 ms-2" id="addRowBtn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Row">
                <i class="fas fa-plus"></i>
              </button>
              <a href="test-case?id={{ $_GET['id'] }}" class="float-end px-3 ms-2 btn btn-secondary btn-lg px-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Go Back">
                <i class="fas fa-chevron-left fa-3x"></i>
              </a>
            </div>
            <div class="card-body p-3 pt-1">
              <div class="table-responsive">
                <table class="table" id="table">
                <thead>
                  <tr>
                    <th style="width:5%;">Step</th>
                    <th>Test Step</th>
                    <th>Test Data</th>
                    <th>Expected Result</th>
                    <th>Actual Result</th>
                    <th style="width:10%;">Status</th>
                  </tr>
                </thead>
                  <tbody id="tbody" style="height: 60vh; overflow: auto">
                  <!-- Placeholder -->
                  
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('js')
     <script>
    $(document).ready(function(){
      let counter = 1;
      let tc_id = $('#tc_id').text();
      fetchTestSteps();
      $('[data-bs-toggle="tooltip"]').each(function () { new bootstrap.Tooltip(this); });

      $('#exportBtn').on('click', function(){
        $('#btnSave').click();
        
        window.open('print?tc=' + tc_id, '_blank');
      })

      // Save test steps
      $(document.body).on("click", "#btnSave", function () {
        var dataToSend = [];

        // Iterate through each row in the table
        $("#table tbody tr").each(function () {
          var rowData = {};

          // Iterate through each cell in the row
          $(this).find("td").each(function (index, cell) {
            var columnName = $("#table thead th").eq(index).text();
            var cellData = {};

            // Extract data from different elements in the cell
            cellData["span"] = $(cell).find("span").text();
            cellData["textarea1"] = $(cell).find("[name='ts']").val();
            cellData["textarea2"] = $(cell).find("[name='td']").val();
            cellData["textarea3"] = $(cell).find("[name='er']").val();
            cellData["textarea4"] = $(cell).find("[name='ar']").val();
            cellData["input"] = $(cell).find("[name='status']").val();

            // Add the cellData object to the rowData object
            rowData[columnName] = cellData;
          });

            // Add the rowData object to the dataToSend array
            dataToSend.push(rowData);
        });

          $.ajax({
            type: "POST",
            url: "{{ route('saveTestSteps') }}",
            data: { tc_id: tc_id, data: JSON.stringify(dataToSend) },
            success: function (response) {
              $('#btnSave').addClass('btn-success').html('<i class="fas fa-check"></i> Saved');
                console.log(response);
              setTimeout(function() {
                $('#btnSave').removeClass('btn-success').html('<i class="fas fa-save"></i>');
              }, 2000);
            },
            error: function (error) {
              Swal.fire({
                      toast: true,
                      position: "top-end",
                      icon: "error",
                      title: "Server Error!",
                      html: "Check Logs",
                      showConfirmButton: false,
                      showCloseButton: true,
                  })
            console.error(error);
            },
          });
      });

      // Add new rows
      $('#addRowBtn').on('click', function(){

        counter = $('#tbody tr').length +1;
        let rowDark = '<tr>'+
                    '<td class="text-center"><span class="fw-bolder fs-3 step" id="step'+counter+'">'+counter+'</span><br>'+
                    '<button type="button" class="btn btn-link text-danger btnDeleteRow"><i class="fas fa-trash"></i></button> </td>'+
                    '<td><textarea name="ts" rows="3" class="form-control modalField dark-input text-white ts"></textarea></td>'+
                    '<td><textarea name="td" rows="3" class="form-control modalField dark-input text-white td"></textarea></td>'+
                    '<td><textarea name="er" rows="3" class="form-control modalField dark-input text-white er"></textarea></td>'+
                    '<td><textarea name="ar" rows="3" class="form-control modalField dark-input text-white ar"></textarea></td>'+
                    '<td>'+
                    '<input type="text" name="status" class="selectStatus d-none" value="Pass">'+
                    '<div class="btn btn-outline-success py-4 mx-4 fs-4 fw-bolder text-uppercase selectStatusBtn">Pass</div>'+
                    '</td>'+
                  '</tr>';
        let rowLight = '<tr>'+
                    '<td class="text-center"><span class="fw-bolder fs-3 step" id="step'+counter+'">'+counter+'</span><br>'+
                    '<button type="button" class="btn btn-link text-danger btnDeleteRow"><i class="fas fa-trash"></i></button> </td>'+
                    '<td><textarea name="ts" rows="3" class="form-control modalField ts"></textarea></td>'+
                    '<td><textarea name="td" rows="3" class="form-control modalField td"></textarea></td>'+
                    '<td><textarea name="er" rows="3" class="form-control modalField er"></textarea></td>'+
                    '<td><textarea name="ar" rows="3" class="form-control modalField ar"></textarea></td>'+
                    '<td>'+
                    '<input type="text" name="status" class="selectStatus d-none" value="Pass">'+
                    '<div class="btn btn-outline-success py-4 mx-4 fs-4 fw-bolder text-uppercase selectStatusBtn">Pass</div>'+
                    '</td>'+
                  '</tr>';
        if (isDarkMode === "true") {
          $('#tbody').append(rowDark);
        }else{
          $('#tbody').append(rowLight);
        }
        counter++;
      });

      // Delete new rows
      $('#tbody').on('click', '.btnDeleteRow', function() {
          let step = $(this).closest('tr').find('.step').text();
          $(this).closest('tr').remove();
          counter--;

          $.ajax({
            type: "POST",
            url: "{{ route('deleteTestSteps') }}",
            data: { 'step_num': step, 'tc_id': tc_id},
            success: function (response) {
               Swal.fire({
                  toast: true,
                  position: "top-end",
                  icon: "success",
                  title: "Deleted Step #"+step,
                  showConfirmButton: false,
                  timer: 1000,
                  timerProgressBar: true,
              });
            },
            error: function (error) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Server Error!",
                    html: "Check Logs",
                    showConfirmButton: false,
                    showCloseButton: true,
                })
                console.error(error);
            },
          });
      });

      // Change status appearance
      $('#tbody').on('click', '.selectStatusBtn', function(e){
  
        let val = $(this).text();

        if(val == 'Pass')
        {
          $(this).removeClass('btn-outline-success text-success').addClass('btn-outline-danger text-danger').text('Fail');
          $(this).closest('tr').find('.selectStatus').val('Fail');
        }
        else if(val == 'Fail')
        {
          $(this).removeClass('btn-outline-danger text-danger').addClass('btn-outline-success text-success').text('Pass');
          $(this).closest('tr').find('.selectStatus').val('Pass');
        }
      });

      function fetchTestSteps()
      {
         $.ajax({
            type: "POST",
            url: "{{ route('fetchTestSteps') }}",
            data: { tc_id: tc_id},
            success: function (response) {
              $('#tbody').html(response.html);

              if (isDarkMode === "true") {
                $('.modalField').addClass('dark-input text-white');
              }else{
                $('.modalField').removeClass('dark-input text-white');
              }

              $('#tbody .selectStatusBtn').each(function () {
                 let selectedValue = $(this).closest('tr').find('.selectStatus').val();
                  // Check the selected value for each select element
                  if (selectedValue === 'Pass') {
                    $(this).removeClass('btn-outline-danger text-danger').addClass('btn-outline-success text-success').text('Pass');
                  } else if (selectedValue === 'Fail') {
                    $(this).removeClass('btn-outline-success text-success').addClass('btn-outline-danger text-danger').text('Fail');
                  } else {
                    $(this).removeClass('btn-outline-success btn-outline-danger text-success').addClass('btn-outline-warning text-warning').html('<i class="fas fa-2x fa-question"></i>');
                  }
              });
            },
            error: function (error) {
                  Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Server Error!",
                            html: "Check Logs",
                            showConfirmButton: false,
                            showCloseButton: true,
                        })
                  console.error(error);
            },
          });
      }

    });
  </script>
@endsection