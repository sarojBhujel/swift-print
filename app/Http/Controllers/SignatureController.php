<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class SignatureController extends Controller
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
            // if (! $user->hasPermissionTo('signature')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        return view('backend.signature');
    }
    public function getUserList()
    {
        $product = User::get()->transform(function ($customer) {
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
        if ($request->hasFile('image')) {

                $file = $request->file('image');
                $filename = date('y-m-d-h-i-s') . '' . $file->getClientOriginalName();
                $file->move('img', $filename);
                if ($request->product_id != null) {
                    $loc = Signature::find($request->product_id);
                    $delete = public_path('img/' . $loc);
                    if (file_exists($loc)) {
                        unlink($delete);
                    }
                }
            $data = [
                'name' => $request->name,
                'position' => $request->position,
                'image' => $filename,
                // 'is_active'=>$request->has('is_active')
            ];
        } else {
            $data = [
                'name' => $request->name,
                'position' => $request->position,
                // 'is_active'=>$request->has('is_active')
            ];
        }
        Signature::updateOrCreate([
            'id' => $request->product_id
        ], $data);
        $message = ($request->product_id != '') ? 'Signature Updated Successfully.' : 'New Signature Added Successfully.';
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
        $product = Signature::find($id);
        $data=[
            'id'=>$product->id,
            'image'=>!is_null($product->image)?asset('img/'.$product->image):null,
            'is_active'=>$product->is_active,
            'name'=>$product->name,
            'position'=>$product->position,
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
        Signature::find($id)->delete();

        return response()->json(['success' => 'Customer deleted successfully.']);
    }

    public function getSignatureData()
    {
        $employees = Signature::select('*')->latest();

        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->addColumn('old_image', function ($row) {
                return '<img src="'.asset('img/'.$row->image).'" height="100%">';
            })
            ->editColumn('is_active', function($data){
                $status_chk = $data->is_active ? 'checked' : '';
                $disablaed=$data->is_active ? 'disabled' : '';
                return '<div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                            <input type="checkbox" class="form-check-input default-switch ml-0 customSwitchsizemd" style="width:59%; height:100%;" data-id="'.$data->id.'" id="customSwitchsizemd" '.$status_chk.' '.$disablaed.'>
                        </div>';
            })
            ->editColumn('name', function ($row) {
                    $btn = $row->name.' '.($row->is_active===1?'<span class="badge badge-success">Active</span>':null);

                return $btn;
            })
            ->rawColumns(['action','name','old_image','is_active'])
            ->make(true);
    }
    public function changeActive($id){
        $signature= Signature::find($id);
        Signature::where('is_active',1)->update([
            'is_active'=>0
        ]);
        $signature->update([
            'is_active'=>1
        ]);
        return response()->json(['success' => 'Signature Made Active Successfully.']);
    }
}
