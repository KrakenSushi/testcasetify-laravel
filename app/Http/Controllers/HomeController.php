<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectModel;
use App\Models\TestCaseModel;
use PHPUnit\Event\Code\Test;

class HomeController extends Controller
{
    public function showDashboard()
    {
        $totalTestCases = TestCaseModel::count();
        $totalProjects = ProjectModel::count();
        $activeProjects = ProjectModel::where('project_owner', Auth::id())->where('status', 1)->count();
        $inactiveProjects = ProjectModel::where('project_owner', Auth::id())->where('status', 0)->count();

        $recent = ProjectModel::where('project_owner', Auth::id())->orderBy('last_access', 'DESC')->get();



        return view('index', compact('totalTestCases', 'activeProjects', 'inactiveProjects', 'totalProjects', 'recent'));
    }
}
