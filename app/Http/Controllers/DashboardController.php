<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statistic;
use Carbon\Carbon;

class DashboardController extends Controller
{
    var $data;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['stats'] = Statistic::orderBy('class')->get();
        return view('dashboard.dashboard')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Find our data
        $data['stat'] = Statistic::find($id);

        // Format our created at timestamp into a much more readable format
        Carbon::setLocale('lv');
        $data['created_at'] = Carbon::parse($data['stat']->created_at)->diffForHumans();

        // Set our data values to something that is understandable
        $stat = $data['stat'];
        
        // Set what team 1 tried into a string so Laravel doesn't complain
        $team1Tried = $stat['team1Tried'];
        // Remove our placeholder 'start' (because AJAX JSON removes an empty array (ehh))
        unset($team1Tried[0]);
        // If nothing is left (they didn't try anything)
        if (count($team1Tried) == 0)
        {
            $team1Tried = 'Nav mēģinājumu';
        }
        // If something is left (they did try)
        else
        {
            // Seperate each element by a comma and a space
            $team1Tried = implode($team1Tried, ', ');
        }
        $data['team1Tried'] = $team1Tried;

        // Same as previous, only for team 2
        $team2Tried = $stat['team2Tried'];
        unset($team2Tried[0]);
        if (count($team2Tried) == 0)
        {
            $team2Tried = 'Nav mēģinājumu';
        }
        else
        {
            $team2Tried = implode($team2Tried, ', ');
        }
        $data['team2Tried'] = $team2Tried;

        // Display message if team 1 didn't finish in time
        $timeTeam1 = $stat['timeTeam1'];
        if ($timeTeam1 == -1)
        {
            $timeTeam1 = '<span style="color: red">Beidzās laiks</span>';
        }
        $data['timeTeam1'] = $timeTeam1;

        // Same as previous but for team 2
        $timeTeam2 = $stat['timeTeam2'];
        if ($timeTeam2 == -1)
        {
            $timeTeam2 = '<span style="color: red">Beidzās laiks</span>';
        }
        $data['timeTeam2'] = $timeTeam2;

        return view('dashboard.show')->with($data);
    }

    /**
     * Show the charts that from the statistic data
     *
     * @return \Illuminate\Http\Response
     */
    public function charts()
    {
        $data['stats'] = Statistic::orderBy('class')->get();
        return view('dashboard.charts')->with($data);
    }

    /**
     * Get all data for charts
     *
     * @return \Illuminate\Http\Response
     */
    public function charts_data()
    {
        $stats = Statistic::orderBy('class')->get();
        return $stats;
    }
}
