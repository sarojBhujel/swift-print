<?php

namespace App\Http\Controllers;

use App\Http\Requests\DefaultEstimateRequest;
use App\Models\DefaultEstimates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DataTables;

class DefaultEstimatesController extends Controller
{
    public function index()
    {
        return view('backend.default_estimates.list');
    }
    public function getDataTableData(Request $request)
    {
        // dd($request->search['value']);
        // $users = User::select(['id', 'name', 'email', 'created_at'])
        // ->orderBy($request->input('column_name'), $request->input('column_sort'))
        // ->paginate($request->input('length'));
        // dd($request->all());
        try{
            
if ($request->ajax()) {

            $search = $request->search['value'];
            $clients = DefaultEstimates::when($search && !is_null($search), function ($q) use ($search) {
                // $q->whereHas('province', function ($subq) use ($search) {
                //     $subq->where('name', 'ILIKE', '%' . $search . '%');
                // })->orWhereHas('categoryType', function ($subq) use ($search) {
                //     $subq->where('name', 'ILIKE', '%' . $search . '%');
                // })
                    $q->orWhere('particular_name', 'ILIKE', '%' . $search . '%')
                    ->orWhere('namunite', 'ILIKE', '%' . $search . '%');
            })
                ->when($request->has('providence_id') && !is_null($request->providence_id), function ($q) use ($request) {
                    $q->where('providence', $request->providence_id);
                });

            $filtered_count = $clientsfilter->count();

            $counts = $clients->count();

            $start = 0;
            $length = 10;
            $clients1 = $clientsfilter->offset($start)
                ->limit($length);
            return Datatables::of($clients1)

                ->addIndexColumn()
                ->editColumn('address', function ($row) {
                    return $row->address . ',' . $row->vdc?->name . ',' . $row->province?->name;
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active == 'Y' ? 'Yes' : 'No';
                })
                ->addColumn('categoryName', function ($row) {
                    return $row->categoryType->name;
                })
                ->addColumn('province', function ($row) {
                    return $row->province?->name;
                })
                ->addColumn('action', function ($row) use ($access, $useraccess) {

                    $btn = '';
                    if ($access['isedit'] == 'Y' || getUserDetail()->id == '184') {
                        $btn = "<a href='javascript:void(0)' class='edit btn btn-primary btn-sm editData' data-pid='" . $row->id . "' data-url=" . route('clients.edit', "$row->id") . "><i class='fas fa-edit'></i> Edit</a>";
                    }
                    if ($access['isdelete'] == 'Y') {
                        $btn .= "&nbsp;<a href='javascript:void(0)' class='edit btn btn-danger btn-sm deleteData' data-pid='" . $row->id . "' data-url=" . route('clients.destroy', "$row->id") . "><i class='fas fa-trash'></i> Delete</a>";
                    }
                    //buttons for user management for clients
                    if ($useraccess['isinsert'] == 'Y') {
                        $btn .= "&nbsp;<a href='javascript:void(0)' class='edit btn btn-success btn-sm addUser' data-pid='" . $row->id . "'id=addUser><i class='fas fa-plus'></i>Add User</a>";
                        $btn .= "&nbsp;<a href='javascript:void(0)' class='edit btn btn-warning btn-sm listUser' data-pid='" . $row->id . "'id=listUser><i class='fas fa-users'></i>Users</a>";
                    }

                    return $btn;
                })


                ->rawColumns(['action', 'categoryName', 'province'])
                ->with([
                    "recordsFiltered" => $filtered_count,
                    "recordsTotal" => $counts
                ])
                ->make(true);
        }
            
            return Datatables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
    
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="view btn btn-secondary btn-sm viewItem">View</a><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem">Edit</a>';
    
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a>';
    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }catch(\Exception $e){
            Log::error($e);
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DefaultEstimateRequest $request)
    {
        try {
            $validatedData=$request->validated();
            DefaultEstimates::create($validatedData);
            return response()->json(['success' => 'Default Estimate Added successfully.']); 
        } catch (\Throwable $th) {
            Log::error($th);
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DefaultEstimates $defaultEstimates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DefaultEstimates $defaultEstimates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DefaultEstimates $defaultEstimates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DefaultEstimates $defaultEstimates)
    {
        //
    }
}
