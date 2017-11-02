@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-ld-8 col-ld-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Statistika klasei {{$stat->class}} | Uzvarēja {{$stat->victoryTeam}}. komanda | Laiks: 05:00</div>
            <div class="panel-body">
                <div class="table-responsive">
                <h4>1. komanda</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Formula</th>
                                <th>Rezultāts</th>
                                <th>Laiks</th>
                                <th>Mēģināja</th>
                                <th>Atrisināja</th>
                                <th>Padevās</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$stat->formulaTeam1}}</td>
                                <td>{{$stat->resultTeam1}}</td>
                                <td>{!!$timeTeam1!!}</td>
                                <td>{{$team1Tried}}</td>
                                <td>{!!filter_var($stat->didTeam1Finish, FILTER_VALIDATE_BOOLEAN) ? 'Jā' : '<span style="color:red">Nē</span>'!!}</td>
                                <td>{!!filter_var($stat->team1Surrender, FILTER_VALIDATE_BOOLEAN) ? '<span style="color:red">Jā</span>' : 'Nē'!!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                <h4>2. komanda</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Formula</th>
                                <th>Rezultāts</th>
                                <th>Laiks</th>
                                <th>Mēģināja</th>
                                <th>Atrisināja</th>
                                <th>Padevās</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$stat->formulaTeam2}}</td>
                                <td>{{$stat->resultTeam2}}</td>
                                <td>{!!$timeTeam2!!}</td>
                                <td>{{$team2Tried}}</td>
                                <td>{!!filter_var($stat->didTeam2Finish, FILTER_VALIDATE_BOOLEAN) ? 'Jā' : '<span style="color:red">Nē</span>'!!}</td>
                                <td>{!!filter_var($stat->team2Surrender, FILTER_VALIDATE_BOOLEAN) ? '<span style="color:red">Jā</span>' : 'Nē'!!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <small>Izveidots {{$created_at}}.</small>
            </div>
        </div>
    </div>
</div>
@endsection