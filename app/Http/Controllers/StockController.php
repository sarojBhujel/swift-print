<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Paper;
use App\Models\PaperStock;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Get the logged-in user
            $user = Auth::user();
            
            // Check if the user has the required permission
            // if (! $user->hasPermissionTo('inventory')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index($paper_id)
    {
        $paper=Paper::find($paper_id);
        
        $stock=PaperStock::where('paper_id',$paper_id)->latest()->first('balance');
        $balance=$stock?$stock->balance:0;
        return view('backend.paperStock',compact('paper','balance'));
    }
    public function getbalance($paper_id)
    {
        // dd($paper_id);
        $stock=Paper::where('id',$paper_id)->first('balance');
        $balance=$stock?$stock->balance:0;
        // dd($balance);
        return ['balance'=>$balance];
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
        $validatedData = $request->validate([
            'paper_id' => ['required', 'exists:papers,id'],
        ]);
        if(auth()->user()->can('inventory')){
            $paper=Paper::find($request->paper_id);
            if ($request->type=='issue') {
                $data=[
                    'balance'=> $paper->balance-$request->quantity
                ];
            } else {
                $data=[
                    'balance'=> $paper->balance+$request->quantity
                ];
            }
            
            $paper->update($data);
            PaperStock::updateOrCreate([
                'id' => $request->product_id
            ], [
              'paper_id'=>$request->paper_id,
              'bill_no'=>$request->bill_no,
              'date'=>$request->date,
              'supplier'=>$request->supplier,
              'quantity'=>$request->quantity,
              'type'=>$request->type,
              'balance'=>$request->balance,
            ]);
            $message = ($request->product_id != '') ? 'Paper Stock Data Updated Successfully.' : 'New Paper Stock Added Successfully.';
            return response()->json(['success' => $message]);
        }else {
            return response()->json(['error' => 'You Do Not Have Permission.'],403);
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
        $product = PaperStock::find($id);
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
        // dd($id);
        PaperStock::find($id)->delete();

        return response()->json(['success' => 'Paper Stock deleted successfully.']);
    }

    public function getStockData($paper_id)
    {
        // dd($paper_id);
        $employees = PaperStock::where('paper_id',$paper_id)->select('*')->latest();

        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->addColumn('receive', function ($row) {
                return $row->type=='receive'?$row->quantity:null;
            })
            ->addColumn('issue', function ($row) {
                return $row->type=='issue'?$row->quantity:null;
            })
            // ->editColumn('customer_id', function($data){
            //     return !is_null($data->customers)?$data->customers->name:null;
            // })
            ->rawColumns(['action','receive','issue'])
            ->make(true);
    }
}
