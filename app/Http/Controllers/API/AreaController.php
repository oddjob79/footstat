<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
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
    
    // Grab data from api areas and populate local areas data table
    public function populate()
    {
        $areadata = '';
        $areadata = \Football::getAreas();
        
        if (!empty($areadata)) {
            $this->truncate();
        }
        
    foreach($areadata as $area) {
//        echo $area->id.' - '.$area->name . '<br>';
        $areaobj = new \App\Area;
        $areaobj->id = $area->id;
        $areaobj->area_name = $area->name;
        $areaobj->area_code = $area->countryCode;
        $areaobj->parentAreaId = $area->parentAreaId;
        $areaobj->save();        
    }
       
    return $areaobj->all();
        
        
    }
    
    // truncate local areas data table
    public function truncate()
    {
        \App\Area::truncate();
    }  
    
}
