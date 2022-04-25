<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param ApplicationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ApplicationRequest $request): RedirectResponse
    {
        $lastApplication = Application::query()->where('user_id', auth()->user()->id)
                                            ->orderBy('created_at', 'desc')
                                            ->first();
        if (isset($lastApplication)) {
            $date = $lastApplication->created_at;
            $diff = $date->diffInMinutes(Carbon::now());
            if ($diff < 24) {
                return redirect()->back()->with('message', 'You can send only 1 application in 24 hours');
            }
        }
        $data['theme'] = $request->get('theme');
        $data['message'] = $request->get('message');
        $data['user_id'] = auth()->user()->id;
        $data['file_name'] = $data['user_id'].'-'.Carbon::now()->toDateString();
        $data['file_path'] = $request->file('file')->storeAs('files', $data['file_name']);
        Application::query()->create($data);
        return redirect()->back()->with('message', 'Application has been sent successfully');
    }
}
