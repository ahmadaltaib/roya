@extends('layouts.public')

@section('content')

    <div class="container">
        <div id="recent">

            <div class="card">
                <div class="card-header text-center">
                    <h3>{{$aDetails->show->title}}</h3>
                </div>
                <div class="card-body">
                    <h3>{!! $aDetails->show->description !!}</h3>
                </div>
                <div class="card-footer text-muted text-center">
                    {{$aDetails->show->show_time}}
                </div>
            </div>

            <br>

            <ul class="nav nav-tabs">
                @foreach ($aDetails->show->seasons as $season)
                    <li class="nav-item">
                        <a class="nav-link @if($dSeason == $season->id)active @endif" href="{{url("/show/{$aDetails->id}/season/{$season->id}")}}">{{__('roya.SEASON').$season->season_no}}</a>
                    </li>
                    @php
                        if($dSeason == $season->id){
                            $aSeasonEpisodes = $season->episodes;
                        }
                    @endphp
                @endforeach
            </ul>

            @include('show.episodeListing')
        </div>
    </div>

@endsection
