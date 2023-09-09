@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Brand Category</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Brand Category</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <form action="{{ route('brand-category.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
        
         <div class="form-group">
            <label class="form-label">Select Brands</label>
            <select multiple name="brands[]" class="form-control">
            
             <?php foreach ($brands as $key => $value){ ?>
                <option value="{{ $value->id }}">{{  $value->en_name }}</option>
             <?php } ?>
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