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

    public function showEdit($tourneyId){
        $data['societies'] = Auth::user()->societies;
        $data['tourney'] = Auth::user()->tourneys()->find($tourneyId);
        $data['has_societies'] = (count($data['societies'])) ? true : false;

        if(!isset($data['tourney'])){
            return redirect('/404');
        }

        return view('mine.edit_tourney', $data);
    }

    public function save(Request $request, $tourneyId){
        $validator = Validator::make($request->all(), [
            'society_id' => 'required|in:' . Auth::user()->societies()->pluck('id')->implode(', '),
            'name' => 'required',
            'course_name' => 'required',
            'entry_fee' => 'required|integer',
            'start_date' => 'required|date',
            'duration' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
            'rounds' => 'required|integer|in:1,2,3,4',
            'par' => 'required|integer'
        ]);

        if($validator->fails()){
            return redirect()->route('my.tourneys.new')->withErrors($validator)->withInput();
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
        $duplicate_slug = Tourney::where('slug', $slug)->count();
        if($duplicate_slug > 0){
            $slug .= '-' . ($duplicate_slug + 1);
        }

        $society = Auth::user()->societies()->find($request->get('society_id'))->first();
        $tourney = $society->tourneys()->find($tourneyId);
        $tourney->name = $request->get('name');
        $tourney->course_name = $request->get('course_name');
        $tourney->entry_fee = $request->get('entry_fee');
        $tourney->start_date = $request->get('start_date') . ' 00:00:00';
        $tourney->duration = $request->get('duration');
        $tourney->rounds = $request->get('rounds');
        $tourney->par = $request->get('par');
        $tourney->slug = $slug;
        $tourney->society()->associate($request->get('society_id'));
        $tourney->user()->associate(Auth::user());
        $tourney->save();

        return redirect()->route('my.tourneys')
            ->with('message', 'Successfully created ' . $tourney->name . ' for ' . $society->name . '!')
            ->with('type', 'success');
    }

    public function create(Request $request){
    	$validator = Validator::make($request->all(), [
    		'society_id' => 'required|in:' . Auth::user()->societies()->pluck('id')->implode(', '),
    		'name' => 'required',
    		'course_name' => 'required',
    		'entry_fee' => 'required|integer',
    		'start_date' => 'required|date',
    		'duration' => 'required|integer|in:1,2,3,4,5,6,7,8,9,10',
    		'rounds' => 'required|integer|in:1,2,3,4',
            'par' => 'required|integer'
    	]);

    	if($validator->fails()){
    		return redirect()->route('my.tourneys.new')->withErrors($validator)->withInput();
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
        $duplicate_slug = Tourney::where('slug', $slug)->count();
        if($duplicate_slug > 0){
            $slug .= '-' . ($duplicate_slug + 1);
        }

    	$society = Auth::user()->societies()->find($request->get('society_id'))->first();
    	$tourney = new Tourney();
        $tourney->name = $request->get('name');
        $tourney->course_name = $request->get('course_name');
        $tourney->entry_fee = $request->get('entry_fee');
        $tourney->start_date = $request->get('start_date') . ' 00:00:00';
        $tourney->duration = $request->get('duration');
        $tourney->rounds = $request->get('rounds');
        $tourney->par = $request->get('par');
        $tourney->slug = $slug;
        $tourney->society()->associate($request->get('society_id'));
    	$tourney->user()->associate(Auth::user());
    	$tourney->save();

    	return redirect()->route('my.tourneys')
    		->with('message', 'Successfully created ' . $tourney->name . ' for ' . $society->name . '!')
    		->with('type', 'success');
    }

    public function remove($tourneyId){
        $tourney = Auth::user()->tourneys()->find($tourneyId);

        if(!isset($tourney)){
            return redirect('404');
        }

        if($tourney->delete()){
            return redirect()->route('my.tourneys')
                ->with('message', 'Successfully deleted ' . $tourney->name . '!')
                ->with('type', 'success');
        }

        return redirect()->route('my.tourneys')
            ->with('message', 'Something went wrong trying to delete ' . $tourney->name . '. Please try again.')
            ->with('type', 'error');
    }
}
