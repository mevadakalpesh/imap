@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Category</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Users</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
   
        <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type_type" class="form-control">
             <option value="Service">Service</option>
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
          
          
          
        <hr>
        <h2>Fields</h2>
        <?php 
        $data = [
        "type",
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