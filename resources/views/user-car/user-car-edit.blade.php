@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>User Car Edit</h4>
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
        <form action="{{ route('user-car.update',$theCar->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
      
          <div class="form-group">
            <label class="form-label">Car</label>
            <select  id="carSelection" name="car" class="form-control">
              <?php foreach ($carType as $key => $value) {?>
                <option <?php  if($theCar->carType->id == $value->id ){ echo 'selected'; } ?> value="{{ $value->id }}">{{  $value->en_name }}</option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group">
            <label class="form-label">Car Sub Type</label>
            <select  id="carSubSelection" name="car_sub" class="form-control">
              
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Vin Number</label>
            <input type="text" name="vinNumber" value="{{ old('vinNumber',$theCar->vinNumber)  }}" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Color</label>
            <input type="color" name="color" value="{{ old('color',$theCar->color)  }}" class="form-control">
          </div>

          <div class="form-group">
            <label class="form-label">Last Oil Change Date</label>
            <input type="datetime-local" value="{{ old('lastOilChangeDate',$theCar->lastOilChangeDate)  }}"  name="lastOilChangeDate" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Registration Number</label>
            <input type="text" name="registrationNumber" value="{{ old('registrationNumber',$theCar->registrationNumber)  }}" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Year Of Production</label>
            <input type="year" name="yearOfProduction" value="{{ old('yearOfProduction',$theCar->yearOfProduction)  }}" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Engine Power</label>
            <input type="text" name="enginePower" value="{{ old('enginePower',$theCar->enginePower)  }}" class="form-control">
          </div>
          
          <div class="form-group">
            <label class="form-label">Engine Type</label>
            <select  name="engineTypeId" class="form-control">
              <?php foreach ($engineType as $key => $value) { ?>
                <option  <?php  if($theCar->engineType->id == $value->id ){ echo 'selected'; } ?>  value="{{ $value->id }}">{{  $value->en_name }}</option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group">
            <label class="form-label">Appliction Status</label>
            <select  name="active_status" class="form-control">
                <option <?php  if($theCar->active_status == "Approved" ){ echo 'selected'; } ?> value="Approved" >Approved</option>
                <option <?php  if($theCar->active_status == "Disapproved" ){ echo 'selected'; } ?> value="Disapproved">Disapproved</option>
            </select>
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

   var parentId = $('#carSelection').val();
    var subSelectedId = '{{ $theCar->carSubType->id }}';
    getSubCar(parentId,subSelectedId);

  function getSubCar(parentId,subSelectedId){
    $('#carSubSelection').html(' ');
     var _token = '{{ csrf_token() }}';
        $.ajax({
          url: "{{ route('getSubCarById') }}",
          type: 'POST',
          data: { _token: _token, parentId: parentId,subSelectedId:subSelectedId},
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
                $('#carSubSelection').html(response.data);
            } else {
              toastr.error("Error", response.msg, tosterOption);
            }
          },
          error: function(xhr, status, error) {
            // Handle error if necessary
            toastr.error("Error", error, tosterOption);
          }
        });
  }
  
  $(document).on('change', '#carSelection', function() {
    
    var parentId = $(this).val();
    var subSelectedId = '{{ $theCar->carSubType->id }}';
    getSubCar(parentId,subSelectedId);
     
  });
</script>

@endpush