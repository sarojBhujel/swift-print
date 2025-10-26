<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class PaperController extends Controller
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
            // if (! $user->hasPermissionTo('paper')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        return view('backend.paper');
    }
    public function getPaperData()
    {
        $employees = Paper::select('*')->latest();
 
        return Datatables::of($employees)
             ->addIndexColumn()
             ->addColumn('action', function($row){
   
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Stock" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Stock" class="btn btn-success btn-sm viewStock">Stock</a>';

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
        Paper::updateOrCreate([
            'id' => $request->product_id
        ],[
            'name' => $request->name, 
            'type' => $request->type,
            'size' => $request->size,
            'weight' => $request->weight,
        ]);        
        $message=($request->product_id!='')?'Paper Data Updated Successfully.':'New Paper Added Successfully.';
    return response()->json(['success'=>$message]);
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
        $product = Paper::find($id);
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
        // Paper::find($id)->delete();
      
        return response()->json(['success'=>'Paper deleted successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paper::find($id)->delete();
      
        return response()->json(['success'=>'Paper deleted successfully.']);
    }
    public function getPaperList(){
        $product = Paper::get()->transform(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });
        return response()->json($product);
    }
}
