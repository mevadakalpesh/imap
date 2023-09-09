@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Order</h4>
    
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Order</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <div class="table-responsive">

          <table  class="table" >
            <thead>
              <tr>
                <th>No</th>
                <th>Price</th>
                <th>Payment Method</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Status</th>
                <th>carLicense</th>
                <th>carLicense2</th>
                <th>withService</th>
                <th>withFilter</th>
                <th>startTime</th>
                <th width="100px">Action</th>
              </tr>
            </thead>
            <tdody>
              <tr>
                <td>1</td>
                <td>10.00</td>
                <td>Cash</td>
                <td>72.0392883</td>
                <td>74.3982849</td>
                <td>Pending</td>
                <td>No carLicense </td>
                <td>No carLicense 2 </td>
                <td>1</td>
                <td>2</td>
                <td>2023-09-02</td>
              </tr>
            </tdody>
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

    var dataTable = $('#ngine-typeTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('engine-type.index') }}",
      columns: [{
        data: 'DT_RowIndex', name: 'DT_RowIndex'
      },
        {
          data: 'en_name', name: 'en_name'
        },
        {
          data: 'ar_name', name: 'ar_name'
        },
        {
          data: 'action', name: 'action', orderable: false, searchable: false
        },
      ]
    });


    $(document).on('click', '.delete-engine-type', function() {
      if (confirm('are you sure delete this engine-type?')) {
        var deleteUrl = '{{ route("engine-type.destroy","%engine-type%") }}';
        var carType_id = $(this).attr('data-engine-typeid');
        deleteUrl = deleteUrl.replace('%engine-type%', carType_id);
        var _token = '{{ csrf_token() }}';
        $.ajax({
          url: deleteUrl,
          type: 'DELETE',
          data: {
            _token: _token, carType_id: carType_id
          },
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              // Clear the existing table data
              toastr.success("Success", response.msg, tosterOption);
              dataTable.clear().draw();
              // Add new data to the table
              //dataTable.rows.add(response).draw();
            } else {
              toastr.error("Error", response.msg, tosterOption);
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