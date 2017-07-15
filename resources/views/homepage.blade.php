@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="panel">
        <div class="panel-title">Recent Tournaments</div>
        <div class="panel-content">
            <div class="list">
                <a href="#">
                    <span>Fairway Blues Inaugural Open</span>
                    <span class="text-right"><strong>Purse:</strong> 7200 / <strong>Field:</strong> 19</span>
                </a>
                <a href="#">
                    <span>Fairway Blues Inaugural Open</span>
                    <span class="text-right"><strong>Purse:</strong> 7200 / <strong>Field:</strong> 19</span>
                </a>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a href="#" class="btn icon-right with-margin-top">
            More Tournaments
            <i class="fa fa-caret-right"></i>
        </a>
    </div>
    <div class="panel">
        <div class="panel-title">New Societies</div>
        <div class="panel-content">
            <div class="list">
                <a href="#">
                    <span>Fairway Blues</span>
                    <span class="text-right"><strong>Finished Tournaments:</strong> 1 / <strong>Total Payout:</strong> 7200</span>
                </a>
                <a href="#">
                    <span>Kessel's Gentlemens Club</span>
                    <span class="text-right"><strong>Finished Tournaments:</strong> 5 / <strong>Total Payout:</strong> 7200</span>
                </a>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a href="#" class="btn icon-right with-margin-top">
            More Societies
            <i class="fa fa-caret-right"></i>
        </a>
    </div>
</div>
@endsection
