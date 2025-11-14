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
            
            $employees = Job::with(['customers', 'papers', 'equipments'])->select('jobs.id','job_number','date','delivery_date','jobs.name','total_page','quantity','binding','customers.name AS customer_name')->leftJoin('customers', 'jobs.customer_id', '=', 'customers.id');
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
            'job_number' => $request->job_number,
            'date' => $request->date,
            'delivery_date' => $request->delivery_date,
            'job_description' => $request->job_description,
            'inner' => $request->inner,
            'outer' => $request->inner,
            'page_type'=>$request->page_type,
            'total_page'=>$request->total_page,
            'size'=>$request->size,
            'total_plate'=>$request->total_plate,
            'total_farma'=>$request->total_farma,
            'plate_by'=>$request->plate_by,
            'plate_from'=>$request->plate_from,
            'plate_size'=>$request->plate_size,
            'machine_id'=>$request->machine_id,
            'paper_by'=>$request->paper_by,
            'paper_details'=>$request->paper_details,
            'lamination_thermal'=>$request->lamination_thermal,
            'lamination_normal'=>$request->lamination_normal,
            'folding'=>$request->folding,
            'binding'=>$request->binding,
            'stich'=>$request->stich,
            'additional'=>$request->additional,
            'related_to'=>$request->related_to,
            'remarks'=>$request->remarks,
            'special_instruction'=>$request->special_instruction,
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

            'name'=>$product->name,
            'customer_id'=>$product->customer_id,
            'paper_id'=>$product->paper_id,
            'job_number'=>$product->job_number,
            'date'=>$product->date,
            'delivery_date'=>$product->delivery_date,
            'job_description'=>$product->job_description,
            'inner'=>$product->inner,
            'outer'=>$product->outer,
            'page_type'=>$product->page_type,
            'total_page'=>$product->total_page,
            'size'=>$product->size,
            'total_plate'=>$product->total_plate,
            'total_farma'=>$product->total_farma,
            'plate_by'=>$product->plate_by,
            'plate_from'=>$product->plate_from,
            'plate_size'=>$product->plate_size,
            'machine_id'=>$product->machine_id,
            'paper_by'=>$product->paper_by,
            'paper_details'=>$product->paper_details,
            'lamination_thermal'=>$product->lamination_thermal,
            'lamination_normal'=>$product->lamination_normal,
            'folding'=>$product->folding,
            'binding'=>$product->binding,
            'stich'=>$product->stich,
            'additional'=>$product->additional,
            'related_to'=>$product->related_to,
            'remarks'=>$product->remarks,
            'special_instruction'=>$product->special_instruction,
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
