@extends('layouts.app')

@section('contents')
	<div class="container level">
		<h2>Active Tournaments</h2>
		<table>
			<thead>
				<tr>
					<th>Tournament Name</th>
					<th>Date</th>
					<th>Course</th>
					<th>Rounds</th>
					<th>Field</th>
					<th>Purse</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tourneys as $tourney)
				<tr>
					<td>{{ $tourney->name }}</td>
					<td>{{ $tourney->start_date->format('D F d, Y') }} - {{ $tourney->start_date->addDays($tourney->duration)->format('D F d, Y') }}</td>
					<td>{{ $tourney->course_name }}</td>
					<td>{{ $tourney->rounds }}</td>
					<td>{{ $tourney->leaderboard()->count() }}</td>
					<td>{{ $tourney->leaderboard()->count() * $tourney->entry_fee }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection