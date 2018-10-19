<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
        
class ApiFootballTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://www.api-football.com/demo/api/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        
        $response = $client->request('GET', 'teams/league/2');
        $data = json_decode($response->getBody()->getContents(), true);

        if (!empty($data)) {
            $this->truncate();
        }
        
        foreach ($data['api']['teams'] as $team) {
            $eplteams = new \App\Testeplteam;
//            echo $team['team_id'] . ' - ' . $team['name']."<br>";
            $eplteams->team_id = $team['team_id'];
            $eplteams->team_name = $team['name'];
            $eplteams->save();
            
        }
      
        return $eplteams->all();

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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function truncate()
    {
        \App\Testeplteam::truncate();
    }    
}
