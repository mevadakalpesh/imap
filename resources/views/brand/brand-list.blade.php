@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Brand & Emergency</h4>
      <div class="d-flex">
        
      <a class="btn btn-info" href="{{  route('brand.create') }}">Add Brand & Emergency</a>

      </div>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Brand & Emergency</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <div class="table-responsive">
          
          <table id="brandTable" class="display" style="min-width: 845px">
        <thead>
            <tr>
                <th>No</th>
                <th>Name (En) </th>
                <th>Name (AR) </th>
                <th>Image</th>
                <th>Price </th>
                <th>Type </th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
      
        </div>
      </div>
    </div>
  </div>

</div>

@endsection


@push('js')
<script type="text/javascript">
  $(function () {
    
    var dataTable = $('#brandTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('brand.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'en_name', name: 'en_name'},
            {data: 'ar_name', name: 'ar_name'},
            {data: 'image', name: 'image'},
            {data: 'price', name: 'price'},
            {data: 'type', name: 'type'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    
    $(document).on('click','.delete-brand',function(){
      if(confirm('are you sure delete this brand?')){
          var deleteUrl = '{{ route("brand.destroy","%brand%") }}' ;
          var brand_id = $(this).attr('data-brandid');
           deleteUrl = deleteUrl.replace('%brand%',brand_id);
          var _token = '{{ csrf_token() }}';
           $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data:{_token:_token,brand_id:brand_id},
                dataType: 'json',
                success: function(response) {
                  if(response.status == 200){
                      // Clear the existing table data
                      toastr.success("Success",response.msg, tosterOption);
                      dataTable.clear().draw();
                      // Add new data to the table
                      //dataTable.rows.add(response).draw();
                  }else {
                    toastr.error("Error",response.msg, tosterOption);
                  }
                },
                error: function(xhr, status, error) {
                    // Handle error if necessary
                    console.error(error);
                }
            });
          }
    });
    
  
    
  });
</script>

@endpush