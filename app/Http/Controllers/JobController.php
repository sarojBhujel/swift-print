<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Get the logged-in user
            $user = Auth::user();
            
            // Check if the user has the required permission
            // if (! $user->hasPermissionTo('job')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        return view('backend.jobs.jobindex');
    }
    public function getDataTableData(Request $request)
    {
        // dd($request->search['value']);
        // $users = User::select(['id', 'name', 'email', 'created_at'])
        // ->orderBy($request->input('column_name'), $request->input('column_sort'))
        // ->paginate($request->input('length'));
        // dd($request->all());
        try{

            $columns = [
                'customer_id',
                'name',
                // ...
            ];
            
            $employees = Job::with(['customers', 'papers', 'equipments'])->select('jobs.id','job_number','date','jobs.name','print_color','print_type','plate_set','plate_date','paper_size','quantity','numbering','lamination','binding','paper_weight','customers.name AS customer_name')->leftJoin('customers', 'jobs.customer_id', '=', 'customers.id');
            if ($request->has('order')) {
                $order = $request->input('order');
                $columnIndex = $order[0]['column']; 
                $columnName = $request->input('columns')[$columnIndex]['data'];
                
                if ($columnName!='DT_RowIndex') {
                    # code...
                    $employees->orderBy($columnName, $order[0]['dir']);
                }else{

                    $employees->orderBy('jobs.created_at', 'desc');
                }
            } else {
                $employees->orderBy('jobs.created_at', 'desc');
            }
            
            return Datatables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
    
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="view btn btn-secondary btn-sm viewProduct">View</a><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
    
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                    return $btn;
                })
                // ->editColumn('customer_id', function ($data) {
                //     return !is_null($data->customers) ? $data->customers->name : null;
                // })
                ->editColumn('paper_id', function ($data) {
                    return !is_null($data->papers) ? $data->papers->name : null;
                })
                ->editColumn('eqipment_id', function ($data) {
                    return !is_null($data->equipments) ? $data->equipments->name : null;
                })
                ->filterColumn('customer_name', function ($query, $keyword) {
                    $query->where('customers.name', 'like', "%$keyword%");
                })
                ->rawColumns(['action', 'eqipment_id', 'paper_id'])
                ->toJson();
        }catch(\Exception $e){
            \Log::error($e);
            return $e->getMessage();
        }
    }
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
        $customer=Customer::where('id',$request->customer_id)->first();
        if ($customer) {
            $request->merge(['customer_id' =>$request->customer_id]);
        } else {
            $newCUs=Customer::create([
                'name'=>$request->customer_id
            ]);
            $request->merge(['customer_id' =>$newCUs->id]);
        }
        
       $data= [
            'name' => $request->name,
            'customer_id' => (!is_null($request->customer_id)&& $request->customer_id !='null' &&$request->customer_id !='undefined')?$request->customer_id:null,
            'paper_id' => (!is_null($request->paper_id)&& $request->paper_id !='null' &&$request->paper_id !='undefined')?$request->paper_id:null,
            'eqipment_id' => (!is_null($request->eqipment_id)&& $request->eqipment_id !='null' &&$request->eqipment_id !='undefined')?$request->eqipment_id:null,
            'print_color' => $request->print_color,
            'print_type' => $request->print_type,
            'plate_set' => $request->plate_set,
            'plate_date' => $request->plate_date,
            'paper_size' => $request->paper_size,
            'quantity' => $request->quantity,
            'numbering' => $request->numbering,
            'lamination' => $request->lamination,
            'binding' => $request->binding,
            'job_number' => $request->job_number,
            'date' => $request->date,
            'is_customer_supplied_paper' => ($request->exists('is_customer_supplied_paper') && $request->is_customer_supplied_paper == 'true') ? 1 : 0,
            'customer_supplied_paper' => ($request->exists('is_customer_supplied_paper') && $request->is_customer_supplied_paper == 'true') ? $request->customer_supplied_paper : null,
            'is_customer_supplied_ctp' => ($request->exists('is_customer_supplied_ctp') && $request->is_customer_supplied_ctp == 'true') ? 1 : 0,
            'customer_supplied_ctp' => ($request->exists('is_customer_supplied_ctp') && $request->is_customer_supplied_ctp == 'true') ? $request->customer_supplied_ctp : null,
            'billing' =>($request->exists('billing') && $request->billing == 'true') ? 1 : 0,
            'market' => ($request->exists('market') && $request->market == 'true') ?1 : 0,
            'office' => ($request->exists('office') && $request->office == 'true') ? 1 : 0,
            'note' => ($request->exists('note')) ? $request->note : null,
            'paper_weight' => $request->paper_weight,
            // 'image' => $filename
        ];
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = date('y-m-d-h-i-s') . '' . $file->getClientOriginalName();
            $file->move('img', $filename);
            if ($request->product_id != null) {
                $loc = Job::find($request->product_id);
                $delete = public_path('img/' . $loc);
                if (file_exists($loc)) {
                    unlink($delete);
                }
            }
            $data['image']=$filename;
        }
        Job::updateOrCreate([
            'id' => $request->product_id
        ], $data);
        $message = ($request->product_id != '') ? 'Job Have Been Updated Successfully.' : 'New Job Added Successfully.';
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
        $product = Job::find($id);
        $data=[

            'id' => $product->id,
            'name' => $product->name,
            'customer_id' => $product->customer_id,
            'paper_id' => $product->paper_id,
            'eqipment_id' => $product->eqipment_id,
            'print_color' => $product->print_color,
            'print_type' => $product->print_type,
            'plate_set' => $product->plate_set,
            'plate_date' => $product->plate_date,
            'paper_size' => $product->paper_size,
            'quantity' => $product->quantity,
            'numbering' => $product->numbering,
            'lamination' => $product->lamination,
            'binding' => $product->binding,
            'is_customer_supplied_paper' => $product->is_customer_supplied_paper==1?true:false,
            'job_number' => $product->job_number,
            'date' => $product->date,
            'customer_supplied_paper' => $product->customer_supplied_paper,
            'is_customer_supplied_ctp' => $product->is_customer_supplied_ctp==1?true:false,
            'customer_supplied_ctp' =>  $product->customer_supplied_ctp ,
            'market' =>  $product->market==1?true:false ,
            'office' =>  $product->office==1?true:false ,
            'billing' =>  $product->billing==1?true:false ,
            'note' =>  $product->note ,
            'paper_weight' => $product->paper_weight,
            'customer_name' => $product->customers->name,
            'image' => !is_null($product->image)?asset('img/'.$product->image):null
        ];
        return response()->json($data);
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
        Job::find($id)->delete();

        return response()->json(['success' => 'Customer deleted successfully.']);
    }
    public function createCustomer(Request $request ){
        Customer::create([
            'name'=>$request->name
        ]);
        return response()->json('created customer',200);
    }
}
