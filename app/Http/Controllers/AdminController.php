<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statistic;
use App\User;

class AdminController extends Controller
{
    var $data;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['users'] = User::get();
        $data['stats'] = Statistic::get();
        return view('admin.index')->with($data);
    }

    public function stats_delete($id)
    {
        $stat = Statistic::find($id);
        $stat->delete();
        return redirect('/admin');
    }
}
