@extends('layouts.app')

@section('contents')
<div class="container level">
    <h2>Welcome to TGCSocieties</h2>
    <p>
        This is just a little app I whipped up to help me maintain leaderboards outside of The Golf Club. This has been barely tested by me personally. If you find anything wrong or think we could add more, please feel free to DM on reddit <a href="https://www.reddit.com/user/enjoibp6/" target="_blank">/u/enjoibp6</a>!
    </p>
    <h3>Open Tournaments</h3>
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
                <td>{{ ($tourney->charity) ? 'Charity Event' : $tourney->leaderboard()->count() * $tourney->entry_fee }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">No current events scheduled</td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="text-right">
        <a href="{{ route('tourneys') }}" class="btn icon-right with-margin-top">
            More Tournaments
            <i class="fa fa-caret-right"></i>
        </a>
    </div>
</div>
@endsection
