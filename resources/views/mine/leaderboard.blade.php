@extends('layouts.app')

@section('contents')
	<div class="container">
        @if(session('message'))
        <div class="message {{ session('type') }}"
        	{{ session('type') == 'error' ? ' data-scrollTo=' . session('gamertag') : '' }}
        >
             {{ session('message') }}
        </div>
        @endif
		<div class="scorecard">
			<h2>
				{{ $tourney->name }}
			</h2>
			<time datetime="{{ $tourney->start_date }}">{{ $tourney->start_date->format('l F d, Y') }} - </time>
			<time datetime="{{ $tourney->start_date->addDays($tourney->duration) }}">
				{{ $tourney->start_date->addDays($tourney->duration)->format('l F d, Y') }}
			</time>
			<table class="leaderboard with-margin-top">
				<thead>
					<tr>
						<th class="pos">POS</th>
						<th>Player Name</th>
						<th class="pos">Total</th>
						@for($i=1; $i <= $tourney->rounds; $i++)
						<th class="pos">R{{ $i }}</th>
						@endfor
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@if(!count($leaderboard))
					<tr>
						<td colspan="{{ 4+$tourney->rounds }}">No scores entered yet!</td>
					</tr>
					@endif
					@foreach($leaderboard as $leaders)
					<tr id="{{ $leaders->username }}">
						<form method="post" action="/my/leaderboards/update/{{ $tourney->id }}/{{ $leaders->id }}">
						<td>{{ $leaders->rank }}</td>
						<td><input type="text" name="username" value="{{ $leaders->username }}"></td>
						<td>{{ $leaders->getScoresTotal($leaders->scores, $tourney->rounds, $tourney->par) }}</td>
						@foreach($leaders->scores as $key => $score)
						<td><input type="text" name="score[{{ $key }}]" value="{{ $score }}"></td>
						@endforeach
						<td class="save text-center"><button type="submit" class="btn small">Save</button></td>
						<td class="pos text-center"><a href="{{ route('my.leaderboard.remove', ['tourneyId' => $tourney->id, 'leaderId' => $leaders->id]) }}" class="btn small"><i class="fa fa-trash"></i></a></td>
						{{ csrf_field() }}
						</form>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel with-margin-top">
			<div class="panel-title">Add a new score</div>
			<div class="panel-content with-padding">
				<form method="post" action="{{ route('my.leaderboard', $tourney->id) }}">
	                <div class="form-input{{ $errors->has('username') ? ' has-error' : '' }}">
	                    <label for="username">Gamer Tag:</label>
	                    <input type="text" name="username" id="username" autofocus>
	                    @if ($errors->has('username'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('username') }}</strong>
	                        </span>
	                    @endif
	                </div>
	                @for($i = 1; $i <= $tourney->rounds; $i++)
	                <div class="form-input">
	                    <label for="score[round_{{ $i }}]">Round {{ $i }}:</label>
	                    <input type="text" name="score[round_{{ $i }}]" id="score[round_{{ $i }}]">
	                </div>
	                @endfor
	                <div class="text-center with-margin-top">
	                	<button type="submit" class="btn">
	                		Save Score
	                	</button>
	                </div>

	                {{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
@endsection