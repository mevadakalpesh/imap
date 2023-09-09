@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Add Brands</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brands</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Brands</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
   
       <div class="form-group">
           <label class="form-label">Type</label>
           <select id="serviceType" name="type" class="form-control">
            <option value="Brand">Brand</option>
            <option value="Emergency">Emergency</option>
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

          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control">
          </div>
          
          
          
        <div id="Fields">
        <hr>
        <h2>Fields</h2>
          
        
        <?php 
        $data = [
         "selectCar",
         "pickLocation",
         "manufactory",
         "batteryVoltage",
         "withService",
         "carLicense",
         "carLicense2",
         "withFilter",
         "pickDate",
         "startTime",
         "endTime",
         "note",
         "phone",
         "PaymentMethod",
        ];
        
        foreach ($data as $fiedls){?>
          <div class="form-group">
            <label class="form-label"><?php echo $fiedls; ?></label>
            <input type="checkbox" name="<?php echo $fiedls; ?>" >
          </div>
          <?php  } ?>
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
$(document).ready(function (){
  $('#serviceType').change(function(){
    if($(this).val() == "Emergency"){
    $('#Fields').hide();
    }else{
      $('#Fields').show();
    }
  });
});

</script>

@endpush