@extends('dashboard.layout')

@section('content')

    <h2 class="page-header">{{ ucfirst('users') }}</h2>

    <div class="panel panel-default">
        <div class="panel-heading">
             {{ __("roya.LIST_OF").' '.__('roya.USERS') }}
        </div>

        <div class="panel-body">
            <div class="">
                <table class="table table-striped" id="thegrid">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
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
                "ajax": "{{url('/admin/users/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/admin/users') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    }
                ]
            });
        });
    </script>
@endsection