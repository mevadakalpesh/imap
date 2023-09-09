@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Edit Service</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Service</a></li>
    </ol>
  </div>
</div>



<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('service.update',$service->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
        <?php 
             $selectBrandCategory = [];
             if( !blank($service->serviceCategories) ){
               $selectBrandCategory = $service->serviceCategories->pluck('id')->toArray();
             }
        ?>
          <div class="form-group">
            <label class="form-label">Select Brands</label>
            <select multiple name="serviceCategories[]" class="form-control">
             <?php foreach ($brandCategory as $key => $value){
               $selectData = "";
              if(in_array($value->id,$selectBrandCategory)){
                $selectData = "selected";
              }
             ?>
                <option {{ $selectData }} value="{{ $value->id }}">{{  $value->en_name }}</option>
             <?php } ?>
            </select>
          </div>
          
          
          <div class="form-group">
            <label class="form-label">Name (EN)</label>
            <input type="text" name="en_name" value="{{ old('en_name',$service->en_name)  }}"   class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" name="ar_name" value="{{ old('ar_name',$service->ar_name)  }}"  class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
                        <img src="{{ $service->image }}" width="100px" height="100px">
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