<?php

namespace App\Http\Controllers;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {

        // $data = Students::where('age', '<', '20')->orderBy('first_name', 'asc') ->limit(3) ->get();

        // $data = DB::table('students')
        //     ->select(DB::raw('count(*) as gender_count, gender'))->groupBy('gender')->get();

        // $data = Students::all();
        //return view('students.index', ['students' => $data]);

        $data = array("students"=> DB::table('students')->orderBy('created_at', 'desc')->paginate(10));
        return view('students.index', $data);
    }

    public function create(){
        return view ('students.create')->with('title', 'Add New');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender" => ['required'],
            "age" => ['required'],
            "email" => ['required', 'email', Rule::unique('students', 'email')],

       ]);
        Students::create($validated);

        return redirect('/')->with('message', 'New Student was added successfully');
    }

    public function show($id){
        $data = Students::findOrFail($id);
        return view ('students.edit', ['student' => $data]);
    }

    public function update(Request $request, Students $student){


        $validated = $request->validate([
            "first_name" => ['required', 'min:4'],
            "last_name" => ['required', 'min:4'],
            "gender" => ['required'],
            "age" => ['required'],
            "email" => ['required', 'email'],
       ]);

       $student->update($validated);

       return back()->with('message', 'Data was successfully updated');
    }

    public function destroy(Request $request, Students $student){
        $student->delete();
        return redirect('/')->with('message', 'Data was successfully deleted.');
    }
}
