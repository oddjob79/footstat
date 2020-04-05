<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StandingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return \Football::getLeagueStandings($id);
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
        return \Football::getLeagueStandings($id);
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

    // Grab data from api teams and populate local team data table
    public function populate()
    {
        // list of competition ids we'll be using
        $competitionarr = [2015, 2016, 2021, 2002, 2003, 2019, 2017, 2014];
//        $competitionarr = [2015, 2016];

        //loop through the different competition id's and collect the team data for each one, then append to the $compstandata object per competition
        $compstandata = [];
        foreach ($competitionarr as $competitionid) {
            $compstandata[$competitionid] = $this->index($competitionid);
            $compstandata[$competitionid]->competitionId = $competitionid;
        }

//        return $compstandata;

        // truncate table if data returned by api call
        if (!empty($compstandata)) {
            $this->truncate();
        }

        $leagueid = '';

        // loop through competitions
        foreach($compstandata as $standata) {
//            return var_dump($standata);
            $leagueid = $standata->competitionId;
//                echo $standata->competitionId;
            // loop through teams, create new team model, write data and save
            foreach ($standata as $stand) {
//                return var_dump($stand);
    //            echo $stand->id.' - '.$stand->name . '<br>';
                if ($stand->type == "TOTAL") {
                    foreach ($stand->table as $pos) {
                        $standobj = new \App\Standing;
                        $standobj->league_id = $leagueid;
                        $standobj->position = $pos->position;
                        $standobj->team_id = $pos->team->id;
                        $standobj->played = $pos->playedGames;
                        $standobj->won = $pos->won;
                        $standobj->drawn = $pos->draw;
                        $standobj->lost = $pos->lost;
                        $standobj->points = $pos->points;
                        $standobj->goals_for = $pos->goalsFor;
                        $standobj->goals_against = $pos->goalsAgainst;
                        $standobj->goal_difference = $pos->goalDifference;
                        $standobj->save();
                    }
                }
            }
        }

        return $standobj->all();

    }

    // truncate local team data table
    public function truncate()
    {
        \App\Standing::truncate();
    }
}
