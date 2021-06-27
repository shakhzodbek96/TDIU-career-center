<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('student.view');
        $students = Student::deepFilters()
            ->with([
                'faculty',
                'group',
                'status'
            ])
            ->latest()
            ->paginate(35);

        // Filter parameters
        $faculties = Faculty::all();
        $groups = Group::all();
        $statuses = Status::all();

        return view('pages.student.index',compact('students','groups','faculties','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('student.add');
        $faculties = Faculty::all();
        $groups = Group::all();
        $statuses = Status::all();
        return view('pages.student.add',compact('faculties','groups','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        abort_if_forbidden('student.add');
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'group_id' => 'nullable|numeric',
            'faculty_id' => 'nullable|numeric',
            'status_id'  => 'nullable|numeric'
        ]);

        Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'birth_date' => isset($request->birth_date) ? date('Y-m-d',strtotime($request->birth_date)):null,
            'phone' => $request->phone,
            'group_id' => $request->group_id,
            'faculty_id' => $request->faculty_id,
            'status_id' => $request->status_id
        ]);
        message_set("Yangi '$request->name' student muvoffaqiyatli qo'shildi!",'success',3);
        return redirect()->route('studentIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        abort_if_forbidden('student.edit');
        $student = Student::findOrFail($id);
        $faculties = Faculty::all();
        return view('pages.student.edit',compact('student','faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        abort_if_forbidden('student.edit');
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'group_id' => 'nullable|numeric',
            'faculty_id' => 'nullable|numeric',
            'status_id'  => 'nullable|numeric'
        ]);

        $student = Student::findOrFail($id);
        $student->fill([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'group_id' => $request->group_id,
            'faculty_id' => $request->faculty_id,
            'status_id' => $request->status_id
        ]);
        $student->save();
        message_set('Saqlandi!','success',1);
        return redirect()->route('studentIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        abort_if_forbidden('student.delete');

        $student = Student::findOrFail($id);
        $student->delete();
        message_set("Student o'chirib yuborildi!",'success',3);
        return redirect()->back();
    }
}
