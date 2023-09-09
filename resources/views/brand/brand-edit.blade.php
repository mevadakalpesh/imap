@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Brands Edit</h4>
      <p>{{ $brand->en_name }}</p>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('brand.index') }}">Brands</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
   
<div class="form-group">
           <label class="form-label">Type</label>
           <select id="serviceType" name="type" class="form-control">
            <option value="Brand" <?php if($brand->type == 0){ echo 'selected';} ?> >Brand</option>
            <option value="Emergency" <?php if($brand->type == 1){ echo 'selected';} ?> >Emergency</option>
           </select>
       </div> 
          
          
          
          
          
          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" value="{{ old('en_name',$brand->en_name)  }}" name="en_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" value="{{ old('ar_name',$brand->ar_name)  }}" name="ar_name" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ $brand->image }}" width="100px" height="100px">
          </div>
          
          <div class="form-group">
            <label class="form-label">Price</label>
            <input type="text" value="{{ old('price',$brand->price)  }}" name="price" class="form-control">
          </div>
          
          
          
        <input type="hidden" name="fieldId" value="{{ $brand->fields->id}}">
        <div id="Fields">
        <h2>Fields</h2> 
        <hr>
        <?php 
        $fields = null;
        if(!blank($brand->fields)){
          $fields =  $brand->fields->toArray();
        }
       if($fields){
      
        foreach ($fields as $key =>  $fiedls){
          $checked = '';
          if($fiedls == 1){
            $checked="checked";
          }
          
        ?>
          <div class="form-group">
            <label class="form-label"><?php echo $key; ?></label>
            <input <?php echo $checked; ?> type="checkbox" name="<?php echo $key; ?>" >
          </div>
          <?php  } 
       }
          ?>
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
  function hideShow(){
    if($('#serviceType').val() == "Emergency"){
    $('#Fields').hide();
    }else{
      $('#Fields').show();
    }
  }
  
    hideShow();
  $('#serviceType').change(function(){
    hideShow();
  });
});
</script>

@endpush