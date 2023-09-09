@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Add Engine Types</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('engine-type.index') }}">Engine Types</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Engine Types</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('engine-type.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
    
          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" name="en_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" name="ar_name" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@push('js')
<script type="text/javascript">


</script>
@endpush