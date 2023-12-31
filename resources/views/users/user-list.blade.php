@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Users</h4>
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
        <div class="table-responsive">
          
          <table id="userTable" class="display" style="min-width: 845px">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>isVerified</th>
                <th>isActive</th>
                <th>Created At</th>
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
    
    var dataTable = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'isVerified', name: 'isVerified'},
            {data: 'isActive', name: 'isActive'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
    
    $(document).on('click','.delete-user',function(){
      if(confirm('are you sure delete this user?')){
          var deleteUrl = '{{ route("user.destroy","%USER%") }}' ;
          var user_id = $(this).attr('data-userid');
           deleteUrl = deleteUrl.replace('%USER%',user_id);
          var _token = '{{ csrf_token() }}';
           $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data:{_token:_token,user_id:user_id},
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
    
    
    $(document).on('click','.change-status',function(){
      var statusType = $(this).attr('data-status');
      var user_id = $(this).attr('data-userid');
      var _token = '{{ csrf_token() }}';
       $.ajax({
            url: '{{ route("changeUserStatus") }}',
            type: 'POST',
            data:{_token:_token,user_id:user_id,statusType:statusType},
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
      
    });
    
  });
</script>

@endpush