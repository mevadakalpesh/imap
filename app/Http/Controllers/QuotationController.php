<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\InvoiceField;
use Illuminate\Support\Facades\Validator;
use DataTables;

class QuotationController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    if ($request->ajax()) {
      $data = Quotation::get();
      return Datatables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function($row) {
        $btn = '<a href="'.route('quotation.edit', $row->id).'" data-quotationid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
        <button type="button" data-quotationid="'.$row->id.'" class="btn delete-quotation btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
        <a target="_blank" href="'.route('generatePDF', ['id' => $row->id, "type" => "Quotation"]).'" data-quotationid="'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></a>';
        return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }
    return view('quotation.quotation-list');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create() {
    return view('quotation.create-quotation');
  }


  public function generatePDF(Request $request) {
    $id = $request->id;
    $type = $request->type;
    $data = ['title' => 'My PDF'];
    $pdf = PDF::loadView('pdf.quotation', $data);
    return $pdf->download('example.pdf');
  }



  /**
  * Store a newly created resource in storage.
  */


  public function store(Request $request) {

    $request->validate([
      'sub_total' => 'required',
      'quotation_date' => 'required',
      //'ref_no' => 'required|unique:quotations',
      // 'fields.*.description' => 'required',
      'fields.*.unit' => 'required',
      'fields.*.qty' => 'required|numeric',
      'fields.*.unit_price' => 'required|numeric',
      'fields.*.amount' => 'required|numeric',
    ]);

    try {
      $quotation = Quotation::create([
        'quotation_to' => isset($request->quotation_to) ? $request->quotation_to : null,
        'quotation_attn' => isset($request->quotation_attn) ? $request->quotation_attn : null,
        'quotation_title' => isset($request->quotation_title) ? $request->quotation_title : null,
        'ref_no' => isset($request->ref_no) ? $request->ref_no : null,
        'your_ref' => isset($request->your_ref) ? $request->your_ref : null,
        'quotation_date' => isset($request->quotation_date) ? $request->quotation_date  : null,
        'quotation_from' => isset($request->quotation_from) ? $request->quotation_from : null,
        'fax' => isset($request->fax) ? $request->fax : null,
        'subject' => isset($request->subject) ? $request->subject : null,
        'sub_total' => isset($request->sub_total) ? $request->sub_total : null,
        'sub_total_qar' => isset($request->sub_total_qar) ? $request->sub_total_qar : null,
      ]);

      if (!blank($request->fields)) {
        foreach ($request->fields as $field) {
          $data = [
            'invoice_id' => $quotation->id,
            'description' => $field['description'] ?? "",
            'unit' => $field['unit'] ?? "",
            'qty' => $field['qty'] ?? 0,
            'unit_price' => $field['unit_price'] ?? 0,
            'amount' => $field['amount'] ?? 0,
            'type' => "Quotation"
          ];
          InvoiceField::create($data);
        }
      }
      session()->flash('success', 'success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('quotation.index');
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
    $quotation = Quotation::with(['fields'])->find($id);
    return view('quotation.edit-quotation', [
      'quotation' => $quotation
    ]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id) {

    $request->validate([
      'sub_total' => 'required',
      'quotation_date' => 'required',
      'ref_no' => 'required|unique:quotations,ref_no,'.$id,
      //'fields.*.description' => 'required',
      'fields.*.unit' => 'required',
      'fields.*.qty' => 'required|numeric',
      'fields.*.unit_price' => 'required|numeric',
      'fields.*.amount' => 'required|numeric',
    ]);
    try {

      $quotation = Quotation::where('id', $id)->update([
        'quotation_to' => isset($request->quotation_to) ? $request->quotation_to : null,
        'quotation_attn' => isset($request->quotation_attn) ? $request->quotation_attn : null,
        'quotation_title' => isset($request->quotation_title) ? $request->quotation_title : null,
        'ref_no' => isset($request->ref_no) ? $request->ref_no : null,
        'your_ref' => isset($request->your_ref) ? $request->your_ref : null,
        'quotation_date' => isset($request->quotation_date) ? $request->quotation_date  : null,
        'quotation_from' => isset($request->quotation_from) ? $request->quotation_from : null,
        'fax' => isset($request->fax) ? $request->fax : null,
        'subject' => isset($request->subject) ? $request->subject : null,
        'sub_total' => isset($request->sub_total) ? $request->sub_total : null,
        'sub_total_qar' => isset($request->sub_total_qar) ? $request->sub_total_qar : null,
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
            'type' => "Quotation"
          ];
          $Fieldid = isset($field['id']) ? $field['id'] : 0;

          InvoiceField::updateOrCreate([
            'id' => $Fieldid
          ], $data);
        }
      }

      session()->flash('success', 'success');
    } catch (\Exception $e) {
      session()->flash('error', $e->getMessage());
    }
    return redirect()->route('quotation.index');

  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id) {
    Quotation::where('id', $id)->delete();
    return response()->json(['status' => 200, 'msg' => 'Success']);
  }

}