<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoundRequest;
use App\Http\Resources\RoundResource;
use App\Round;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RoundController
 * @package App\Http\Controllers
 */
class RoundController extends Controller
{
    /**
     * RoundController constructor.
     *
     * This is so that unauthenticated users cannot access. If you hit this
     * this without authentication, you will not continue.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Stores a round for authenticated user.
     *
     * @param StoreRoundRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreRoundRequest $request)
    {
        $user = $request->user();

        $roundResult = $user->rounds()->create([
            'author'         => $request->author,
            'genre'          => $request->genre,
            'title'          => $request->title,
            'description'    => $request->description,
            'city'           => $request->city,
            'start_pos_lat'  => $request->start_pos_lat,
            'start_pos_long' => $request->start_pos_long,
            'language'       => $request->language
        ]);

        if ($request->image == null) {
            $imageId = $request->image_id;
            $roundResult->update([
                'image_id' => $imageId
            ]);
        } else {
            $path = $request->file('image')->store('images');
            $image = $roundResult->image()->create([
                'image'   => $path,
                'user_id' => $user->id
            ]);

            if($image) {
                $roundResult->update([
                    'image_id' => $image->id
                ]);
            }
        }

        return response($roundResult, 201);
    }

    /**
     * Returns all rounds belonging to authenticated user.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $user = Auth::user();
        $rounds = $user->rounds;
        $roundsCollection = RoundResource::collection($rounds);
        return response($roundsCollection, 200);
    }

    /**
     * Returns this round to authenticated user.
     *
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show($roundId)
    {
        $user = Auth::user(); // Authentierar usern
        $round = $user->rounds()->find($roundId); // hämtar en runda, med $roundId
        $roundCollection = RoundResource::make($round);
        return response($roundCollection, 200);
    }

    /**
     * Updates this round to authenticated user.
     *
     * @param StoreRoundRequest $request
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(StoreRoundRequest $request, $roundId, $language)
    {
        $user = Auth::user(); // Authentierar usern
        $round = $user->rounds()->find($roundId); // hämtar en runda, med $roundId

        $path = $request->file('image')->store('round-images');

        if ($request->image == null) {
            $imageId = $request->image_id;
            $round->update([
                'image_id' => $imageId
            ]);
        } else {
            $path = $request->file('image')->store('images');
            $image = $round->image()->create([
                'image'   => $path,
                'user_id' => $user->id
            ]);
            $round->update([
                'image_id' => $image->id
            ]);
        }

        $roundResult = $round->update([
            'author'         => $request->author,
            'genre'          => $request->genre,
            'title'          => $request->title,
            'description'    => $request->description,
            'city'           => $request->city,
            'start_pos_lat'  => $request->start_pos_lat,
            'start_pos_long' => $request->start_pos_long,
            'language'       => $request->language
        ]);

//        if ($request->image == null) {
//            $imageLanguageResult = $roundLanguage->update([
//                'image_id' => $request->image_id
//            ]);
//        } else {
//            $path = $request->file('image')->store('public/round-images');
//            $imageLanguageResult = $roundLanguage->image()->create([
//                'image' => $path
//            ]);
//        }
        return response($roundResult, 200);
    }

    /**
     * Deletes this round for authenticated user.
     *
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($roundId)
    {
        $user = Auth::user(); // Authentierar usern
        $round = $user->rounds()->find($roundId); // hämtar en runda, med $roundId
        $round->delete();
        return response(200);
    }


    /**
     * Sets this round to the status finished.
     *
     * @param $roundId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function finish($roundId)
    {
        $user = Auth::user(); // Authentierar usern
        $round = $user->rounds()->find($roundId); // hämtar en runda, med $roundId
        $round->markAsFinished();
        return response(200);
    }

    public function published($roundId)
    {
        $user = Auth::user(); // Authentierar usern
        $round = $user->rounds()->find($roundId); // hämtar en runda, med $roundId
        $round->markAsPublished();
        return response(200);
    }
}
