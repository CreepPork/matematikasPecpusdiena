<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Home;
use App\Statistic;

class HomeController extends Controller
{
    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Home = new Home;

        $data['teams'] = ['5.a', '5.b', '5.c', '5.d', '5.e'];

        $data['formulas'] = Home::orderBy(DB::raw('RAND()'))->take(2)->get();

        return view('home')->with($data);
    }

    /**
     * Store statistics in the DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get the POSTed data
        $data = $request->all();
        
        // Create our statistic model in this scope
        $statistic = new Statistic;

        // Set our variables
        $statistic->class = $request->input('class');
        $statistic->victoryTeam = $request->input('victoryTeam');
        $statistic->team1Surrender = $request->input('team1Surrender');
        $statistic->team2Surrender = $request->input('team2Surrender');
        $statistic->timeTeam1 = $request->input('timeTeam1');
        $statistic->timeTeam2 = $request->input('timeTeam2');
        $statistic->didTimeRunOut = $request->input('didTimeRunOut');
        $statistic->didTeam1Finish = $request->input('didTeam1Finish');
        $statistic->didTeam2Finish = $request->input('didTeam2Finish');
        $statistic->formulaTeam1 = $request->input('formula1');
        $statistic->formulaTeam2 = $request->input('formula2');
        $statistic->resultTeam1 = $request->input('result1');
        $statistic->resultTeam2 = $request->input('result2');
        $statistic->enteredResultTeam1 = $request->input('enteredResult1');
        $statistic->enteredResultTeam2 = $request->input('enteredResult2');
        $statistic->attemptsTeam1 = $request->input('attempts1');
        $statistic->attemptsTeam2 = $request->input('attempts2');
        $statistic->timeRanOutForTeam = $request->input('timeRanOutForTeam');
        $statistic->team1Tried = $request->input('team1Tried');
        $statistic->team2Tried = $request->input('team2Tried');

        // Save all of our data to the database
        $statistic->save();

        // Return a message that tells everything's ok
        return response()->json(['success' => true]);
    }
}
