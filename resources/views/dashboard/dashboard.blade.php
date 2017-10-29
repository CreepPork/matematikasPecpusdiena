@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-ld-8 col-ld-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Statistika</div>
                <div class="panel-body">
                    @if (count($stats) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Klase</th>
                                        <th>1. komandas formula</th>
                                        <th>1. komandas rezultāts</th>
                                        <th>2. komandas formula</th>
                                        <th>2. komandas rezultāts</th>
                                        <th>Atrisināja</th>
                                        <th>Uzvarēja</th>
                                        <th>Skatīt vairāk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats as $stat)
                                        <tr>
                                            <td>{{$stat->class}}</td>
                                            <td>{{$stat->formulaTeam1}}</td>
                                            <td>{{$stat->resultTeam1}}</td>
                                            <td>{{$stat->formulaTeam2}}</td>
                                            <td>{{$stat->resultTeam2}}</td>
                                            <td>{!!filter_var($stat->didTeam1Finish, FILTER_VALIDATE_BOOLEAN) ? 'Jā' : '<span style="color:red">Nē</span>'!!}/{!!filter_var($stat->didTeam2Finish, FILTER_VALIDATE_BOOLEAN) ? 'Jā' : '<span style="color:red">Nē</span>'!!}</td>
                                            <td>{{$stat->victoryTeam == 0 ? 'Neviena komanda' : ($stat->victoryTeam.'. komanda')}}</td>
                                            <td><a href="/dashboard/{{$stat->id}}" class="btn btn-primary" role="button">Skatīt vairāk</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="/charts" class="btn btn-default" role="button">Grafiks</a>
                    @else
                        Nav datu!
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
