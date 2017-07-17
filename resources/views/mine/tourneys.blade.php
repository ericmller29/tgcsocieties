@extends('layouts.app')

@section('contents')
	<div class="container">
        @if(session('message'))
        <div class="message {{ session('type') }}">
             <strong>{{ session('message') }}</strong>
        </div>
        @endif
		<div class="panel">
			<div class="panel-title">{{ Auth::user()->gamer_tag }}'s Tournaments</div>
			<div class="panel-content">
				<div class="list">
					@if(!count(Auth::user()->tourneys))
					<div class="list-item none">
						<span>You have no tournaments created. Why don't you <a href="/my/tourneys/new">add one</a>?
					</div>
					@else
                    @foreach(Auth::user()->tourneys as $tourney)
					<div class="list-item">
                    	<span>{{ $tourney->name }}</span>
                    	<span>
                    		<a href="{{ route('tourney', ['societySlug' => $tourney->society->slug, 'tourneySlug' => $tourney->slug]) }}" class="action">
                    			<i class="fa fa-paperclip"></i>
                    		</a>
                    		<a href="#" class="action">
                    			<i class="fa fa-pencil"></i>
                    		</a>
                    		<a href="{{ route('my.tourneys.remove', $tourney->id) }}" class="action">
                    			<i class="fa fa-trash"></i>
                    		</a>
                    	</span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
		</div>
        <div class="text-right with-margin-top">
            <a href="{{ route('my.tourneys.new') }}" class="btn icon-right">
                New Tournament
                <i class="fa fa-plus"></i>
            </a>
        </div>
	</div>
@endsection