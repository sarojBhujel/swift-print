<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Get the logged-in user
            $user = Auth::user();
            
            // Check if the user has the required permission
            // if (! $user->hasPermissionTo('quotation')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quotation');
    }
    public function userList()
    {
        $product = Customer::get()->transform(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Quotation::updateOrCreate([
            'id' => $request->product_id
        ], [
          'customer_id'=>$request->customer_id,
          'job_name'=>$request->job_name,
        //   'quotation_no'=>$request->quotation_no,
          'print'=>$request->print,
          'quantity'=>$request->quantity,
          'page'=>$request->page,
          'size'=>$request->size,
          'lamination'=>$request->lamination,
          'binding'=>$request->binding,
          'rate'=>$request->rate,
          'note'=>$request->note,
          'address'=>$request->address,
          'date'=>$request->date,
          'size'=>$request->size,
          'paper'=>$request->paper,
        ]);
        $message = ($request->product_id != '') ? 'Quotation Data Updated Successfully.' : 'New Quotation Added Successfully.';
        return response()->json(['success' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Quotation::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quotation::find($id)->delete();

        return response()->json(['success' => 'Quotation deleted successfully.']);
    }

    public function getQuotationData()
    {
        $employees = Quotation::select('*')->latest();

        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="view btn btn-secondary btn-sm viewProduct">VIew</a><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Print" class="btn btn-warning btn-sm download-pdf">Print</a>';
                $btn=$btn.'<a href="'.route('generatePdf', $row->id).'" target="_blank" class="btn btn-success btn-sm ">Print</a>';
                return $btn;
            })
            // ->editColumn('customer_id', function($data){
            //     return !is_null($data->customers)?$data->customers->name:null;
            // })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function generatePDF($id){
        
        $dompdf = new Dompdf();

        // Get the dynamic Blade view content as HTML
        $html = $this->renderDynamicBladeView($id);
    
        // Set the HTML content for PDF generation
        $dompdf->loadHtml($html);
    
        // (Optional) Adjust PDF options if needed
        $dompdf->setPaper('A4', 'portrait');
    
        // Render the PDF content
        $dompdf->render();
    
        // Output the generated PDF to the browser for download
        return $dompdf->stream('generated_pdf.pdf');
        //$pdf = PDF::loadAndCaptureStylesheets('quotationDesign',compact('data'));

        //$fileName =  $quatation->quotation_no.'_'.time().'.'. 'pdf' ;
        // $pdf->save(public_path() . '/' . $fileName);

        // $pdf = public_path($fileName);
        // return response()->download($pdf);
        //return $pdf->download( $fileName);
    }
    public function renderDynamicBladeView($id)
    {
    // You can pass any dynamic data you need for the Blade view
        $quatation=Quotation::find($id);
        $signasture=Signature::where('is_active',1)->first();
        $data=[
            'customer_id'=>$quatation->customer_id,
            'address'=>$quatation->address,
            'job_name'=>$quatation->job_name,
            'quotation_no'=>$quatation->quotation_no,
            'print'=>$quatation->print,
            'quantity'=>$quatation->quantity,
            'page'=>$quatation->page,
            'size'=>$quatation->size,
            'lamination'=>$quatation->lamination,
            'date'=>$quatation->date,
            'binding'=>$quatation->binding,
            'paper'=>$quatation->paper,
            'rate'=>$quatation->rate,
            'note'=>$quatation->note,
            'name'=>!is_null($signasture)?$signasture->name:null,
            'position'=>!is_null($signasture)?$signasture->position:null,
            'signature'=>!is_null($signasture)?asset('img/'.$signasture->image):null,
        ];

        // Render the Blade view and capture the output as HTML
        // $html = View::make('quotationDesign',compact('data'))->render();

        // return response()->json(['html' => $html]);
        return view('backend.quotationDesign',compact('data'));
    }
    public function getLatestQuotation()
        {
            $product = Quotation::latest()->first();
            if (!$product) {
               return response()->json(1);
            }
            $quotation_no =$product->quotation_no+1;
            return response()->json($quotation_no);
        }
   
}
