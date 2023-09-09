@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Invoice</h4>
      <div class="d-flex">
        <a class="btn btn-info" href="{{  route('invoice.create') }}">Add Invoice</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Invoice</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <div class="table-responsive">

          <table id="invoiceTable" class="display" style="min-width: 845px">
            <thead>
              <tr>
                <th>No</th>
                <th>Masters/Mr</th>
                <th>Invoice No</th>
                <th>Invoice Date</th>
                <th>Payment Method</th>
                <th>Gross Amount</th>
                <th>Discount</th>
                <th>Net Amount</th>
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

    var dataTable = $('#invoiceTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('invoice.index') }}",
      columns: [
        {
        data: 'DT_RowIndex', name: 'DT_RowIndex'
        },
        {
          data: 'masters', name: 'masters'
        },
        {
          data: 'invoice_no', name: 'invoice_no'
        },
        {
          data: 'payment_method', name: 'payment_method'
        },
        {
          data: 'invoice_date', name: 'invoice_date'
        },
        {
          data: 'gross_amount', name: 'gross_amount'
        },
        {
          data: 'discount', name: 'discount'
        },
        {
          data: 'net_amount', name: 'net_amount'
        },
        {
          data: 'created_at', name: 'created_at'
        },
        {
          data: 'action', name: 'action', orderable: false, searchable: false
        }
      ]
    });


    $(document).on('click', '.delete-invoice', function() {
      if (confirm('are you sure delete this invoice?')) {
        var deleteUrl = '{{ route("invoice.destroy","%invoice%") }}';
        var carType_id = $(this).attr('data-invoiceid');
        deleteUrl = deleteUrl.replace('%invoice%', carType_id);
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