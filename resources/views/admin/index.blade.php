@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administrātora panelis</div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <h4>Statistika</h4>
                    @if (count($stats) > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Klase</th>
                                    <th>Skatīt vairāk</th>
                                    <th>Dzēst</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($stats as $stat)
                                <tr>
                                    <td>{{$stat->id}}</td>
                                    <td>{{$stat->class}}</td>
                                    <td><a href="/dashboard/{{$stat->id}}" class="btn btn-primary">Skatīt vairāk</a></td>
                                    <td><a href="/admin/stats/delete/{{$stat->id}}" class="btn btn-danger">Dzēst</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    Nav datu!
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection