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

    	$society = new Society();
    	$society->name = $request->get('name');
    	$society->platform = $request->get('platform');
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
