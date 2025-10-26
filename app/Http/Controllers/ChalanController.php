<?php

namespace App\Http\Controllers;

use App\Models\Chalan;
use App\Models\ChalanDetails;
use App\Models\Equipment;
use App\Models\Machine;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ChalanController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Get the logged-in user
            $user = Auth::user();

            // Check if the user has the required permission
            // if (!$user->hasPermissionTo('chalan')) {
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
        return view('backend.chalan');
    }
    public function getChalanData()
    {
        $employees = Chalan::select('*')->latest();

        return Datatables::of($employees)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="view btn btn-secondary btn-sm viewProduct">View</a><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        // dd($request->ALL());
        try {
            DB::beginTransaction();
            $chalan=Chalan::updateOrCreate([
                'id' => $request->product_id
            ], [
                'customer' => $request->customer,
                'customer_mobile' => $request->customer_mobile,
                'chalan_number' => $request->chalan_number,
                'address' => $request->address,
                'is_billing' => $request->is_billing,
                'date' => $request->date,
                'chalan_by' => $request->chalan_by,
            ]);
            // dd('/sdlkfjsd');
            if ($request->product_id) {
                ChalanDetails::where('chalan_id', $request->product_id)->delete();
            }
            foreach ($request->particulars as $key => $particular) {
                if ( !is_null($particular)) {
                    $detais=ChalanDetails::create([
                        'quantity' => $request['quantity'][$key],
                        'remarks' => $request['remarks'][$key],
                        'particulars' => $particular,
                        'unit' => $request['unit'][$key],
                        'chalan_id' => $chalan->id,
                    ]);
                    // dump( $chalan->id.'=>'.$detais);
                }
            }
            DB::commit();
            $message = ($request->product_id != '') ? 'Chalan Data Updated Successfully.' : 'New Chalan Added Successfully.';
            return response()->json(['success' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             DB::rollBack();
            Log::error($e->getMessage());
            return  response()->json('Could Not Perform This Operation. Please Try Again.');
        } catch (\Throwable $th) {
             DB::rollBack();
            Log::error($th->getMessage());
            return  response()->json('Could Not Perform This Operation. Please Try Again.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Chalan::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Chalan::with(['chalanDetails' 
        // => function ($query) {
        //     $query;
        //   }
          ])
        ->find($id);
        // dd( $product);
        return response()->json(['chalan'=>$product,'count'=>$product->chalanDetails->count()]);
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
        Chalan::find($id)->delete();

        return response()->json(['success' => 'Equipment Has Been deleted successfully.']);
    }
    public function getEquipmentList()
    {
        $product = Chalan::get()->transform(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });
        return response()->json($product);
    }
}
