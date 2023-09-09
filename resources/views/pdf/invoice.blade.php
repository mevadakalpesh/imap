<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
  <title>Invoice-{{$invoice->id}}</title>
  <style>
    body {
      font-family: DejaVu Sans, serif;
    }

    .rtl {
      width: 100%;
      text-align: center;
      direction: rtl;
    }
    .rtl, .title-div {
      font-family: Amiri, sans-serif;
    }


    .address strong {
      display: block;
      font-size: 16px;
    }

    .header {
      max-height: 250px;
      display: flex;
    }


    .header .logo img {
      width: 150px;
      height: auto;
      position: relative;
      padding: 0px 15px;
    }

    .table-1 table {
      text-align: center;
      width: 100%;
      font-weight: bold;
    }

    .table-2 table {
      width: 100%;
      margin: 30px 0px;
      font-weight: bold;
      text-align: center;
    }

    .table-3 {
      width: 100%;
      margin-top: 40px;

      font-weight: bold;
      text-align: center;
    }

    .title-div {
      margin: 0px;
      width: 100%;
      height: auto;
    }


    .main {
      padding-top: 10px;
      width: 100%;
      / background-color: red;
      /
    }

    .table-2 .teb-td {
      width: 80px;
    }


    .all-table table,
    .all-table th,
    .all-table td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .mine-footer {
      display: flex;
      width: 100%;
      min-width: 500px;
    }

    .mine-footer .footer {
      position: relative;
      width: 30%;
    }

    .mine-footer .footer img {
      width: 100%;
    }

    .mine-footer .warramrty {
      width: 100%;
    }

    .mine-footer .warramrty ul li {
      padding: 0;
      margin: 0;
      line-height: 15px;
    }

    .mine-footer .footer-img {
      width: 30%;
      position: relative;
    }

    .mine-footer .footer-img img {
      width: 100%;
      margin: 0px;
      padding: 0px;
      position: absolute;
      right: 0;
    }

    .table-6 table {
      width: 100%;
      font-weight: 900;
      font-size: 25px;
    }
    .text-right {
      text-align: right ;
    }
    .header_image {
      /* padding: 0px 10px; */
    }
    .footer-content {
      margin-left: 30px;
    }
    
  </style>
</head>

<body>
  <div class="table-6">
    <table width="100%">
      <tr>
        <td><strong>Phone: +97477000451</strong></td>
        <td rowspan="5"><img
          width="200px"
          src="{{ asset('/images/craop.jpg') }}"
          alt=""
          class="header_image"
          /></td>
      <td class="text-right"><strong>+97477000451 جوال </strong></td>
    </tr>
    <tr>
      <td> <strong>AlDoha - Area 26</strong></td>
      <td class="text-right"> <strong>26 الدوحة  - منطقة</strong></td>
    </tr>
    <tr>
      <td> <strong>Str 940 - Najma</strong></td>
      <td class="text-right"> <strong>شارع 940 - النجمة</strong></td>
    </tr>
    <tr>
      <td><strong>Office 201</strong></td>
      <td class="text-right"><strong>مكتب 201</strong></td>
    </tr>
  </table>
</div>
<div class="main">
  <div class="title-div">
    <h2 class="rtl" style="font-family: 'Amiri', serif;">كليك اند فيكس للسيـــارات</h2>
    <h2 class="rtl">Click and Fix</h2>
  </div>
</div>

<div class="all-table">
  <div class="table-1" width="100%">
    <table>
      <tr>
        <td width="50%">Masters/Mr السيد\السادة</td>
        <td width="25%">Invoice No رقم الفاتورة </td>
        <td width="25%">Date تاريخ </td>
      </tr>
      <tr>
        <td rowspan="2" width="50%">{{ $invoice->masters ?? "-" }}</td>
        <td width="25%">{{ $invoice->invoice_no ?? "-" }}</td>
        <td width="25%">{{ $invoice->invoice_date->format('Y-m-d') ?? "-" }}</td>
      </tr>
      <tr>
        <td width="25%">Payment Method ع طريقة</td>
        <td width="25%">{{ $invoice->payment_method ?? "Cash" }} </td>
      </tr>
    </table>
  </div>
  <div class="table-2" width="100%">
    <table>
      <tr>
        <td width="10%">الرقم<br> Sl No.</td>
        <td width="40%">التفاصيل<br>DISCRIPTION</td>
        <td width="15%">الوحدة<br>unit</td>
        <td width="10%">الكمية<br>Qty</td>
        <td width="10%" class="teb-td">سعر الوحدة <br>Unit PriceQrs.</td>
        <td  class="teb-td">المبلغ<br>Amount Qrs.</td>
      </tr>
      <?php if (isset($invoice->fields) && !empty($invoice->fields)) {
        $i = 1;
        foreach ($invoice->fields as $field) {
          ?>
          <tr>
            <td>{{ $i }}</td>
            <td>{{ $field->description ?? "-" }}</td>
            <td>{{ $field->unit ?? "-" }}</td>
            <td>{{ $field->qty ?? "-" }}</td>
            <td>{{ $field->unit_price ?? "-" }}</td>
            <td>{{ $field->amount ?? "-" }}</td>
          </tr>
          <?php $i++;
        }
      } ?>

    </div>
  </table>
  <div class="table-3">
    <table width="100%">
      <tr>
        <td width="50%">Gross Amount - المجموع</td>
        <td width="50%">{{ $invoice->gross_amount ?? "-" }}</td>
      </tr>
      @if($invoice->discount)
      <tr>
        <td width="50%"> Discount - الخصم</td>
        <td width="50%">{{ $invoice->discount ?? 0 }} </td>
      </tr>
      @endif
      <tr>
        <td width="50%"> Net Amount -  الصافي  </td>
        <td width="50%">{{ $invoice->net_amount ?? 0 }}</td>
      </tr>
    </table>
  </div>
</div>
</div>


<table width="100%">
<tr>
<td style="width: 50%;">
<h3>Authorized Agent For</h3>
<img style="width: 30%;"
src="{{ asset('/images/craop.jpg') }}"
alt="">
</td>

<td style="width: 50%;text-align:right;">
<img
style="width: 30%;position: relative;left: 0;"
src="{{ asset('/images/bottomlogo.jpg') }}"
alt="">
</td>
</tr>
</table>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
$(document).ready(function() {
window.print();
window.onfocus=function(){ window.close();}
});
</script>
</body>
</html>