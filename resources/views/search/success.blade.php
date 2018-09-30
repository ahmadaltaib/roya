@extends('layouts.public')

@section('content')

    @include('layouts/search')

    <div class="container">
        <br><br>
        <div class="row">
            @php
                $dCardsInRow = 0;
                foreach($aResults as $aResult){
                    $dCardsInRow++;
            @endphp
                    @if($aResult->_source->type == 'show')
                        @include('search.showCard')
                    @else
                        @include('search.episodeCard')
                    @endif
            @php
                    if($dCardsInRow == 4){
                        echo "</div><div class='row'";
                        $dCardsInRow = 0;
                    }
                }
            @endphp

        </div>
    </div>

@endsection
