<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maps;
use App\Http\Requests\MapsRequest;
use Doctrine\DBAL\Schema\Index;
class MapController extends Controller
{
    public function index()
    {
        $maps = Maps::all();
        $dataMap  = Array();
        $dataMap['type']='FeatureCollection';
        $dataMap['features']=array();
        foreach($maps as $value){  
            $features = array();
            $features['type']='Feature';
            $geometry = array("type"=>"Point","coordinates"=>[$value->lng, $value->lat]);
            $features['geometry']=$geometry;
            $properties=array('name'=>$value->name,"address"=>$value->address,"phone"=>$value->phone);
            $features['properties']= $properties;
            array_push($dataMap['features'],$features);
       }
        return view('googlemap.index')->with('dataArray',json_encode($dataMap));
        //return view('googlemap.index');
    }
    public function view(){
        return view('welcome');
    }
    public function create()
    {
        return view();
    }
   
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $maps = Maps::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('googlemap.index');
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
}
