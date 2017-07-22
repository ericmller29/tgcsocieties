@extends('layouts.app')

@section('contents')
	<div class="container level">
		<h2>{{ $society->name }} [{{$society->platform}}]</h2>
		<h3>Open Tournament</h3>
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
				@if($current_tourney)
				<tr>
					<td><a href="{{ route('tourney', ['societySlug' => $current_tourney->society->slug, 'tourneySlug' => $current_tourney->slug]) }}" class="action" alt="View Leaderboard" title="View Leaderboard">{{ $current_tourney->name }}</a></td>
					<td>{{ $current_tourney->start_date->format('D F d, Y') }} - {{ $current_tourney->start_date->addDays($current_tourney->duration)->format('D F d, Y') }}</td>
					<td>{{ $current_tourney->course_name }}</td>
					<td>{{ $current_tourney->rounds }}</td>
					<td>{{ $current_tourney->leaderboard()->count() }}</td>
	                <td>{{ ($current_tourney->purse != false) ? $current_tourney->leaderboard()->count() * $current_tourney->entry_fee : $current_tourney->purse }}</td>
				</tr>
				@else
				<tr>
					<td colspan="6">No current events!</td>
				</tr>
				@endif
			</tbody>
		</table>
		<h3>Past Tournaments</h3>
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
				@foreach($past as $tourney)
				<tr>
					<td><a href="{{ route('tourney', ['societySlug' => $tourney->society->slug, 'tourneySlug' => $tourney->slug]) }}" class="action" alt="View Leaderboard" title="View Leaderboard">{{ $tourney->name }}</a></td>
					<td>{{ $tourney->start_date->format('D F d, Y') }} - {{ $tourney->start_date->addDays($tourney->duration)->format('D F d, Y') }}</td>
					<td>{{ $tourney->course_name }}</td>
					<td>{{ $tourney->rounds }}</td>
					<td>{{ $tourney->leaderboard()->count() }}</td>
	                <td>{{ ($tourney->purse != false) ? $tourney->leaderboard()->count() * $tourney->entry_fee : $tourney->purse }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection