@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Engine Type Edit</h4>
      <p>
        {{ $theEngineType->en_name }}
      </p>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('engine-type.index') }}">Engine Type</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('engine-type.update',$theEngineType->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")

          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" value="{{ old('en_name',$theEngineType->en_name)  }}" name="en_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" value="{{ old('ar_name',$theEngineType->ar_name)  }}" name="ar_name" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@push('js')

@endpush