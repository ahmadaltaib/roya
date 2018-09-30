@extends('layouts.public')

@section('content')

    <div class="container">
        <div id="recent">

            <div class="card">
                <div class="card-header">
                    <div class="row" >
                        <div class="col-md-10">
                            <h3>{{$aDetails->title}}</h3>
                        </div>
                        <div id="following-area" class="col-md-2">
                            @auth
                                @if(count($aFollower) >= 1)
                                    <button id="unfollow" data-id="{{$aFollower['0']->id}}" data-show="{{$aDetails->id}}" type="button" class="btn btn-primary"><i class="fa fa-minus"></i> {{__('roya.UNFOLLOW')}}</button>
                                @else
                                    <button id="follow" data-id="{{$aDetails->id}}" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('roya.FOLLOW')}}</button>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h3>{!! $aDetails->description !!}</h3>
                </div>
                <div class="card-footer text-muted text-center">
                    {{$aDetails->show_time}}
                </div>
            </div>

            @if(count($aDetails->seasons) > 0)
                <br>
                <ul class="nav nav-tabs">
                    @php $bActive = 'active' @endphp
                    @foreach ($aDetails->seasons as $season)
                        <li class="nav-item">
                            <a class="nav-link @if($bActive == 'active'){{$bActive}}@endif" href="{{url("/show/{$aDetails->id}/season/{$season->id}")}}">{{__('roya.SEASON').$season->season_no}}</a>
                        </li>
                        @php
                            if($bActive == 'active'){
                                $bActive = '';
                                $aSeasonEpisodes = $season->episodes;
                            }
                        @endphp
                    @endforeach
                </ul>

                @include('show.seasonEpisodesListing')

            @else
                <br>
                <div class="alert alert-danger" role="alert">
                    {{__('roya.NO_SEASONS')}}
                </div>
            @endif
        </div>
    </div>

@endsection
