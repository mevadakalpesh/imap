@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Add Car Types</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('car-type.index') }}">Car Types</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Car Types</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('car-type.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label class="form-label">Type</label>
            <select id="carType" name="type" class="form-control">
              <option value="Car">Car</option>
              <option value="carSubType">Sub Car</option>
            </select>
          </div>


          <div class="form-group" id="subTypeSelection">
            <label class="form-label">Car Sub Type</label>
            <select name="carSubType[]" multiple class="form-control">
              <?php foreach ($carTypes as $carType) {
                ?>
                <option value="{{ $carType->id }}">{{ $carType->en_name }}</option>
                <?php
              } ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" name="en_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" name="ar_name" class="form-control">
          </div>

          <div class="form-group" id="car-image">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
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
  $(document).ready(function () {
    function hideShow() {
      if ($('#carType').val() == "carSubType") {
        $('#subTypeSelection').hide();
        $('#car-image').hide();
      } else {
        $('#subTypeSelection').show();
        $('#car-image').show();
      }
    }
    hideShow();
    $('#carType').change(function() {
      hideShow();
    });
  });

</script>
@endpush