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
					<div class="list-item">
                    	<span>Fairway Blues Inaugural Open</span>
                    	<span>
                    		<a href="#" class="action">
                    			<i class="fa fa-paperclip"></i>
                    		</a>
                    		<a href="#" class="action">
                    			<i class="fa fa-pencil"></i>
                    		</a>
                    		<a href="#" class="action">
                    			<i class="fa fa-trash"></i>
                    		</a>
                    	</span>
                    </div>
                    @endif
                </div>
            </div>
		</div>
	</div>
@endsection