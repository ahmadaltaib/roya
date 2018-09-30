<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
    <div class="card h-100">
        <a href="{{url("/episode/{$aResult->_source->id}")}}"><img class="card-img-top" src="{{URL::asset('uploads/episode_thumbnail/'.$aResult->_source->thumbnail)}}" alt="{{$aResult->_source->title}}"></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{url("/episode/{$aResult->_source->id}")}}">{{$aResult->_source->title}}</a>
            </h4>
        </div>
    </div>
</div>