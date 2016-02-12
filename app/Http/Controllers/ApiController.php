<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Widget;

class ApiController extends Controller
{
    public function widgetData() {
    	$results['data'] = \DB::table('widgets')
    							->select('id', 'widget_name', 'created_at')
    							->get();
    	return json_encode($results);	
    }
}
