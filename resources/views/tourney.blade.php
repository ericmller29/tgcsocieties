@extends('layouts.app')

@section('contents')
	<div class="container">
		<div class="scorecard">
			<h2>
				{{ $tourney->name }}
			</h2>
			<time datetime="{{ $tourney->start_date }}">{{ $tourney->start_date->format('l F d, Y') }} - </time>
			<time datetime="{{ $tourney->start_date->addDays($tourney->duration) }}">
				{{ $tourney->start_date->addDays($tourney->duration)->format('l F d, Y') }}
			</time>
			<h3>presented by <a href="{{ route('society', $society->slug) }}">{{ $society->name }}</a></h3>
			<table class="leaderboard">
				<thead>
					<tr>
						<th class="pos">POS</th>
						<th>Player Name</th>
						<th class="pos">Total</th>
						@for($i=1; $i <= $tourney->rounds; $i++)
						<th class="pos">R{{ $i }}</th>
						@endfor
					</tr>
				</thead>
				<tbody>
					@if(!count($leaderboard))
					<tr>
						<td colspan="{{ 3+$tourney->rounds }}"><em>No scores entered yet!</em></td>
					</tr>
					@endif
					@foreach($leaderboard as $key => $leader)
					<tr>
						<td>{{ $leader->rank }}</td>
						<td>{{ $leader->username }}</td>
						<td>{{ $leader->getScoresTotal($leader->scores, $tourney->rounds, $tourney->par) }}</td>
						@foreach($leader->scores as $score)
						<td>{{ $score }}</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
			@if(isset($is_users) && $is_users)
			<div class="text-right with-margin-top">
				<a href="{{ route('my.leaderboard', $tourney->id) }}" class="btn icon-right">
					Edit Leaderboard
					<i class="fa fa-list"></i>
				</a>
			</div>
			@endif
		</div>
	</div>
@endsection