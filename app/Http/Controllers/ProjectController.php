<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $projectID)
    {
        $project = Project::with('entries')->find($projectID);
        return view('projects.show', ['project' => $project]);
    }

    public function add(Request $request)
    {
        $project = Project::firstOrCreate([
            'name' => $request->get('name')
        ]);

        if($project->wasRecentlyCreated === false) {
            return response()->json(['status' => 'Project with same name already exits']);
        }

        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $project = Project::find($request->get('id'));
        $project->name = $request->get('name');

        if($project->where('name',$project->name)->count() === 0){
            $project->save();
        }else{
            return response()->json(['status' => 'Project with same name already exits']);
        }
        return response()->json(['status' => 'success']);
    }
}
