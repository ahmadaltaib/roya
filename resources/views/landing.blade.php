@extends('layouts.public')

@section('content')

    @include('layouts/search')

    <div class="container">
        <div id="recent">

            <div class="pb-2 mt-4 mb-2 border-bottom" id="recent-head">

                <div id="recent-title">
                    <h3>{{__('roya.RECENT')}}</h3>
                </div>

                <div id="recent-link">
                    <a href="{{url("/list/")}}"> {{__('roya.LIST_ALL')}}</a>
                </div>

            </div>

            <div class="row" id="recent-row">
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
    </div>
@endsection
