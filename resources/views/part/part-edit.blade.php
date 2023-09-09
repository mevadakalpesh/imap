@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Edit Part</h4>
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

        <form action="{{ route('part.update',$part->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
        <?php 
             $selectBrandCategory = [];
             if( !blank($part->brandCategories) ){
               $selectBrandCategory = $part->brandCategories->pluck('id')->toArray();
             }
        ?>
          <div class="form-group">
            <label class="form-label">Select Brand Categories</label>
            <select multiple name="brands[]" class="form-control">
            
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
            <input type="text" name="en_name" value="{{ old('en_name',$part->en_name)  }}"   class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Name (AR)</label>
            <input type="text" name="ar_name" value="{{ old('ar_name',$part->ar_name)  }}"  class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
                        <img src="{{ $part->image }}" width="100px" height="100px">
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