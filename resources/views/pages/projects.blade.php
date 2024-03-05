@extends('..layouts.default')

@section('title', 'Projects')

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
        <a class="nav-link active" href="{{ route('projects') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Projects</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{ route('test-cases') }}">
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
   <div class="row">
        <div class="card">
            <div class="card-header">
                <span class="mb-0 fs-4 fw-bolder  float-start">Project List</span>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                    <i class="fas fa-plus"></i></i> New Project
                </button>
            </div>
            <div class="card-body">
                @if($rowCount == 0)
                    <center>
                        <h3 class="text-warning text-uppercase">No Projects Found</h3>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                            Create one <i class="fas fa-plus"></i>
                        </button>
                    </center>
                @else
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Project Name</th>
                            <th>Project Members</th>
                            <th>Project Description</th>
                            <th>Status</th>
                            <th style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($project as $item)
                            <tr>
                                
                                <td>{{ $item -> project_name }}</td>
                                <td>{{ $item -> project_members }}</td>
                                <td>{{ $item -> project_desc }}</td>
                                <td>
                                    @if($item -> status == 1)
                                        <button type="disabled" class="btn btn-success btn-block ">ACTIVE</button>
                                    @else
                                        <button type="disabled" class="btn btn-warning btn-block ">INACTIVE</button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" data-id="{{ $item -> project_id }}" class="btn btn-warning btnEdit me-2">Edit <i class="fas fa-pencil-alt"></i></=>
                                    <button type="button" data-id="{{ $item -> project_id }}" class="btn btn-danger btnDelete">Delete <i class="fas fa-trash"></i></=>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @endif
            </div>
        </div>
   </div>

     <!-- Add Modal -->
  <div class="modal fade " id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">New Project</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('saveProject') }}" method="post" id="newProjectForm">
            @csrf
            <div class="form-group">
              <label for="p_name">Project Name: <span class="text-danger">*</span></label>
              <input type="text" name="p_name" id="p_name" class="form-control modalField" placeholder="Input Project Name" required>
            </div>

            <div class="form-group">
              <label for="p_members">Project Members: <span class="text-danger">*</span></label> 
              <textarea name="p_members" id="p_members" class="form-control modalField" rows="5" placeholder="Input Project Members" required></textarea>
              <span class="float-end text-xs mb-0 pb-0">Separate by comma or a new line</span>
            </div>

            <div class="form-group">
              <label for="p_desc">Project Description:</label>
              <textarea name="p_desc" id="p_desc" class="form-control modalField" rows="5" placeholder="Input Project Description"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer pb-0 d-flex justify-content-between">
          <div class="ms-0">
            <span class="text-xs text-danger ps-3 mb-2">
              * Required Field
            </span>
          </div>
          <div class="">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            <button type="submit" class="btn bg-gradient-primary" name="saveProjectBtn" form="newProjectForm"><i class="fas fa-save"></i> Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Edit Modal -->
  <div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Update Project</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('updateProject') }}" method="post" id="editProjectForm">
            @csrf
            <input type="hidden" name="proj_id" id="proj_id">
            
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="edit_p_name">Project Name: <span class="text-danger">*</span></label>
                </div>
                <div class="col">
                  <div class="float-end d-flex align-items-center">
                    <div class="form-check form-switch ps-0 ms-auto my-auto d-flex align-items-center me-2">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="statusToggle" name="projStatus">
                    </div>
                    <span class="text-xs me-1" for="statusToggle">Project Status:</span>
                    <span id="proj_statusLabel" class="text-uppercase fw-bolder text-xs text-success">Active</span>
                  </div>
                </div>
              </div>
              <input type="text" name="edit_p_name" id="edit_p_name" class="form-control modalField">
            </div>

            <div class="form-group">
              <label for="edit_p_members">Project Members: <span class="text-danger">*</span></label> 
              <textarea name="edit_p_members" id="edit_p_members" class="form-control modalField" rows="5"></textarea>
              <span class="float-end text-xs mb-0 pb-0">Separate by comma or a new line</span>
            </div>

            <div class="form-group">
              <label for="edit_p_desc">Project Description:</label>
              <textarea name="edit_p_desc" id="edit_p_desc" class="form-control modalField" rows="5"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer pb-0 d-flex justify-content-between">
          <div class="ms-0">
            <span class="text-xs text-danger ps-3 mb-2">
              * Required Field
            </span>
          </div>
          <div class="">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            <button type="submit" class="btn bg-gradient-primary" form="editProjectForm"><i class="fas fa-pencil-alt"></i> Update Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Delete <span id="delProjName" class="fw-bolder"></span> ?</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p id="delProjDesc" class="text-center"></p>

            <hr class="horizontal dark mt-0">
            <h6 class="fw-bold">Members:</h6>
            <span id="delProjMembers"></span>
        </div>
        <div class="modal-footer pb-0 float-end">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
            <a href="/deleteProject?id=" id="deleteConfirmBtn" class="btn bg-gradient-danger"><i class="fas fa-trash"></i> Delete</a>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
    <script>
        $('.btnEdit').on('click', function(){
            let id = $(this).data('id');
            console.log(id);

            $.ajax({
                type : 'post',
                url  : '{{ route("fetchProjectInfo") }}',
                data : { project_id: id },
                success: function(response){
                    $('#proj_id').val(response.project_id);
                    $('#edit_p_name').val(response.project_name);
                    $('#edit_p_members').text(response.project_members);
                    $('#edit_p_desc').text(response.project_desc);
                    if(response.status == 1)
                        { 
                          $('#statusToggle').prop('checked', true);
                          $('#proj_statusLabel').removeClass('text-danger').addClass('text-success').text('Active'); 
                        }
                    else
                        { 
                          $('#statusToggle').prop('checked', false); 
                          $('#proj_statusLabel').removeClass('text-success').addClass('text-danger').text('Inctive');
                        }
                },
                error:function(error)
                {
                     Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Server Error!",
                        html: "Check Logs",
                        showConfirmButton: false,
                        showCloseButton: true,
                    })
                    console.error("Error: "+ error);
                }
            });
            $('#editProjectModal').modal('show');
        });

        $('.btnDelete').on('click', function(){
            let id = $(this).data('id');
            // console.log(id);
            $('#deleteConfirmBtn').attr('href', '/deleteProject?id='+id);
             $.ajax({
                type : 'post',
                url  : '{{ route("fetchProjectInfo") }}',
                data : { project_id: id },
                success: function(response){
                    $('#delProjName').text(response.project_name);
                    $('#delProjMembers').text(response.project_members);
                    $('#delProjDesc').text(response.project_desc);
                },
                error:function(error)
                {
                     Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Server Error!",
                        html: "Check Logs",
                        showConfirmButton: false,
                        showCloseButton: true,
                    })
                    console.error("Error: "+ error);
                }
            });
            $('#deleteProjectModal').modal('show');
        });

        $('#statusToggle').on('change', function(){
            if($('#statusToggle').prop('checked'))
                { $('#proj_statusLabel').removeClass('text-danger').addClass('text-success').text('Active'); }
            else
                { $('#proj_statusLabel').removeClass('text-success').addClass('text-danger').text('Inctive'); }
        });

    </script>
@endsection