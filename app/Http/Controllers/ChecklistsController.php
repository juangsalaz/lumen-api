<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checklist;

class ChecklistsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {

        $objectDomain = $request->input('data.attributes.object_domain');
        $objectId = $request->input('data.attributes.object_id');
        $due = $request->input('data.attributes.due');
        $urgency = $request->input('data.attributes.urgency');
        $description = $request->input('data.attributes.description');

        $checlists = Checklist::create([
            'object_domain' => $objectDomain,
            'object_id' => $objectId,
            'due' => $due,
            'urgency' => $urgency,
            'description' => $description,
            'is_completed' => 0
        ]);

        if ($checlists) {
            return response()->json([
                'data' => [
                    'type' => 'checklists',
                    'id' => $checlists->id,
                    'attributes' => $checlists,
                    'links' => [
                        'self' => route('checklist').'/'.$checlists->id
                    ]
                ]
            ], 201);
        }
    }

    public function show()
    {
        $checklists = Checklist::all();

        if ($checklists) {
            return response()->json([
                'meta' => [
                    'total' => count($checklists)
                ],
                'links' => [],
                'data' => $checklists
            ], 200);
        }
    }

    public function getChecklist($checklistId)
    {
        $checklist = Checklist::find($checklistId);

        if ($checklist) {
            return response()->json([
                'data' => [
                    'type' => 'checklists',
                    'id' => $checklist->id,
                    'attributes' => $checklist,
                    'links' => [
                        'self' => route('checklist').'/'.$checklist->id
                    ]
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => '404',
                'error' => 'Not Found'
            ], 404);
        }
    }

    public function update(Request $request, $checklistId)
    {
        $checklist = Checklist::find($checklistId);

        if ($checklist) {
            $checklist->object_domain = $request->input('data.attributes.object_domain');
            $checklist->object_id = $request->input('data.attributes.object_id');
            $checklist->due = $request->input('data.attributes.due');
            $checklist->urgency = $request->input('data.attributes.urgency');
            $checklist->description = $request->input('data.attributes.description');

            $checklist->save();

            return response()->json([
                'data' => [
                    'type' => 'checklists',
                    'id' => $checklist->id,
                    'attributes' => $checklist,
                    'links' => [
                        'self' => route('checklist').'/'.$checklist->id
                    ]
                ]
            ], 200);


        } else {
            return response()->json([
                'status' => '404',
                'error' => 'Not Found'
            ], 404);
        }

    }

    public function destroy($checklistId)
    {
        $checklist = Checklist::find($checklistId);

        if ($checklist) {
            $checklist->delete();

            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => '404',
                'error' => 'Not Found'
            ], 404);
        }
    }
}
