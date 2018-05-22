<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Datapoint;
use App\Http\Requests\StoreDatapointRequest;
use App\Http\Resources\DatapointResource;
use App\Image;
use App\Video;
use Auth;
use Illuminate\Http\Request;

/**
 * Class DatapointController
 * @package App\Http\Controllers
 */
class DatapointController extends Controller
{

    /**
     * DatapointController constructor.
     *
     * This is so that unauthenticated users cannot access. If you hit this
     * this without authentication, you will not continue.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Stores a datapoint to its corresponding round.
     *
     * @param StoreDatapointRequest $request
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreDatapointRequest $request, $roundId)
    {
        $user = $request->user(); // lagrar userobjektet i variabeln user.

        $round = $user->rounds()->find($roundId); // Short command for = ->where('id', $roundId)->first();

        $round->datapoints()->create([
            'title' => $request->title,
            'text' => $request->text,
            'is_direction' => $request->is_direction,
            'point_pos_lat' => $request->point_pos_lat,
            'point_pos_long' => $request->point_pos_long
        ]);

        return response(201);
    }

    /**
     * Returns all datapoints to a round.
     *
     * @param Request $request
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, $roundId)
    {
        $user = $request->user(); // lagrar userobjektet i variabeln user.
        $round = $user->rounds()->find($roundId);
        $datapoints = $round->datapoints;
        $datapointsCollection = DatapointResource::collection($datapoints);

        return response($datapointsCollection, 200);
    }

    /**
     * Returns a single datapoint from a round.
     *
     * @param $roundId
     * @param $datapointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show($roundId, $datapointId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapointCollection = DatapointResource::make($datapoint);

        return response($datapointCollection, 200);
    }

    /**
     * Updates a datapoint from a round.
     *
     * @param StoreDatapointRequest $request
     * @param $roundId
     * @param $datapointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(StoreDatapointRequest $request, $roundId, $datapointId)
    {
        $datapoint = Datapoint::find($datapointId);

        $data = [
            'title' => $request->title,
            'text' => $request->text,
            'is_direction' => $request->is_direction,
            'point_pos_lat' => $request->point_pos_lat,
            'point_pos_long' => $request->point_pos_long
        ];

        if ($request->round_id) {
            $data['round_id'] = $request->round_id;
        }

        $result = $datapoint->update($data);

        return response($result, 200);
    }

    /**
     * Deletes a datapoint from a round.
     *
     * @param $roundId
     * @param $datapointId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($roundId, $datapointId)
    {
        $datapoint = Datapoint::find($datapointId);
        $datapoint->delete();
        return response(200);
    }

    public function datapointForm($roundId)
    {
        return view('datapointForm', compact('roundId'));
    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $path = $request->file('image')->store('images');
        $image = Image::create([
            'image' => $path,
            'user_id' => $user->id
        ]);
        return response(201);
    }

    public function attachImage($roundId, $datapointId, $imageId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->images()->attach($imageId);
        return response(200);
    }

    public function detachImage($roundId, $datapointId, $imageId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->images()->detach($imageId);
        return response(200);
    }

    public function uploadVideo(Request $request)
    {
        $user = Auth::user();
        $path = $request->file('video')->store('videos');
        $video = Video::create([
            'video' => $path,
            'user_id' => $user->id
        ]);
        return response(201);
    }

    public function attachVideo($roundId, $datapointId, $videoId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->videos()->attach($videoId);
        return response(200);
    }

    public function detachVideo($roundId, $datapointId, $videoId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->videos()->detach($videoId);
        return response(200);
    }

    public function uploadAudio(Request $request)
    {
        $user = Auth::user();
        $path = $request->file('audio')->store('audio');
        $audio = Audio::create([
            'audio' => $path,
            'user_id' => $user->id
        ]);
        return response(201);
    }

    public function attachAudio($roundId, $datapointId, $audioId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->audio()->attach($audioId);
        return response(200);
    }

    public function detachAudio($roundId, $datapointId, $audioId)
    {
        $user = Auth::user();
        $round = $user->rounds()->find($roundId);
        $datapoint = $round->datapoints()->find($datapointId);
        $datapoint->audio()->detach($audioId);
        return response(200);
    }

}
