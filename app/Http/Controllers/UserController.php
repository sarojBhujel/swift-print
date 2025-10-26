<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class UserController extends Controller
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
            // if (! $user->hasPermissionTo('users')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        return view('backend.users');
    }
    public function getRoleList()
    {
        $product = Role::get()->transform(function ($customer) {
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
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'role_id' => $request->role_id,
            // 'is_active'=>$request->has('is_active')
        ];
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $filename = date('y-m-d-h-i-s') . '' . $file->getClientOriginalName();
            $file->move('img', $filename);
            if ($request->product_id != null) {
                $loc = User::find($request->product_id);
                $delete = public_path('img/' . $loc);
                if (file_exists($loc)) {
                    unlink($delete);
                }
            }
            $data['image']=$filename;
        }
        
        if ($request->password!=null) {
            $data['password']=$request->password;
        }
        $login=User::updateOrCreate([
            'id' => $request->product_id
        ], $data);
        $role= Role::findById($request->role_id);
        $login->assignRole($role);
        $message = ($request->product_id != '') ? 'User Updated Successfully.' : 'New User Added Successfully.';
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
        $product = User::find($id);
        $data=[
            'id'=>$product->id,
            'image'=>!is_null($product->image)?asset('img/'.$product->image):null,
            'name'=>$product->name,
            'mobile'=>$product->mobile,
            'email'=>$product->email,
            'role_id'=>$product->role_id,
            'address'=>$product->address,
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
        $user = User::find($id);
        if ($id!=1) {
            $user->delete();
        }
        return response()->json(['success' => 'User Has Benn Deleted Successfully.']);
    }
    public function getUserData()
    {
        // dd($paper_id);
        $employees = User::select('*')->latest();
        // dd($employees->first()->roles);
        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($row->id!=1) {
                    # code...
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
    
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"  >Delete</a>';
    
                    return $btn;
                }else{
                    return $btn=null;
                }
            })
            ->editColumn('role_id', function ($row) {
                // dd($row->role->name);
                return '<span class="badge badge-pill badge-success"style="font-size: small;">'.($row->roles?$row->roles->first()->name:null).'</span>';
            })
            ->addColumn('image', function ($row) {
                return '<img src="'.asset('img/'.$row->image).'" height="100%">';
            })
            ->rawColumns(['action','role_id','image'])
            ->make(true);
    }
}
