@extends('layouts.app')

@section('content')

<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Hi, welcome back!</h4>
      <p class="mb-0">
        Your business dashboard template
      </p>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="stat-widget-two card-body">
        <div class="stat-content">
          <div class="stat-text">
            Today Expenses
          </div>
          <div class="stat-digit">
            <i class="fa fa-usd"></i>8500
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-success w-85" role="progressbar"
            aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="stat-widget-two card-body">
        <div class="stat-content">
          <div class="stat-text">
            Income Detail
          </div>
          <div class="stat-digit">
            <i class="fa fa-usd"></i>7800
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-primary w-75" role="progressbar"
            aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="stat-widget-two card-body">
        <div class="stat-content">
          <div class="stat-text">
            Task Completed
          </div>
          <div class="stat-digit">
            <i class="fa fa-usd"></i> 500
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-warning w-50" role="progressbar"
            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="card">
      <div class="stat-widget-two card-body">
        <div class="stat-content">
          <div class="stat-text">
            Task Completed
          </div>
          <div class="stat-digit">
            <i class="fa fa-usd"></i>650
          </div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-danger w-65" role="progressbar"
            aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
    <!-- /# card -->
  </div>
  <!-- /# column -->
</div>


@endsection