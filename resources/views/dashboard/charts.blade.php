@extends('layouts.app')

@section ('content')
    <div class="row">
        <div class="col-ld-8 col-ld-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Grafiks</div>
                <div class="panel-body">
                    <h4>Cik ātri atrisināja:</h4>
                    <canvas id="timeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection