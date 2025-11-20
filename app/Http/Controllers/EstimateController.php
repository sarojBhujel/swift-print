<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimateRequest;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;

class EstimateController extends BaseController
{
    public function index(Request $request)
    {
        // $access = checkAccessPrivileges('deadlines');
        // dd($access['isedit'] == 'Y');
        // $user = getUserDetail();
        // $usermodules = json_decode($user->module_ids, true);
        if ($request->ajax()) {
            $data = Estimate::query();
            // $data->when(request()->has('seachINput'), function ($q) {
            //     $searches = request('seachINput');
            //     if (isset($searches) && $searches != "") {
            //         $q->where(function ($qq) use ($searches) {
            //             $qq->where('clientname', 'ILIKE', '%' . trim($searches) . '%');
            //         });
            //     }
            // });
            $data->orderBy('id', 'desc');
            $recordsCounts = $data->count();
            $filtered_count = $recordsCounts;
            $counts = $recordsCounts;
            // dd($recordsCounts, $filtered_count);
            // Fetch records with pagination
            $start = 0;
            $length = 10;
            if (request()->has('start')) {
                if (request('start') >= 0) {
                    $start = intval(request('start'));
                }
            }
            if (request()->has('length')) {
                if (request('length') >= 10) {
                    $length = intval(request('length'));
                }
            }
            $deadlines = $data->offset($start)
                ->limit($length);
            return DataTables::of($deadlines)

                ->addIndexColumn()

                // ->addColumn('clientname', function ($row) {
                //     return $row->contract ? $row->contract?->client?->clientname : '';
                // })
                // ->addColumn('modulename', function ($row) {
                //     return $row->module->name;
                // })
                // ->addColumn('start_date', function ($row) {
                //     return Carbon::parse($row->created_at)->format('Y-m-d');
                // })
                // ->addColumn('end_date', function ($row) {
                //     $carbonDate_end_date1 = Carbon::parse($row->created_at)->addDays($row->contract?->deal_line)->format('Y-m-d');
                //     return $carbonDate_end_date1;
                // })
                // ->addColumn('status', function ($row) {
                //     if ($row->status == 'approved') {
                //         return 'Approved';
                //     } elseif ($row->status == 'disapproved') {
                //         return 'Dis-Approved';
                //     } else {
                //         return 'Pending';
                //     }
                // })
                // ->addColumn('action', function ($team) use ($access) {
                ->addColumn('action', function ($team) {
                    $btn = '';
                    // if ($access['isedit'] == 'Y') {
                    $btn = "<a href='javascript:void(0)' class='btn btn-primary btn-sm approve' data-pid='" . $team->id . "'><i class='fas fa-check fa-lg'></i> Approve</a>";

                    $btn .= "&nbsp;<a href='javascript:void(0)' class='btn btn-danger btn-sm disapprove' data-pid='" . $team->id . "'><i class='fas fa-close fa-lg'></i> Disapprove</a>";
                    // }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->with([
                    "recordsFiltered" => $filtered_count,
                    "recordsTotal" => $counts
                ])
                ->make(true);
        } else {
            $data['jobs']=Job::get(['id','name','customer_id']);
            $data['clients']=Customer::get(['id','name']);
            return view('backend.estimates.list', $data);
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
    public function store(EstimateRequest $request)
    {
        // try {
        //     //code...
        //     $data = $request->validated();

        //     // Save JSON column (Eloquent will cast)
        //     Estimate::updateOrCreate(['id' => $data['id']], $data);
        //     $message = ($request->post_id != '') ? 'Estimate Have Been Updated Successfully.' : 'New Estimate Added Successfully.';
        //     return response()->json(['success' => $message], Response::HTTP_OK);
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return response()->json(['success' => 'Something went wrong !! Please try again.']);
        // }
                $savedata = $request->except('id');
        $data_save = Event::create($savedata);

        if ($data_save) {

            return $this->sendResponse(true, getMessageText('insert'));
        } else {

            return $this->sendError(getMessageText('insert', false));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
                $event = Estimate::find($id);
        if (isset($event)) {

            return $this->sendResponse($event, getMessageText('fetch'));
        } else {
            return $this->sendError(getMessageText('fetch', false));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimate $estimate)
    {
                $savedata = $request->validated();
        if(empty($request->include_user_ids)){
           $savedata['include_user_ids']=[];
        }

        // Begin database transaction
        $event = Event::find($id);
        if (!$event) {
            return $this->sendError(getMessageText('fetch', false));
        }
        DB::beginTransaction();
        $data_save = $event->update($savedata);



        // Check database transaction
        $transactionStatus = DB::transactionLevel();

        if ($transactionStatus > 0) {
            // Database transaction success
            DB::commit();
            return $this->sendResponse(true, getMessageText('update'));
        } else {
            // Throw error
            DB::rollback();

            return $this->sendError(getMessageText('update', false));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimate $estimate)
    {
                $pm = Event::find($id);
        if (!$pm) {
            return $this->sendError(getMessageText('fetch', false));
        }
        $isdel = $pm->delete();
        if ($isdel) {
            return $this->sendResponse(true, getMessageText('delete'));
        } else {
            return $this->sendError(getMessageText('delete', false));
        }
    }
}
