@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row border-bottom" >
            <div class="col-md-9">
                <h3>{{$aDetails->title}}</h3>
            </div>
            <div class="col-md-3" id="rate-area">
                @if(count($aRate) >= 1 &&  in_array ( $aRate[0]->rate, array('like', 'dislike')))
                    {!! __('roya.RATE', ['rate'=>__("roya.".strtoupper($aRate[0]->rate))]) !!} <a href="#" id="undo-rate" data-id="{{$aRate[0]->id}}" data-episode="{{$aDetails->id}}"> {{__('roya.UNDO_RATE')}}</a>
                @else
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button id="like"    data-id="{{$aDetails->id}}" type="button" class="btn btn-success">{{__('roya.LIKE')}} <i class="fa fa-thumbs-up"></i></button>
                        <button id="dislike" data-id="{{$aDetails->id}}" type="button" class="btn btn-danger">{{__('roya.DISLIKE')}} <i class="fa fa-thumbs-down"></i></button>
                    </div>
                @endif
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-4">
                <img class="img-thumbnail" width="304" height="236" src="{{URL::asset('uploads/episodes_thumbnail/'.$aDetails->thumbnail)}}" alt="{{$aDetails->title}}">
            </div>

            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td>{{__('roya.SHOW_NAME')}}</td>
                        <td>{{$aDetails->season->show->title}}</td>
                    </tr>
                    <tr>
                        <td>{{__('roya.SHOW_TIME')}}</td>
                        <td>{{$aDetails->season->show->show_time}}</td>
                    </tr>
                    <tr>
                        <td>{{__('roya.SEASONE_NO')}}</td>
                        <td>{{$aDetails->season->season_no}}</td>
                    </tr>
                    <tr>
                        <td>{{__('roya.LENGTH')}}</td>
                        <td>{{$aDetails->show_time}}</td>
                    </tr>
                    <tr>
                        <td>{{__('roya.DESCRIPTION')}}</td>
                        <td>{{$aDetails->description}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="offset-md-1 col-md-9">
                <video width="900" controls>
                    <source src="{{URL::asset('uploads/episode_content/'.$aDetails->video)}}" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
        </div>
    </div>
@endsection
