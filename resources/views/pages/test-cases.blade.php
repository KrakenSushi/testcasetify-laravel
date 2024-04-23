@extends('..layouts.default')

@section('title', 'Test Cases')

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
   <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="float-start">
                    <span class="fs-4">Select a Project:</span>
                </div>
                <div class="float-end d-flex justify-content-end">
                    
                    <div>
                        <select name="selectedProject" id="selectedProject" class="form-control modalField fw-bolder" style="width:250px">
                            <option selected hidden value="0">-- Choose Project --</option>
                            @foreach ($projects as $item)
                                <option value="{{ $item -> project_id }}">{{ $item -> project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        {{-- <button type="button" class="btn btn-link px-1" id="unsetProjectBtn"><i class="fas fa-times"></i></button> --}}
                    </div>
                    <div>
                        <a href="{{ route('newTestCase') }}" id="btnNewTC" class="btn btn-success ms-2 mb-0 d-none"><i class="fas fa-plus"></i> New Test Case</a>
                    </div>
                </div>
            </div>
        </div>
   </div>
   <div class="row mt-5 px-4">
    <div class="card">
        <div class="card-body" id="testCasesList">
            <h3 class="text-warning fw-bolder text-uppercase text-center my-5">Choose a project</h3>
        </div>
    </div>
   </div>
@endsection
@section('js')
    <script>
        let clickCounter = 0;

        $('#testCasesList').on('click', '.btnDeleteTC', function(){
            let proj_id = {{ session('active_project') }};
            let id = $(this).data('id');
            clickCounter++;

            console.log(clickCounter);

            if(clickCounter == 2){
                $.ajax({
                    method: "post",
                    url: "{{ route('deleteTC') }}",
                    data: {'tc_id' : id},
                    success: function(response){
                        //Set active_project session value
                        $.ajax({
                            type  : 'post',
                            url   : '{{ route("setActiveProject") }}',
                            data  :  { 'project_id': proj_id },
                            success: function(response){
                                clickCounter = 0;
                                if(typeof response =='object'){
                                    $('#testCasesList').html(response.html);
                                }else{
                                    $('#testCasesList').html(response);
                                }
                                
                            },
                            error: function(error){
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
                            }
                        }); //End inner AJAX
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "success",
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                    },
                    error: function(error){
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
                    }
                }); //End Outer AJAX
            }else{
                $(this).removeClass('btn-warning').addClass('btn-danger').html('<i class="fas fa-question"></i>');

                setTimeout(() => {
                    $(this).removeClass('btn-danger').addClass('btn-warning').html('<i class="fas fa-trash"></i>');
                    clickCounter = 0;
                }, 2000);
            }
            
        }); // End event listener
        $('#selectedProject').on('change', function(){
            let selectedProjectID = $(this).val();
            console.log('ProjectID: '+selectedProjectID);
            if(selectedProjectID !== 0)
                { $('#btnNewTC').removeClass('d-none'); }
            else
                { $('#btnNewTC').addClass('d-none'); }
            
            //Set active_project session value
            $.ajax({
                type  : 'post',
                url   : '{{ route("setActiveProject") }}',
                data  :  { 'project_id': selectedProjectID },
                success: function(response){
                    // console.log(response);
                    if(typeof response =='object'){
                        $('#testCasesList').html(response.html);
                    }else{
                        $('#testCasesList').html(response);
                    }
                },
                error: function(error){
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
                }
            });

            // $('#unsetProjectBtn').on('click', function(){
            //     $.ajax({
            //         type  : 'post',
            //         url   : '{{ route("unsetActiveProject") }}',
            //         success: function(response)
            //         {
            //             console.log('success');
            //             setTimeout(function() {
            //                 location.reload();
            //                 }, 1000);
            //         },
            //         error: function(error)
            //         {
            //             Swal.fire({
            //                     toast: true,
            //                     position: "top-end",
            //                     icon: "error",
            //                     title: "Server Error!",
            //                     html: "Check Logs",
            //                     showConfirmButton: false,
            //                     showCloseButton: true,
            //             })
            //                 console.error(error);
            //         },
            //     });
            // })
           
        });
    </script>
    @if(session()->has('active_project'))
      <script>
            let val = {{ session('active_project') }};

            $('#selectedProject').val({{ session('active_project') }});
            $('#btnNewTC').removeClass('d-none');

            $.ajax({
                type  : 'post',
                url   : '{{ route("setActiveProject") }}',
                data  :  { project_id: val },
                success: function(response)
                {
                    if(typeof response =='object'){
                        $('#testCasesList').html(response.html);
                    }else{
                        $('#testCasesList').html(response);
                    }
                },
                error: function(error)
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
                        console.error(error);
                },
            });
      </script>
    @endif
    @if(request()->has('pid'))
      <script>
        let pid = {{ $_GET['pid'] }};
         $('#selectedProject').val(pid);

         $.ajax({
            type  : 'post',
            url   : '{{ route("setActiveProject") }}',
            data  :  { project_id: pid },
            success: function(response)
            {
                if(typeof response =='object'){
                    $('#testCasesList').html(response.html);
                }else{
                    $('#testCasesList').html(response);
                }
            },
            error: function(error)
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
                    console.error(error);
            },
        });

        if(pid != 0)
          {$('#btnNewTC').removeClass('d-none');}
        else
          {$('#btnNewTC').addClass('d-none');}
      </script>
    @endif
@endsection
