@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="pb-2 mt-4 mb-2 border-bottom" id="recent-head">
            <div>
                <h3>{{__('roya.LIST_ALL_SHOWS')}}</h3>
            </div>
        </div>

        <div class="row" id="recent-row">
            @foreach ($aShows as $show)
                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="{{url("/show/{$show->id}")}}"><img class="card-img-top" src="{{URL::asset('uploads/shows/'.$show->thumbnail)}}" alt="{{$show->title}}"></a>
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

        @if($dPages > 1)
            <ul class="pagination justify-content-center">
                @for ($dPage = 1; $dPage <= $dPages; $dPage++)
                    <li class="page-item @if($dPage == $dCurrentPages)active @endif">
                        <a class="page-link" href="@if($dPage == $dCurrentPages) # @else {{url("/listshows/{$dPage}")}} @endif"> {{$dPage}}</a>
                    </li>
                @endfor
            </ul>
        @endif
    </div>
@endsection
