<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    public function showProjects()
    {
        $project = ProjectModel::where('project_owner', Auth::id())->get();
        $rowCount = $project->count();

        return view('pages/projects', compact('project', 'rowCount'));
    }

    public function saveProject(Request $reqquest)
    {
        $data = $reqquest->all();

        $project = new ProjectModel([
            'project_name' => $data['p_name'],
            'project_owner' => Auth::id(),
            'project_members' => $data['p_members'],
            'project_desc' => $data['p_desc'],
            'status' => 1
        ]);

        if($project->save()){
            return redirect()->route('projects')->with('success', 'Successfully Saved Project!');
        }else{
            return redirect()->route('projects')->with('err', 'Failed to Save Project!');
        }
    }

    function updateProject(Request $request)
    {
        $data = $request->all();

        if($request->has('projStatus')) {
            $activeStatus = 1;
        } else {
            $activeStatus = 0;}

        $project = ProjectModel::where('project_id', $data['proj_id']);
        $status = $project->update([
            'project_name' => $data['edit_p_name'],
            'project_members' => $data['edit_p_members'],
            'project_desc' => $data['edit_p_desc'],
            'status' => $activeStatus,
        ]);

        if($status){
            return redirect()->route('projects')->with('success', 'Successfully Updated Project!');
        }else{
            return redirect()->route('projects')->with('err', 'Failed to Update Project!');
        }

    }

    function deleteProject(Request $request)
    {
        $data = $request->only('id');

        $project = ProjectModel::where('project_id', $data['id']);

        if($project->delete()){
            return redirect()->route('projects')->with('success', 'Successfully Deleted Project!');
        }else{
            return redirect()->route('projects')->with('err', 'Failed to Delete Project!');
        }
    }

    ##################################__Helper_Functions__############################################
    function fetchProjectInfo(Request $request)
    {
        $data = $request->only('project_id');

        $project = ProjectModel::where('project_id', $data['project_id'])
            ->select('project_id', 'project_name', 'project_members', 'project_desc', 'status')
            ->first();


        return response($project);
    }
}
