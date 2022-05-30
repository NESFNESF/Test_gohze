<?php

namespace App\Http\Controllers;

use App\Http\Resources\DayResource;
use App\Http\Resources\TaskResource;
use App\Models\Day;
use App\Models\Task;
use App\Service\TaskService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /**
     * pour le chargement des tâches
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function load()
    {
        return Response::json(TaskService::all_task(),200);
    }
        /**
     * pour le chargement des tâches
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function load_web()
    {
        if(!empty(session('active_tasks'))){
            $days = session('days');
            $day = session('day');
            $tasks = session('tasks');
            return View('test2',compact('days','day','tasks'));
        }
        $days = Day::latest()
           ->orderBy('id', 'desc')
           ->get();
        if(empty($days[0])){
            return View('test2');
        };
        $day = $days[0];
        $tasks= TaskResource::collection(Task::where('day_id', $day['id'])->orderBy('id', 'DESC')->get()) ;
        session(['days' => $days]);
        session(['tasks' => $tasks]);
        session(['day' => $day]);
        session(['active_tasks' => 'true']);
        return View('test2',compact('days','day','tasks'));
    }

    /**
     * pour la creation d'une tache
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function create_task(Request $request)
    {
        try{
            $request->validate([
                'description'=> 'bail|required',
                'fin'=>'bail|required',
                'statut'=>'bail|required'
            ]);
            $input =$request->all();
            TaskService::new_task($input);
            return Response::json(TaskService::all_task(),200);
        }catch(Exception $e){
            return Response::json('internal server error',500);
        }
    }
        /**
     * pour la creation d'une tache
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function create_task_web(Request $request)
    {

            $request->validate([
                'description'=> 'bail|required',
                'fin'=>'bail|required',
                'statut'=>'bail|required'
            ]);
            $input =$request->all();
            TaskService::new_task($input);
            $day = session('day');
            $tasks= TaskResource::collection(Task::where('day_id', $day['id'])->orderBy('id', 'DESC')->get()) ;
            session(['tasks' => $tasks]);
            return redirect()->route('test2');

    }

        /**
     * pour la mise à jour d'une tache
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function update_task($id)
    {
        try{
            TaskService::update_task($id);
            return Response::json(TaskService::all_task(),200);
        }catch(Exception $e){
            return Response::json('internal server error',500);
        }
    }
            /**
     * pour la mise à jour d'une tache
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function update_task_web(Request $request)
    {
            $id = $request->id;
            TaskService::update_task($id);
            $day = session('day');
            $tasks= TaskResource::collection(Task::where('day_id', $day['id'])->orderBy('id', 'DESC')->get()) ;
            session(['tasks' => $tasks]);
            return redirect()->route('test2');

    }

        /**
     * pour la creation d'une journeé
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function create_day(Request $request)
    {
        try{
            $request->validate([
                'nom'=> 'bail|required',
                'statut'=>'bail|required'
            ]);
            $input =$request->all();
            TaskService::new_day($input);
            return Response::json(TaskService::all_task(),200);
        }catch(Exception $e){
            return Response::json('internal server error',500);
        }
    }
        /**
     * pour la creation d'une journeé
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function create_day_web(Request $request)
    {
            $request->validate([
                'nom'=> 'bail|required',
                'date'=>'bail|required',
                'statut'=>'bail|required'
            ]);
            $input =$request->all();
            TaskService::new_day($input);
            $request->session()->forget('active_tasks');
            return redirect()->route('test2');

    }
        /**
     * pour la mise à jour d'une journée
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function update_day($id)
    {
        try{
            TaskService::update_day($id);
            return Response::json(TaskService::all_task(),200);
        }catch(Exception $e){
            return Response::json('internal server error',500);
        }
    }
        /**
     * pour la mise à jour d'une journée
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function update_day_web(Request $request)
    {
            $id = $request->id;
            TaskService::update_day($id);

            $request->session()->forget('active_tasks');
            return redirect()->route('test2');

    }
        /**
     * pour changement de journée
     *
     * @return Illuminate\Support\Facades\Response;
     */
    public function change_day(Request $request){
        $id = $request->id;
        $days = Day::latest()
        ->orderBy('id', 'desc')
        ->get();
     $day = Day::find($id);
     $tasks= TaskResource::collection(Task::where('day_id', $day['id'])->orderBy('id', 'DESC')->get()) ;
     session(['days' => $days]);
     session(['tasks' => $tasks]);
     session(['day' => $day]);
     session(['active_tasks' => 'true']);
     return redirect()->route('test2');
    }



}
