@extends('layouts.public')

@section('content')

    @include('layouts/search')

    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    {{$sMessage}}
                </div>
            </div>
        </div>
    </div>

@endsection
