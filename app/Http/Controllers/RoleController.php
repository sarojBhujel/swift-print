<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Tenant\Role as TenantRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
class RoleController extends Controller
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
            // if (! $user->hasPermissionTo('role')) {
            //     throw new AuthorizationException('You do not have permission to access this resource.');
            // }

            return $next($request);
        });
    }
    public function index()
    {
        if (auth()->user()->can('role')) {
            // $roles = Role::with('createdBy')->paginate(10);
            // return $this->sendResponse(Response::HTTP_OK, '', new RoleCollection($roles));
            return view('backend.roles');
        } else {
            return response()->json('You Do not Have permission');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->product_id != '') {
           $role=Role::find($request->product_id);
           $role->update([
            'name'=>$request->name
           ]);
           $permissions      = $request->jobs;

            // foreach ($permissions as $permission) {
            //     $p = Permission::where('id', '=', $permission)->firstOrFail();
            //     $
            // }
            $role->syncPermissions($permissions);
        }else {
            $data = [
                'name' => $request->name,
                'guard_name' => 'web',
                'created_by' => auth()->user()->id,
            ];
            $role = Role::create($data);
            $permissions      = $request->jobs;

            foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                $role->givePermissionTo($p);
            }
        }
                
        $message = ($request->product_id != '') ? 'Role Updated Successfully.' : 'New Role Added Successfully.';
        return response()->json(['success' => $message]);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $role = Role::findById($id);
            if (!$role) {
                return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'No Such Role Is Found.');
            }
            // dd($role->getAllPermissions());
            $permission = $role->getAllPermissions()->pluck('id')->toArray();
            $data=[
                'id'=>$role->id,
                'name'=>$role->name,
                'jobs'=> $permission,
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
    public function update(RoleUpdateRequest $request, $id)
    {
        if (auth()->user()->can('role')) {

            try {
                $role = Role::where('name', '!=', 'admin')->find($id);

                if (!$role) {
                    return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'No Such Role Is Found.');
                }
                $data = [
                    'name' => $request->name,
                    'updated_by' => auth()->user()->loginable_id,
                ];
                $role->update($data);
                $permissions = $role->getAllPermissions();
                // dd($permissions->count(),$role);
                $role->revokePermissionTo($permissions);
                $newPermissions = $request['permissions'];
                $role->givePermissionTo($newPermissions);
                return  $this->sendResponse(Response::HTTP_OK, __('response_msg.updated_successfully', ['model' => 'Role']));
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::error($e->getMessage());
                return $this->sendResponse(Response::HTTP_BAD_REQUEST, __('response_msg.model_not_found', ['model' => 'Role']));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                return $this->sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('response_msg.http_internal_server_error_msg'));
            }
        } else {
            return $this->sendResponse(Response::HTTP_FORBIDDEN, __('You Do not Have permission'), 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('role')) {
            $role = Role::where('name', '!=', 'admin')->find($id);

            if (!$role) {
                return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'No Such Role Is Found.');
            }

            if($role->users->count()<=0){

                return $role->delete()
                    ? $this->sendResponse(Response::HTTP_NO_CONTENT, __('response_msg.deleted_successfully', ['model' => 'Role']))
                    : $this->sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('response_msg.http_internal_server_error_msg'));
            }else{
                return $this->sendResponse(Response::HTTP_FORBIDDEN, 'This role is assigned to  users. Assign new role to user before deleting this role.');
            }
            
        } else {
            return $this->sendResponse(Response::HTTP_FORBIDDEN, __('You Do not Have permission'), 403);
        }
    }

    // public function givePermission(Request $request)
    // {
    //     if (auth()->user()->can('role')) {
    //         try {
    //             $role = Role::find($request->role_id);
    //             if (!$role) {
    //                 return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'No Such Role Is Found.');
    //             }
    //             $role->givePermissionTo($request->permissions);
    //         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //             Log::error($e->getMessage());
    //             return $this->sendResponse(Response::HTTP_BAD_REQUEST, __('response_msg.model_not_found'));
    //         } catch (\Throwable $th) {
    //             Log::error($th->getMessage());
    //             return $this->sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('response_msg.http_internal_server_error_msg'));
    //         }
    //     } else {
    //         return $this->sendResponse(Response::HTTP_FORBIDDEN, __('You Do not Have permission'), 403);
    //     }
    // }
    // public function updatePermission(Request $request)
    // {
    //     if (auth()->user()->can('role')) {
    //         try {
    //             $role = Role::find($request->role_id);
    //             if (!$role) {
    //                 return $this->sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'No Such Role Is Found.');
    //             }
    //             $role->syncPermissions($request->permissions);
    //         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //             Log::error($e->getMessage());
    //             return $this->sendResponse(Response::HTTP_BAD_REQUEST, __('response_msg.model_not_found'));
    //         } catch (\Throwable $th) {
    //             Log::error($th->getMessage());
    //             return $this->sendResponse(Response::HTTP_INTERNAL_SERVER_ERROR, __('response_msg.http_internal_server_error_msg'));
    //         }
    //     } else {
    //         return $this->sendResponse(Response::HTTP_FORBIDDEN, __('You Do not Have permission'), 403);
    //     }
    // }
    public function getRoleData()
    {
        $employees = Role::select('*')->latest();
        // dd($employees);
        
        return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
            ->editColumn('permissions', function($role){
                return $role->permissions()->get()->transform(function($per){
                    return $per->name;
                    
                });
                
            })
            ->rawColumns(['action','permissions'])
            ->make(true);
    }
}
