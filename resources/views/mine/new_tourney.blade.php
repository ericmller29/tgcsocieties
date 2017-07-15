@extends('layouts.app')

@section('contents')
	<div class="container small">
        @if(session('message'))
        <div class="message {{ session('type') }}">
             <strong>{{ session('message') }}</strong>
        </div>
        @endif
		<div class="panel">
			<div class="panel-title">New Tournament</div>
			<div class="panel-content with-padding">
                <form method="POST" action="{{ route('my.tourneys.new') }}">
                    <div class="form-input{{ $errors->has('society_id') ? ' has-error' : '' }}">
                        <label for="society_id">Which Society:</label>
                        @if($has_societies)
                        <div class="select">
                            <select name="society_id">
                                @foreach($societies as $society)
                                <option value="{{ $society->id }}"{{ old('society_id') == $society->id ? ' selected' : '' }}>{{ $society->name }}</option>
                                @endforeach
                            </select>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        <div class="help-block">
                            <a href="{{ route('my.societies.new', ['ref=new_tourney']) }}">Add a society</a>
                        </div>
                        @else
                        You don't have any societies. Please <a href="{{ route('my.societies.new', ['ref=new_tourney']) }}">add one</a> before continuing.
                        @endif
                        @if ($errors->has('society_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('society_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('name') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="name">Tournament Name:</label>
                        <input type="text" name="name" id="name"{{ $has_societies ? '' : ' disabled' }} value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('course_name') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="course_name">Course Name:</label>
                        <input type="text" name="course_name" id="course_name"{{ $has_societies ? '' : ' disabled' }} value="{{ old('course_name') }}">
                        @if ($errors->has('course_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('course_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('entry_fee') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="entry_fee">Entry Fee:</label>
                        <input type="text" name="entry_fee" id="entry_fee"{{ $has_societies ? '' : ' disabled' }} value="{{ old('entry_fee') }}">
                        @if ($errors->has('entry_fee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('entry_fee') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('start_date') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="start_date">Start Date:</label>
                        <input type="text" data-toggle="datepicker" name="start_date" id="start_date"{{ $has_societies ? '' : ' disabled' }} value="{{ old('start_date') }}">
                        @if ($errors->has('start_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('duration') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="duration">Tournament Duration:</label>
                        <div class="select">
                            <select name="duration"{{ $has_societies ? '' : ' disabled' }}>
                                @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}"{{ old('duration') == $i ? ' selected' : '' }}>{{ $i }} Day{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        @if ($errors->has('duration'))
                            <span class="help-block">
                                <strong>{{ $errors->first('duration') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input{{ $errors->has('rounds') ? ' has-error' : '' }}{{ $has_societies ? '' : ' is-disabled' }}">
                        <label for="rounds">Number of rounds:</label>
                        <div class="select">
                            <select name="rounds"{{ $has_societies ? '' : ' disabled' }}>
                                @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}"{{ old('rounds') == $i ? ' selected' : '' }}>{{ $i }} Round{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        @if ($errors->has('rounds'))
                            <span class="help-block">
                                <strong>{{ $errors->first('rounds') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-input text-center">
                        <button type="submit" class="btn">Create Tournament</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
		</div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="datepicker"]').datepicker({ autoHide: true, format: 'yyyy/mm/dd' });
    })
</script>
@endsection