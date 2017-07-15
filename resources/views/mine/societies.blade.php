@extends('layouts.app')

@section('contents')
	<div class="container">
        @if(session('message'))
        <div class="message {{ session('type') }}">
             <strong>{{ session('message') }}</strong>
        </div>
        @endif
		<div class="panel">
			<div class="panel-title">{{ Auth::user()->gamer_tag }}'s Societies</div>
			<div class="panel-content">
				<div class="list">
					@if(!count(Auth::user()->societies))
					<div class="list-item none">
						<span>You have no societies created. Why don't you <a href="/my/societies/new">add one</a>?
					</div>
					@else
                    @foreach(Auth::user()->societies as $society)
					<div class="list-item">
                    	<span>{{ $society->name }}</span>
                    	<span>
                    		<a href="{{ route('society', $society->slug) }}" class="action">
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
                    @endforeach
                    @endif
                </div>
            </div>
		</div>
        <div class="text-right with-margin-top">
            <a href="{{ route('my.societies.new') }}" class="btn icon-right">
                Create Society
                <i class="fa fa-plus"></i>
            </a>
        </div>
	</div>
@endsection