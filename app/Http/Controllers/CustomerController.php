<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class CustomerController extends Controller
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
            // if (! $user->hasPermissionTo('customer')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        // return view('backend.customers.index');
        return view('backend.customers.index');
    }
    public function getCustomerList()
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
        // dd($request->product_id);
        Customer::updateOrCreate([
            'id' => $request->product_id
        ], [
            'name' => $request->name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'department' => $request->department,
            'contact_email' => $request->contact_email,
            'contact_mobile' => $request->contact_mobile,
        ]);
        $message = ($request->product_id != '') ? 'Customer Data Updated Successfully.' : 'New Customer Added Successfully.';
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
        $product = Customer::find($id);
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
        Customer::find($id)->delete();

        return response()->json(['success' => 'Customer deleted successfully.']);
    }

    public function getCustomerData()
    {
        $employees = Customer::select('*')->latest();

        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
