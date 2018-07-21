<?php

namespace Pyaesone17\Lapse\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pyaesone17\Lapse\Http\Middleware\Authenticate;
use Pyaesone17\Lapse\Models\Lapse;

class LapseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lapses = Lapse::latest()->paginate($request->per_page);
        if($request->wantsJson()){
            return response()->json([ 'data' => $lapses ],200);
        }
        return view('lapse::index',compact('lapses'));
    }

    /**
     * Display the detail of the lapse
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $lapse = Lapse::find($request->id);    
        if($request->wantsJson()){
            return response()->json([ 'data' => $lapse ],200);
        }
        return view('lapse::detail',compact('lapse'));
    }

    /**
     * Delete the record
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Lapse::findOrFail($id)->delete();    
        if($request->wantsJson()){
            return response()->json([ 'data' => $id ],200);
        }

        return redirect()->route('lapse.index');
    }

    /**
     * Delete all of the records
     *
     * @return \Illuminate\Http\Response
     */
    public function clear(Request $request)
    {
        Lapse::truncate();    
        if($request->wantsJson()){
            return response()->json([],200);
        }

        return redirect()->back();
    }
}