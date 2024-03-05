@extends('..layouts.default')

@section('title', 'Export')

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
        <a class="nav-link " href="{{ route('test-cases') }}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-ruler-pencil text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Test Cases</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('export') }}">
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
                        <a href="print-all" id="exportAllBtn" target="_blank" class="btn btn-success ms-2 mb-0 d-none"><i class="fas fa-print"></i> Export All</a>
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
        $(document).ready(function(){
            let pid = 0;

            function fetchTestCases(pid)
            {
                $.ajax({
                    type  : 'post',
                    url   : '{{ route("fetchPrintCases") }}',
                    data  :  { project_id: pid },
                    success: function(response) {
                        if(typeof response =='object'){
                            $('#testCasesList').html(response.html);
                        }else{
                            $('#testCasesList').html(response);
                            $('#exportAllBtn').addClass('d-none');
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Server Error Occured!",
                        showConfirmButton: false,
                        showCloseButton: true,
                        closeButtonAriaLabel: 'Close alert',
                        })
                        console.error('error');
                    }
                });
            }

            $('#selectedProject').on('change', function(){
                pid = $(this).val();

                fetchTestCases(pid);

                if(pid !== 0)
                    {$('#exportAllBtn').removeClass('d-none')}
                else
                    {$('#exportAllBtn').addClass('d-none');}
            });
        
        });  // Document Ready
    </script>
    @if(session()->has('active_project'))
        <script>
            let val = {{ session('active_project') }};

            $('#selectedProject').val(val);
            $('#exportAllBtn').removeClass('d-none');

            $.ajax({
                type  : 'post',
                url   : '{{ route("fetchPrintCases") }}',
                data  :  { project_id: val },
                success: function(response)
                {
                    if(typeof response =='object'){
                        $('#testCasesList').html(response.html);
                    }else{
                        $('#testCasesList').html(response);
                        $('#exportAllBtn').addClass('d-none');
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
@endsection