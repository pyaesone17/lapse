<?php

namespace Pyaesone17\Lapse\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return $this->getExceptionData($request);
        }

        return view('lapse::app');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $log = DatabaseNotification::find($request->id);    
        $log->class = $log->data['class'];
        $log->title = $log->data['title'];
        $log->content = $log->data['content'];
        $log->user_id = $log->data['user_id'];
        $log->url = $log->data['url'];

        return response()->json($log, 200);
    }

    protected function getExceptionData($request)
    {
        $logs = DatabaseNotification::latest()->paginate($request->per_page);
        
        $logs->each(function ($log)
        {
            $log->class = $log->data['class'];
            $log->title = $log->data['title'];
            $log->content = $log->data['content'];
            $log->user_id = $log->data['user_id'];
            $log->url = $log->data['url'];
        });

        return response()->json($logs, 200);
    }
}