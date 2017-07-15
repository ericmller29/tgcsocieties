<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Illuminate\Validation\Rule;

use App\Tourneys as Tourney;

class TourneyController extends Controller
{
    public function mine(){
    	return view('mine.tourneys');
    }

    public function newForm(){
    	$data['societies'] = Auth::user()->societies;
    	$data['has_societies'] = (count($data['societies'])) ? true : false;

    	return view('mine.new_tourney', $data);
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
    		'society_id' => 'required|in:' . Auth::user()->societies()->pluck('id')->implode(', '),
    		'name' => 'required',
    		'course_name' => 'required',
    		'entry_fee' => 'required|integer',
    		'start_date' => 'required|date',
    		'duration' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
    		'rounds' => 'required|integer|in:1,2,3,4'
    	]);

    	if($validator->fails()){
    		return redirect()->route('my.tourneys.new')->withErrors($validator)->withInput();
    	}
    	$society = Auth::user()->societies()->find($request->get('society_id'))->first();
    	$tourney = new Tourney($request->all());
    	$tourney->user()->associate(Auth::user());
    	$tourney->save();

    	return redirect()->route('my.tourneys')
    		->with('message', 'Successfully created ' . $tourney->name . ' for ' . $society->name . '!')
    		->with('type', 'success');
    }
}
