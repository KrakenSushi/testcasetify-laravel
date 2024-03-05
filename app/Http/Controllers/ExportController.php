<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

use App\Models\TestCaseModel;
use App\Models\TestStepModel;
use App\Models\ProjectModel;

class ExportController extends Controller
{
    function showExportables()
    {
        $projects = ProjectModel::where('project_owner', Auth::id())->get();
        return view('pages/export', compact('projects'));
    }

    function print(Request $request)
    {
        $data = $request->only('tc');

        $project = ProjectModel::where('project_id', session('active_project'))->first();
        $testCase = TestCaseModel::where('id', $data['tc'])->first();
        $testSteps = TestStepModel::where('test_case_id', $data['tc'])->get();


        // Render the Blade view
        $html = View::make('layouts/print')->with(['testCase' => $testCase, 'testSteps' => $testSteps, 'project' => $project])->render();

        // Create new mPDF instance
        $mpdf = new Mpdf();

        // Add HTML content to PDF
        $mpdf->WriteHTML($html);

        $filename = $project['project_name'] . " - " . $testCase['tc_title'];

        // Output PDF
        $mpdf->Output($filename, 'I');
    }

    function printAll(Request $request)
    {
        $data = $request->only('id');

        $project = ProjectModel::where('project_id', session('active_project'))->first();
        $testCase = TestCaseModel::where('project_id', session('active_project'))->get();
        $testSteps = TestStepModel::where('project_id', session('active_project'))->get();

        // Render the Blade view
        $html = View::make('layouts/printAll')->with(['testCase' => $testCase, 'testSteps' => $testSteps, 'project' => $project])->render();

        // Create new mPDF instance
        $mpdf = new Mpdf([
            'pagenumPrefix' => 'Page ',
            'nbpgPrefix' => ' of ',
        ]);

        $mpdf->defaultheaderline = 0;
        $mpdf->defaultfooterline = 0;
        $mpdf->setHeader('{PAGENO}{nbpg}');
        $mpdf->setFooter('<div style="text-align: right; font-size: 10px;">&copy;TestCasetify <a href="https://github.com/KrakenSushi">KrakenSushi</a></div>');


        // Add HTML content to PDF
        $mpdf->WriteHTML($html);

        $filename = $project['project_name'] . " - Test Cases";

        // Output PDF
        $mpdf->Output($filename, 'I');
    }

    ########################__Helper_Functions__##########################

    function fetchPrintCases(Request $request)
    {
        $data = $request->only('project_id');

        session(['active_project' => $data['project_id']]);
        
        $testCases = TestCaseModel::where('project_id', session('active_project'))->get();
        $rowCountTC = TestCaseModel::where('project_id', session('active_project'))->count();
        if($rowCountTC == 0)
        {
            return '
                <center class="mt-4">
                    <h3 class="text-warning fw-bolder text-uppercase mb-3">No Test Cases</h3>
                    <a href="/new-test-case" class="btn btn-link">
                        Create one <i class="fas fa-plus"></i>
                    </a>
                </center>
            ';
        }
        else{
            return response()->json(['html' => view('ajax/ex_list', compact('testCases'))->render()]);
        }
    }
}
