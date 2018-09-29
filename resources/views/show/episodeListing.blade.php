
<br><br>

@if(count($aSeasonEpisodes) > 0)
    <div class="row" id="episodes-row">
        @foreach ($aSeasonEpisodes as $episode)
            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <a href="{{url("/episode/{$episode->id}")}}"><img class="card-img-top" src="{{URL::asset('uploads/shows_thumbnail/'.$episode->thumbnail)}}" alt="{{$episode->title}}"></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{url("/episode/{$episode->id}")}}">{{$episode->title}}</a>
                        </h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-danger" role="alert">
        {{__('roya.NO_EPISODES')}}
    </div>
@endif


