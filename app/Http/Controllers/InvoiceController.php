<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Quotation;

use App\Models\InvoiceField;
use Illuminate\Support\Facades\Validator;
use DataTables;
use PDF;
class InvoiceController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = Invoice::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('invoice.edit', $row->id).'" data-invoiceid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-invoiceid="'.$row->id.'" class="btn delete-invoice btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
        <a href="'.route('generatePDF',['id' => $row->id,"type" => "Invoice"]).'" target="_blank" data-invoiceid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></a>';
        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }
    return view('invoice.invoice-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    return view('invoice.create-invoice');
  }


  public function generatePDF(Request $request) {
    $id = $request->id ;
    $type = $request->type; 
   if($id && $type){
    if($type == 'Invoice'){
      $invoice = Invoice::where('id',$id)->with(['fields'])->first();
      if($invoice){
        return view('pdf.invoice',['invoice' => $invoice]);
      } else {
        abort(404);
      }
    }else {
      $quotation = Quotation::where('id',$id)->with(['fields'])->first();
       if($quotation){
         return view('pdf.quotation',['quotation' => $quotation]);
       } else {
         abort(404);
       }
    }
   }
  }
  

  /**
  * Store a newly created resource in storage.
  */


  public function store(Request $request) {

    $request->validate([
      'masters' => 'required',
      'invoice_no' => 'required|unique:invoices',
      'payment_method' => 'required',
      'invoice_date' => 'required',
      'gross_amount' => 'required',
      'discount' => 'required',
      'net_amount' => 'required',
      //'fields.*.description' => 'required',
      'fields.*.unit' => 'required',
      'fields.*.qty' => 'required|numeric',
      'fields.*.unit_price' => 'required|numeric',
      'fields.*.amount' => 'required|numeric',
    ]);

    try {
      $invoice = Invoice::create([
        'masters' => $request->masters,
        'invoice_no' => $request->invoice_no,
        'payment_method' => $request->payment_method,
        'invoice_date' => $request->invoice_date,
        'gross_amount' => $request->gross_amount,
        'discount' => $request->discount,
        'net_amount' => $request->net_amount,
      ]);
      if (!blank($request->fields)) {
        foreach ($request->fields as $field) {
          $data = [
            'invoice_id' => $invoice->id,
            'description' => $field['description'] ?? "",
            'unit' => $field['unit'] ?? "",
            'qty' => $field['qty'] ?? 0,
            'unit_price' => $field['unit_price'] ?? 0,
            'amount' => $field['amount'] ?? 0,
            'type' => "Invoice"
          ];
          InvoiceField::create($data);
        }
      }
      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('invoice.index');
  }

  /**
  * Display the specified resource.
  */
  public function show(string $id) {
    //
  }

  /**
  * Show the form for editing the specified resource.
  */
  public function edit(string $id) {
    $invoice = Invoice::with(['fields'])->find($id);
    return view('invoice.edit-invoice',[
      'invoice' => $invoice
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {
   
   $request->validate([
      'masters' => 'required',
      'invoice_no' => 'required|unique:invoices,invoice_no,'.$id,
      'payment_method' => 'required',
      'invoice_date' => 'required',
      'gross_amount' => 'required',
      'discount' => 'required',
      'net_amount' => 'required',
     // 'fields.*.description' => 'required',
      'fields.*.unit' => 'required',
      'fields.*.qty' => 'required|numeric',
      'fields.*.unit_price' => 'required|numeric',
      'fields.*.amount' => 'required|numeric',
    ]);

   
    try {
      
      $invoice = Invoice::where('id',$id)->update([
        'masters' => $request->masters,
        'invoice_no' => $request->invoice_no,
        'payment_method' => $request->payment_method,
        'invoice_date' => $request->invoice_date,
        'gross_amount' => $request->gross_amount,
        'discount' => $request->discount,
        'net_amount' => $request->net_amount,
      ]);
      
      if (!blank($request->fields)) {
        foreach ($request->fields as $field) {
          $data = [
            'invoice_id' => $id,
            'description' => $field['description'] ?? "",
            'unit' => $field['unit'] ?? "",
            'qty' => $field['qty'] ?? 0,
            'unit_price' => $field['unit_price'] ?? 0,
            'amount' => $field['amount'] ?? 0,
            'type' => "Invoice"
          ];
          $Fieldid = isset($field['id']) ? $field['id'] : 0;
          
          InvoiceField::updateOrCreate([
            'id' => $Fieldid
          ],$data);
        }
      }

      session()->flash('success','success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('invoice.index');
   
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    Invoice::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }
  
  public function deleteField(Request $request){
    $fieldId = $request->fieldId;
    InvoiceField::where('type','Invoice')->where('id',$fieldId)->delete();
    return response()->json(['status' => 200,'msg' => "delete Successfully"]);
  }
}