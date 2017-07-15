<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Societies as Society;
use Auth;

class SocietiesController extends Controller
{
    public function index(){

    }

    public function mine(){
    	return view('mine.societies');
    }

    public function newForm(){
    	return view('mine.new_society');
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
    		'name' => 'required',
    		'platform' => 'required|in:PC,PS4,Xbox One'
    	]);

    	if($validator->fails()){
    		return redirect()->route('my.societies.new')->withErrors($validator)->withInput();
    	}

        $slug = $request->get('name');
        $slug = strtolower($slug);
        //Make alphanumeric (removes all other characters)
        $slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
        //Clean up multiple dashes or whitespaces
        $slug = preg_replace("/[\s-]+/", " ", $slug);
        //Convert whitespaces and underscore to dash
        $slug = preg_replace("/[\s_]/", "-", $slug);

        //Do some slug work
        $duplicate_slug = Society::where('slug', $slug)->count();
        if($duplicate_slug > 0){
            $slug .= '-' . ($duplicate_slug + 1);
        }

    	$society = new Society();
    	$society->name = $request->get('name');
    	$society->platform = $request->get('platform');
        $society->slug = $slug;
    	$society->user()->associate(Auth::user());
    	$society->save();

        if($request->get('ref') && $request->get('ref') == 'new_tourney'){
            return redirect()->route('my.tourneys.new')
                ->with('message', 'Successfully created ' . $society->name . '!')
                ->with('type', 'success');
        }

    	return redirect()->route('my.societies')
    		->with('message', 'Successfully created ' . $society->name . '!')
    		->with('type', 'success');
    }
}
