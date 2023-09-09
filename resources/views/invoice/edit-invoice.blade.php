@extends('layouts.app')

@section('content')
<div class="row page-titles mx-0">
  <div class="col-sm-6 p-md-0">
    <div class="welcome-text">
      <h4>Edit Invoice</h4>
    </div>
  </div>
  <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('invoice.index') }}">Invoice</a></li>
      <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Invoice</a></li>
    </ol>
  </div>
</div>
<!-- row -->
<div class="row">

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('invoice.update',$invoice->id) }}" id="invoice-form" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Masters/Mr</label>
                <input type="text" name="masters" value="{{ old('masters',$invoice->masters) }}" class="form-control">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Invoice No</label>
                <input type="text" name="invoice_no" value="{{ old('invoice_no',$invoice->invoice_no) }}" class="form-control">
              </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Payment Method</label>
                <input type="text" name="payment_method" value="{{ old('payment_method',$invoice->payment_method) }}" class="form-control">
              </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Date</label>
                <input type="date" name="invoice_date" value="{{ old('invoice_date',date($invoice->invoice_date->format('Y-m-d'))) }}" class="form-control">
              </div>
            </div>
            
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Gross Amount</label>
                <input type="text" name="gross_amount" value="{{ old('gross_amount',$invoice->gross_amount) }}" class="form-control">
              </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Discount</label>
                <input type="text" name="discount" value="{{ old('discount',$invoice->discount) }}" class="form-control">
              </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label class="form-label">Net Amount</label>
                <input type="text" name="net_amount" value="{{ old('net_amount',$invoice->net_amount) }}" class="form-control">
              </div>
            </div>
            
          </div>

          <div class="input_fields_wrap">
            <div class="row lable-colum">
              <div class="col-sm-6 col-md-2">
                <label>Description</label>
              </div>

              <div class="col-sm-6 col-md-2">
                <label>Unit</label>
              </div>

              <div class="col-sm-6 col-md-2">
                <label>QTY</label>
              </div>

              <div class="col-sm-6 col-md-2">
                <label>Unit Price</label>
              </div>

              <div class="col-sm-6 col-md-2">
                <label>Amount</label>
              </div>

            </div>
    <?php
    if($invoice->fields){
      $i = 0;
        foreach ($invoice->fields as $key => $field){ ?>
          <div class="row row-parent">
              <input type="hidden" name="fields[{{$i}}][id]" value="{{ $field->id }}">
              <div class="col-sm-6 col-md-2 my-1">
                <input type="text" placeholder="Description" name="fields[{{$i}}][description]" value="{{ $field->description }}" class="form-control">
              </div>

              <div class="col-sm-6 col-md-2 my-1">
                <input type="text" placeholder="Unit" class="form-control" name="fields[{{$i}}][unit]" value="{{ $field->unit }}">
              </div>

              <div class="col-sm-6 col-md-2 my-1">
                <input type="number" placeholder="QTY" class="form-control" name="fields[{{$i}}][qty]" value="{{ $field->qty }}">
              </div>

              <div class="col-sm-6 col-md-2 my-1">
                <input type="number" placeholder="Unit Price" class="form-control" name="fields[{{$i}}][unit_price]" value="{{ $field->unit_price }}">
              </div>

              <div class="col-sm-6 col-md-2 my-1">
                <input type="number" placeholder="Amount" class="form-control" name="fields[{{$i}}][amount]" value="{{ $field->amount }}">
              </div>
              <div class="col-sm-6 col-md-2 my-1">
                  <button type="button" data-fieldid="{{ $field->id }}" class="remove_field btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
              </div>
              <hr>
            </div>
            
    <?php 
          $i++;
        }
    }
    ?>
          </div>
          <div class="form-btn mt-3">
            <button type="button" class="add_field_button btn btn-success">Add More</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection


@push('js')
<script type="text/javascript">
  $(document).ready(function () {
    function hideShow() {
      if ($('#carType').val() == "carSubType") {
        $('#subTypeSelection').hide();
        $('#car-image').hide();
      } else {
        $('#subTypeSelection').show();
        $('#car-image').show();
      }
    }
    hideShow();
    $('#carType').change(function() {
      hideShow();
    });

      var max_fields = 1000;
      var wrapper = $(".input_fields_wrap");
      var add_button = $(".add_field_button");

      var x = '{{ count($invoice->fields) }}'; //initlal text box count
      $(add_button).click(function(e) {
        //on add input button click
        e.preventDefault();
        if (x < max_fields) {
          //max input box allowed
          x++; //text box increment
          var appendText = '<div class="row mt-3 row-parent ">'+
          '<div class="col-sm-6 col-md-2 my-1">'+
          '<input type="text" placeholder="Description" name="fields['+x+'][description]" class="form-control">'+
          '</div>'+

          '<div class="col-sm-6 col-md-2 my-1">'+
          '<input type="text" placeholder="Unit"  class="form-control" name="fields['+x+'][unit]">'+
          '</div>'+

          '<div class="col-sm-6 col-md-2 my-1">'+
          '<input type="number" placeholder="QTY" class="form-control" name="fields['+x+'][qty]">'+
          '</div>'+

          '<div class="col-sm-6 col-md-2 my-1">'+
          '<input type="number" class="form-control" placeholder="Unit Price" name="fields['+x+'][unit_price]">'+
          '</div>'+

          '<div class="col-sm-6 col-md-2 my-1">'+
          '<input type="number" class="form-control" placeholder="Amount" name="fields['+x+'][amount]">'+
          '</div>'+
          '<div class="col-sm-6 col-md-2 my-1">'+
          '<button type="button" class="remove_field btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>'+
          '</div>'+
          '<hr></div>';
          $(wrapper).append(appendText); // add input boxes.
        }
      });

      $(wrapper).on("click",".remove_field",function(e) {
          e.preventDefault(); 
          $(this).parents('.row-parent').remove(); x--;
          var fieldId = $(this).attr('data-fieldid');
          if(fieldId){
            deleteField(fieldId);
          }
      });
        
      function deleteField(fieldId){
        var token = '{{ csrf_token() }}';
          $.ajax({
            url: '{{ route("deleteField") }}',
            type: 'POST',
            data: {_token:token,fieldId: fieldId},
            success: function(response) {
              if(response.status == 200 ){
                toastr.success("Success", response.msg, tosterOption);
              }
            },
            error: function(error) {
              console.log('Error:', error);
            }
          });
      }
        
  });
</script>
@endpush