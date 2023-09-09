@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Quotation</h4>
      <div class="d-flex">
        <a class="btn btn-info" href="{{  route('quotation.create') }}">Add Quotation</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Quotation</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <div class="table-responsive">

          <table id="quotationTable" class="display" style="min-width: 845px">
            <thead>
              <tr>
                <th>No</th>
                <th>To</th>
                <th>Attn</th>
                <th>Title</th>
                <th>Ref No</th>
                <th>Your Ref</th>
                <th>Quotation Date</th>
                <th>Quotation From</th>
                <th>Fax</th>
                <th>Subject</th>
                <th>Sub Total</th>
                <th>Total QAR</th>
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

    var dataTable = $('#quotationTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('quotation.index') }}",
      columns: [{
        data: 'DT_RowIndex', name: 'DT_RowIndex'
      },
        {
          data: 'quotation_to', name: 'quotation_to'
        },
        {
          data: 'quotation_attn', name: 'quotation_attn'
        },
        {
          data: 'quotation_title', name: 'quotation_title'
        },
        {
          data: 'ref_no', name: 'ref_no'
        },
        {
          data: 'your_ref', name: 'your_ref'
        },
        {
          data: 'quotation_date', name: 'quotation_date'
        },
        {
          data: 'quotation_from', name: 'quotation_from'
        },
        {
          data: 'fax', name: 'fax'
        },
        {
          data: 'subject', name: 'subject'
        },
        {
          data: 'sub_total', name: 'sub_total'
        },
        {
          data: 'sub_total_qar', name: 'sub_total_qar'
        },
        {
          data: 'created_at', name: 'created_at'
        },
        {
          data: 'action', name: 'action', orderable: false, searchable: false
        }]
    });


    $(document).on('click', '.delete-quotation', function() {
      if (confirm('are you sure delete this quotation?')) {
        var deleteUrl = '{{ route("quotation.destroy","%quotation%") }}';
        var carType_id = $(this).attr('data-quotationid');
        deleteUrl = deleteUrl.replace('%quotation%', carType_id);
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