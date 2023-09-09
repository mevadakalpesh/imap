<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quotation-{{$quotation->id}}</title>
  <style>
    body {
      font-family: DejaVu Sans, serif;
    }

    .rtl {
      width: 100%;
      text-align: center;
      direction: rtl;
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

    .title-div {
      margin: 0px;
      width: 100%;
      height: auto;
      text-align: center;
    }


    .main {
      padding-top: 10px;
      width: 100%;
    }

    .table-1 table,
    .table-1 th,
    .table-1 td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .table-1 table {
      text-align: center;
      width: 100%;
      font-weight: bold;
    }

    .teble-6 {
      width: 100%;
      font-weight: bold;
      border: none;
    }

    .teble-6 tr,
    td,
    img {
      padding: 0px 10px;
    }

    .teble-6 {
      width: 100%;
    }
    .teble-7 table {
      width: 100%;

    }

    .Conditions {
      width: 100%;
      align-items: center;
    }

    .total-sub {
      width: 100%;
    }

    .total-sub table,
    .total-sub tr,
    .total-sub td,
    .total-sub h4 {
      text-align: end;
      width: 100%;
      font-weight: bold;
    }

    .Conditions table,
    .Conditions tr,
    .Conditions td,
    .Conditions h4 {

      text-align: center;
    }
    .Delivery .acceptable {
      font-size: 15px;
    }
    .Delivery .intrest {
      margin-top: 40px;
    }
    .Fix {
      text-align: center;
      font-weight: bold;
    }

    .table-6 table {
      width: 100%;
      font-weight: 900;
      font-size: 25px;
    }
    .text-right {
      text-align: right;
    }

  </style>
</head>

<body>
  <div class="table-6">
    <table width="100%">
      <tr>
        <td><strong>Phone: +97477000451</strong></td>
        <td rowspan="5"><img width="200px" src="{{ asset('/images/craop.jpg') }}" alt=""></td>
        <td class="text-right"><strong>+97477000451 جوال </strong></td>
      </tr>
      <tr>
        <td> <strong>AlDoha - Area 26</strong></td>
        <td class="text-right"> <strong>26 الدوحة - منطقة</strong></td>
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
      <h2 class="rtl">كليك اند فيكس للسيـــارات</h2>
      <h2 class="rtl">Click and Fix</h2>
      <h2>Quotation</h2>
    </div>
  </div>
  <div class="table-1">
    <table width="100%">
      <tr>
        <td width="20%" rowspan="2">TO</td>
        <td width="40%" rowspan="2">{{ $quotation->quotation_to ?? "-" }}</td>
        <td>Ref No</td>
        <td>Date تاريخ </td>
      </tr>
      <tr>
        <td>{{ $quotation->ref_no ?? "-" }}</td>
        <td>{{ $quotation->quotation_date->format('Y-m-d') ?? "-" }}</td>
      </tr>
      <tr>
        <td width="20%">Attn</td>
        <td width="40%">{{ $quotation->quotation_attn ?? "-" }}</td>
        <td>From</td>
        <td>{{ $quotation->quotation_from ?? "-" }}</td>
      </tr>
      <tr>
        <td width="20%">Title</td>
        <td width="40%">{{ $quotation->quotation_title ?? "-" }} </td>
        <td>Fax </td>
        <td>{{ $quotation->quotation_title ?? "-" }} </td>
      </tr>
      <tr>
        <td width="20%">Your Ref</td>
        <td width="40%">{{ $quotation->your_ref ?? "-" }}</td>
        <td>Subject</td>
        <td>{{ $quotation->subject ?? "-" }}</td>
      </tr>
    </table>
  </div>
  <div class="dear-sir">
    <p style="margin:30px 0px">
      Dear Sir <br>
      <br>
      We have a pleasure in submitting our offer for you as follows
    </p>
  </div>
  <div class="table-1">
    <table width="100%">
      <tr>
        <td width="10%" >الرقم<br> Sl No.</td>
        <td width="40%">التفاصيل<br>DISCRIPTION</td>
        <td width="15%">الوحدة<br>unit</td>
        <td width="10%">الكمية<br>Qty</td>
        <td width="10%" class="teb-td">سعر الوحدة <br>Unit PriceQrs.</td>
        <td width="10%" class="teb-td">المبلغ<br>Amount Qrs.</td>
      </tr>
      <?php if (isset($quotation->fields) && !empty($quotation->fields)) {
        $i = 1;
        foreach ($quotation->fields as $field) {
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

    </table>
  </div>

  <div class="total-sub" style="margin-top:7%">
    <table width="100%">
      <tr style="text-align:right">
        <td>Sub Total</td>
        <td></td>
        <td>{{ $quotation->sub_total ?? "-" }}</td>
      </tr>
      <tr style="text-align:right">
        <td>Total QAR</td>
        <td></td>
        <td>{{ $quotation->sub_total_qar ?? "-" }}</td>
      </tr>
    </table>
  </div>

  <div class="Conditions">
    <table width="100%">
      <tr>
        <td>
          <h4>validity</h4>
        </td>
        <td>
          <h4>Upon Request</h4>
        </td>
        <td>
          <h4>Terms & Conditions</h4>
        </td>
      </tr>
    </table>
  </div>
  <div class="Delivery">
    <table width="100%">
      <tr>
        <td width="80%">
          <h3>Delivery</h3>
          <p class="acceptable">
            Hope our rates are acceptable to you and awaiting your valued order. Please feel to contact us
            on +97477000451 for
            any information of your intrest
          </p>
        </td>
        <td width="20%">
          <img class="intrest" width="100%" src="{{ asset('/images/bottomlogo.jpg') }}" alt="">
        </td>
      </tr>
    </table>
  </div>

  <h2> Terms And Conditions</h2>
  <p>
    All quotations and references to costs and financial commitments made or made by the
    seller are based on the assumption that the correctness of the information provided to be
    absolutely accurate and true in all circumstances. Seller reserves the right at any stage to
    renegotiate any contract, cost agreement or other related obligation in the event if any
    information provided by the Buyer fails to be completely true and accurate. offer Valid for 48
    hours from the date of order .
  </p>
  <div>

  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script>
    $(document).ready(function() {
      window.print();
      window.onfocus=function(){ window.close();}
    });
  </script>
</body>

</html>