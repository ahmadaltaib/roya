@extends('layouts.public')

@section('content')

    @include('layouts/search')

    <div class="container">
        <div class="recent">

            <div class="pb-2 mt-4 mb-2 border-bottom row recent-head">
                <div class="col-md-10">
                    <h3>{{__('roya.RECENT_SHOWS')}}</h3>
                </div>
                <div class="col-md-2">
                    <a href="{{url("/listshows/")}}"> {{__('roya.LIST_ALL')}}</a>
                </div>
            </div>

            <div class="row" class="recent-row">
                @foreach ($aShows as $show)
                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="{{url("/show/{$show->id}")}}"><img class="card-img-top" src="{{URL::asset('uploads/shows_thumbnail/'.$show->thumbnail)}}" alt="{{$show->title}}"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{url("/show/{$show->id}")}}">{{$show->title}}</a>
                                </h4>
                                <p class="card-text">{!! $show->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <br>

        <div class="recent">

            <div class="pb-2 mt-4 mb-2 border-bottom row recent-head">
                <div class="col-md-10">
                    <h3>{{__('roya.RECENT_EPISODES')}}</h3>
                </div>
                <div class="col-md-2">
                    <a href="{{url("/listepisodes")}}"> {{__('roya.LIST_ALL')}}</a>
                </div>
            </div>

            <div class="row" class="recent-row">
                @foreach ($aEpisodes as $aEpisode)
                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="{{url("/episode/{$aEpisode->id}")}}"><img class="card-img-top" src="{{URL::asset('uploads/episodes_thumbnail/'.$aEpisode->thumbnail)}}" alt="{{$aEpisode->title}}"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{url("/episode/{$aEpisode->id}")}}">{{$aEpisode->title}}</a>
                                </h4>
                                <p class="card-text">{!! $aEpisode->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
