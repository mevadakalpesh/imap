@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Car Type Edit</h4>
      <p>
        {{ $theCarType->en_name }}
      </p>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('car-type.index') }}">Car Type</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('car-type.update',$theCarType->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          
          <div class="form-group">
            <label class="form-label">Type</label>
            <select id="carType" name="type" class="form-control">
              <option value="Car" <?php if($theCarType->type == "Car"){ echo 'selected'; } ?> >Car</option>
              <option value="carSubType" <?php if($theCarType->type == "carSubType"){ echo 'selected'; } ?> >Sub Car</option>
            </select>
          </div>
          
          
          <?php
          $selectCarType = [];
          if (!blank($theCarType->carSubType)) {
            $selectCarType = $theCarType->carSubType->pluck('id')->toArray();
          }
          ?>
          <div class="form-group" id="subTypeSelection">
            <label class="form-label">Car Sub Type</label>
            <select name="carSubType[]" multiple class="form-control">
              <?php
              foreach ($carTypes as $carType) {
                $selectData = "";
                if (in_array($carType->id, $selectCarType)) {
                  $selectData = "selected";
                }
                ?>
                <option {{ $selectData }} value="{{ $carType->id }}">{{ $carType->en_name }}</option>
                <?php
              } ?>
            </select>
          </div>


          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" value="{{ old('en_name',$theCarType->en_name)  }}" name="en_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" value="{{ old('ar_name',$theCarType->ar_name)  }}" name="ar_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ $theCarType->image }}" width="100px" height="100px">
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
      } else {
        $('#subTypeSelection').show();
      }
    }
    hideShow();
    $('#carType').change(function() {
      hideShow();
    });
  });

</script>
@endpush