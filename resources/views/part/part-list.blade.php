@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Part </h4>
      <div class="d-flex">
        
      <a class="btn btn-info" href="{{  route('part.create') }}">Add Part </a>
      
      </div>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Parts</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <div class="table-responsive">
          
          <table id="PartTable" class="display" style="min-width: 845px">
        <thead>
            <tr>
                <th>No</th>
                <th>Name (En) </th>
                <th>Name (AR) </th>
                <th>Image</th>
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
    
    var dataTable = $('#PartTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('part.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'en_name', name: 'en_name'},
            {data: 'ar_name', name: 'ar_name'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    
    $(document).on('click','.delete-part',function(){
      if(confirm('are you sure delete this Part?')){
          var deleteUrl = '{{ route("part.destroy","%Part%") }}' ;
          var Part_id = $(this).attr('data-partid');
           deleteUrl = deleteUrl.replace('%Part%',Part_id);
          var _token = '{{ csrf_token() }}';
           $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data:{_token:_token,Part_id:Part_id},
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