<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Grambas\FootballData\Facades\FootballDataFacade;
use App\League;

class LeaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return League::all();
        // return \Football::getLeagues(['plan' => 'TIER_ONE']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return League::find($id);
        // return \Football::getLeague($id);
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
        //
    }

    // Grab data from api areas and populate local areas data table
    public function populate()
    {
        $leaguedata = '';
        $leaguedata = $this->index();

        if (!empty($leaguedata)) {
            $this->truncate();
        }

    foreach($leaguedata as $league) {
//        echo $league->id.' - '.$league->name . '<br>';
        $leagueobj = new \App\League;
        $leagueobj->id = $league->id;
        $leagueobj->area_id = $league->area->id;
        $leagueobj->league_name = $league->name;
        $leagueobj->league_code = $league->code;
        $leagueobj->emblem_url = $league->emblemUrl;
        $leagueobj->season_start = $league->currentSeason->startDate;
        $leagueobj->season_end = $league->currentSeason->endDate;
        $leagueobj->current_matchday = $league->currentSeason->currentMatchday;
        $leagueobj->save();
    }

    return $leagueobj->all();


    }

    // truncate local leagues data table
    public function truncate()
    {
        \App\League::truncate();
    }

}
