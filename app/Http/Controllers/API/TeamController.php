<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        
        //loop through the different competition id's and collect the team data for each one, then append to the $compteamdata object per competition
        $compteamdata = [];
        foreach ($competitionarr as $competitionid) {
            $compteamdata[$competitionid] = \Football::getLeagueTeams($competitionid);
        }
        
        // truncate table if data returned by api call
        if (!empty($compteamdata)) {
            $this->truncate();
        }

        // loop through competitions
        foreach($compteamdata as $teamdata) {
            // loop through teams, create new team model, write data and save
            foreach ($teamdata as $team) {
    //            echo $team->id.' - '.$team->name . '<br>';
                $teamobj = new \App\Team;
                $teamobj->id = $team->id;
                $teamobj->area_id = $team->area->id;
                $teamobj->team_name = $team->name;
                $teamobj->short_name = $team->shortName;
                $teamobj->tla = $team->tla;
                $teamobj->crest_url = $team->crestUrl;
                $teamobj->address = $team->address;
                $teamobj->phone = $team->phone;
                $teamobj->website = $team->website;
                $teamobj->email = $team->email;
                $teamobj->founded = $team->founded;
                $teamobj->club_colours = $team->clubColors;
                $teamobj->venue = $team->venue;
                $teamobj->save();        
            }
        }
           
        return $teamobj->all();
        
    }
    
    // truncate local team data table
    public function truncate()
    {
        \App\Team::truncate();
    }    
}
