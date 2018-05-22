<?php

namespace App\Http\Controllers;

use App\Datapoint;
use App\Http\Requests\StoreNextDatapointRequest;
use Auth;

/**
 * Class NextpointController
 * @package App\Http\Controllers
 */
class NextDatapointController extends Controller
{
    /**
     * NextpointController constructor
     *
     * This is so that unauthenticated users cannot access. If you hit this
     * this without authentication, you will not continue.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Stores a link between the datapoint, and its next_datapoint.
     *
     * @param StoreNextDatapointRequest $request
     * @param $roundId
     * @param $datapointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreNextDatapointRequest $request, $roundId, $datapointId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapointFrom = $round->datapoints()->find($datapointId);
        $datapointTo = $round->datapoints()->find($request->next_datapoint_id);

        if ($datapointTo !== null) {
            $result = $datapointFrom->nextDatapoints()->create([
                'next_datapoint_id' => $request->next_datapoint_id
            ]);
            return response(201);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Returns all linked next_datapoints.
     *
     * @param $roundId
     * @param $datapointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index($roundId, $datapointId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $nextpoints = $datapoint->nextDatapoints()->pluck('next_datapoint_id');
        $nextDatapoints = Datapoint::whereIn('id', $nextpoints)->get();

        return response($nextDatapoints, 200);
    }

    /**
     * Updates a link between a datapoint and a next_datapoint.
     *
     * @param StoreNextDatapointRequest $request
     * @param $roundId
     * @param $datapointId
     * @param $nextpointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(StoreNextDatapointRequest $request, $roundId, $datapointId, $nextDatapointId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints->find($datapointId);
        $toUpdate = $datapoint->nextDatapoints->where('datapoint_id', $datapointId)->where('next_datapoint_id', $nextDatapointId)->first();
        $result = $toUpdate->update([
            'datapoint_id'      => $request->datapoint_id,
            'next_datapoint_id' => $request->next_datapoint_id
        ]);

        return response(200);
    }

    /**
     * Deletes a link between a datapoint and a next_datapoint.
     *
     * @param $roundId
     * @param $datapointId
     * @param $nextpointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($roundId, $datapointId, $nextDatapointId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $nextDatapoint = $datapoint->nextDatapoints->where('datapoint_id', $datapointId)->where('next_datapoint_id',
            $nextDatapointId)->first();
        $nextDatapoint->delete();
        return response(200);
    }
}