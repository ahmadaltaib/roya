@extends('dashboard.layout')

@section('content')

<h2 class="page-header">{{ __('roya.SHOWS') }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ __("roya.LIST_OF").' '.__('roya.SHOWS') }}
        </div>
        <div class="panel-body">
            <div class="">
                <table class="table table-striped" id="thegrid">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Show Time</th>
                            <th>Thumbnail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": true,
                "ajax": "{{url('admin/shows/grid')}}",
                "columnDefs": [
                ]
            });
        });
    </script>
@endsection