@extends('layouts.default')

@section('title', 'Dashboard')

@section('nav_items')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('dashboard') }}">
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Test Cases</p>
                    <h5 class="font-weight-bolder">
                      {{ $totalTestCases }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Projects</p>
                    <h5 class="font-weight-bolder">
                      {{ $totalProjects }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Projects</p>
                    <h5 class="font-weight-bolder">
                      {{ $activeProjects }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Inactive Projects</p>
                    <h5 class="font-weight-bolder">
                      {{ $inactiveProjects }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    </div>
    <div class="containter mt-5 mx-5">
        <div class="row">
        <div class="card">
            <div class="card-header">
              Recent Projects
            </div>
            <div class="card-body">
              <div class="container w-75">
                <ul class="list-group">
              @foreach($recent as $row)

                <a href="/test-cases?pid={{ $row['project_id'] }}">
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                      <div class="d-flex align-items-center">
                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                          <i class="ni ni-box-2 text-white opacity-10"></i>
                        </div>
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">{{ $row['project_name'] }}</h6>
                            <span class="text-xs float-start">{{ $row['project_desc'] }}</span>
                            <span class="text-xs font-weight-bold float-end">
                            @php
                              $dateTime = new DateTime( $row['last_access'] );
                              echo $dateTime->format('h:i A - M d, Y');
                            @endphp
                            </span>
                          </div>
                      </div>
                      <div class="d-flex">
                        <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                      </div>
                  </li>
                </a>

                <hr class="horizontal dark">
                @endforeach
              </ul>
              </div>
            </div>
        </div>
    </div>
    </div>
@endsection