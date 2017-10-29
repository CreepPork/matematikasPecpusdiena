@extends('layouts.app')

@section('content')
<input type="hidden" name="resultFormula1" id="resultFormula1" value="{{$formulas[0]['result']}}">
<input type="hidden" name="resultFormula2" id="resultFormula2" value="{{$formulas[1]['result']}}">
<input type="hidden" name="secretItem" id="secretItem">
    <div>
        <div class="container">
            <h1 class="text-center">Matemātikas restlings</h1>
            <h1 class="text-center" id="timer">05:00</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h2>Komanda 1</h2>
                        <div class="alert alert-danger notVisible" id="alert1">
                            <strong id="alert1_title">No title set!</strong>
                            <span id="alert1_body">No body set!</span>
                        </div>
                        <div class="form-group"><span class="label label-default">Formula </span>
                            <textarea readonly class="form-control" id="formula1">{{$formulas[0]['formula']}}</textarea>
                        </div>
                        <div class="form-group"><span class="label label-default">Rezultāts </span>
                            <input type="text" id="resultBox1" required autocomplete="off" class="form-control" />
                        </div>
                        <div class="form-group">
                            <div role="group" class="btn-group">
                                <input type="button" value="Pārbaudīt" class="btn btn-default" id="check1">
                                <input type="button" value="Rezultāts" class="btn btn-default" id="showResult1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well">
                    <h2>Komanda 2</h2>
                    <div class="alert alert-danger notVisible" id="alert2">
                        <strong id="alert2_title">No title set!</strong>
                        <span id="alert2_body">No body set!</span>
                    </div>
                        <div class="form-group"><span class="label label-default">Formula </span>
                            <textarea readonly class="form-control" id="formula2">{{$formulas[1]['formula']}}</textarea>
                        </div>
                        <div class="form-group"><span class="label label-default">Rezultāts </span>
                            <input type="text" required autocomplete="off" id="resultBox2" class="form-control" />
                        </div>
                        <div class="form-group">
                            <div role="group" class="btn-group">
                                <input type="button" value="Pārbaudīt" class="btn btn-default" id="check2">
                                <input type="button" value="Rezultāts" class="btn btn-default" id="showResult2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
