<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('application.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function applicationData(): JsonResponse
    {
        $data = array();
        $applications = Application::with('user')->get();
        foreach ($applications as $application) {
            $nestedData['id'] = $application->id;
            $nestedData['theme'] = $application->theme;
            $nestedData['message'] = $application->message;
            $nestedData['first_name'] = $application->user->first_name;
            $nestedData['last_name'] = $application->user->last_name;
            $nestedData['email'] = $application->user->email;
            $nestedData['file_path'] = (isset($application->file_path))?$application->file_path:'';
            $nestedData['created_at'] = $application->created_at;
            $nestedData['status'] = $application->status;
            $data[] = $nestedData;
        }
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request): JsonResponse
    {
        $id = $request->get('id');
        Application::query()->find($id)->check();
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('application.create');
    }

    public function store(Request $request)
    {

    }
}
