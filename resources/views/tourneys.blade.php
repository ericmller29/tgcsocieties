@extends('layouts.app')

@section('contents')
	<div class="container level">
		<h2>Open Tournaments</h2>
		<div class="filters">
			<div>
				<form method="get" action="{{ route('tourneys') }}">
					<div class="form-input">
						<i class="fa fa-search"></i>
						<input type="text" name="q" placeholder="Filter by name, course" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}">
						<button type="submit" class="btn">
							<span>Search</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<table>
			<thead>
				<tr>
					<th>Tournament Name</th>
					<th>Presented By</th>
					<th>Date</th>
					<th>Course</th>
					<th>Rounds</th>
					<th>Field</th>
					<th>Purse</th>
				</tr>
			</thead>
			<tbody>
	            @if(count($tourneys) > 0)
	            @foreach($tourneys as $tourney)
	            <tr>
	                <td><a href="{{ route('tourney', ['societySlug' => $tourney->society->slug, 'tourneySlug' => $tourney->slug]) }}" class="action" alt="View Leaderboard" title="View Leaderboard">{{ $tourney->name }}</a></td>
	                <td><a href="{{ route('society', $tourney->society->slug) }}" class="action">{{ $tourney->society->name }} [{{$tourney->society->platform}}]</a></td>
	                <td>{{ $tourney->start_date->format('D F d, Y') }} - {{ $tourney->start_date->addDays($tourney->duration)->format('D F d, Y') }}</td>
	                <td>{{ $tourney->course_name }}</td>
	                <td>{{ $tourney->rounds }}</td>
	                <td>{{ $tourney->leaderboard()->count() }}</td>
	                <td>{{ ($tourney->charity) ? 'Charity Event' : (!$tourney->purse) ? $tourney->leaderboard()->count() * $tourney->entry_fee : $tourney->purse }}</td>
	            </tr>
	            @endforeach
	            @else
	            <tr>
	                <td colspan="7">No current events scheduled</td>
	            </tr>
	            @endif
			</tbody>
		</table>
	</div>
@endsection