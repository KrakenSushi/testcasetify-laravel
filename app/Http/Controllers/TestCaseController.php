<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\ProjectModel;
use App\Models\TestCaseModel;
use App\Models\TestStepModel;


class TestCaseController extends Controller
{
    function showTestCases()
    {
        $projects = ProjectModel::where('project_owner', Auth::id())->get();
        return view('pages/test-cases', compact('projects'));
    }

    function newTestCase()
    {
        $data = ProjectModel::where('project_id',  session('active_project'))
                    ->select('project_members')
                    ->first();
        if (str_contains($data['project_members'], "\r\n")) {
            $members = explode("\r\n", $data['project_members']);
        } elseif (str_contains($data['project_members'], "\n")) {
            $members = explode("\n", $data['project_members']);
        } else {
            $members = $data['project_members'];
        }

        $autoIncrementValue = DB::table('information_schema.TABLES')
            ->select('AUTO_INCREMENT AS AI')
            ->where('TABLE_SCHEMA', '=', 'testcasetify-laravel')
            ->where('TABLE_NAME', '=', 'tbl_test_cases')
            ->value('AI');

        return view('pages/new-test-case', compact('members', 'autoIncrementValue'));
    }

    function saveTestCase(Request $request)
    {
        $data = $request->all();
        // dd($data);
        try {
            $testCase = TestCaseModel::updateOrCreate(['id' => $data['tc_id']],
            [
                'project_id' => session('active_project'),
                'tc_title' => $data['tc_title'],
                'tc_num' => $data['tc_num'],
                'tc_des_by' => $data['tc_des_by'],
                'tc_priority' => $data['tc_prio'],
                'tc_des_date' => $data['tc_des_date'],
                'tc_module_name' => $data['tc_mod_name'],
                'tc_exec_by' => $data['tc_exec_by'],
                'tc_desc' => $data['tc_desc'],
                'tc_exec_date' => $data['tc_exec_date'],
                'tc_precon' => $data['tc_precon'],
                'tc_postcon' => $data['tc_postcon']
            ]
        );

        return response('0'); // Success
        } catch (QueryException $e) {
            // Log or handle the error
            return response('Error:' . $e->getMessage()); // Error
        }
    }

    function testCase(Request $request)
    {
        $data = $request->only('id');

        $result = TestCaseModel::where('id', $data['id'])->first();

        $data = ProjectModel::where('project_id',  session('active_project'))
                    ->select('project_members')
                    ->first();

        if (str_contains($data['project_members'], "\r\n")) {
            $members = explode("\r\n", $data['project_members']);
        } elseif (str_contains($data['project_members'], "\n")) {
            $members = explode("\n", $data['project_members']);
        } else {
            $members = $data['project_members'];
        }
        
        return view('pages/test-case', compact('result', 'members'));
    }

    function testSteps(Request $request)
    {
        return view('pages/test-steps');
    }

    ##################################__Helper_Functions__############################################

    function setActiveProject(Request $request)
    {
        $data = $request->only('project_id');

        session(['active_project' => $data['project_id']]);

        $query = TestCaseModel::where('project_id', $data['project_id']);

        $updateTimestamp = ProjectModel::where('project_id', $data['project_id'])
            ->where('project_id', session('active_project'));
        $updateTimestamp->update(['last_access' => now()]);

        $rowCountTC = $query->count();
        $testCases = $query->get();


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
            return response()->json(['html' => view('ajax/tc_list', compact('testCases'))->render()]);
        }
    }

    function unsetActiveProject(Request $request)
    {
        $data = $request->only('project_id');

        // session(['active_project' => $data['project_id']]);
        session()->forget('active_project');

    }

    function checkTestCaseNum(Request $request)
    {
        $data = $request->only('tc_num');

        $rc = TestCaseModel::where('tc_num', $data['tc_num'])
            ->where('project_id', session('active_project'))
            ->count();
        if($rc !== 0){
            return response($rc);
        }else{
            return 0;
        }
    }

    function fetchTestSteps(Request $request)
    {
        $data = $request->only('tc_id');

        $testSteps = TestStepModel::where('test_case_id', $data['tc_id'])->get();

        return response()->json(['html' => view('ajax/ts_steps', compact('testSteps'))->render()]);
    }

    function saveTestSteps(Request $request)
    {
        $data = $request->all();
        $record = $data['data'];
        $tc_id = $data['tc_id'];
        $jsonData = json_decode($record, true);

        try{
            foreach($jsonData as $row)
            {
                $step = $row['Step']['span'];
                $testStep = $row['Test Step']['textarea1'];
                $testData = $row['Test Data']['textarea2'];
                $expectedResult = $row['Expected Result']['textarea3'];
                $actualResult = $row['Actual Result']['textarea4'];
                $status = $row['Status']['input'];

                $query = TestStepModel::updateOrCreate([
                    'test_case_id' => $tc_id, 
                    'step_num' => $step, 
                    'project_id' => session('active_project'),
                ],
                [   
                    'test_case_id' => $tc_id,
                    'test_step' => $testStep,
                    'test_data' => $testData,
                    'expected_result' => $expectedResult,
                    'actual_result' => $actualResult,
                    'status' => $status
                ]);
            }
            return response('OK');
        } catch (QueryException $e) {
            return response('Error:' . $e->getMessage()); // Error
        }
    }

    function deleteTestSteps(Request $request)
    {
        $data = $request->only('step_num', 'tc_id');

        $deleteStep = TestStepModel::where('step_num', $data['step_num'])
            ->where('test_case_id', $data['tc_id'])
            ->where('project_id', session('active_project'))
            ->first();
        
        if($deleteStep)
        {
            if($deleteStep->delete()){
                return response('OK');
            }else{
                return response('Error');
            }
        }else{
            return response('Error');
        }
    }

}
