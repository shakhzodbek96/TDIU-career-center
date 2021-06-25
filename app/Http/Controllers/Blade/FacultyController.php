<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('faculty.view');
        $faculties = Faculty::all();
        return view('pages.faculty.index',compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('faculty.add');
        return view('pages.faculty.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        abort_if_forbidden('faculty.add');
        $request->validate([
            'name' => 'required'
        ]);

        Faculty::create([
            'name' => $request->name
        ]);
        message_set("Yangi '$request->name' fakulteti muvoffaqiyatli qo'shildi!",'success',3);
        return redirect()->route('facultyIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        abort_if_forbidden('faculty.edit');
        $faculty = Faculty::findOrFail($id);
        return view('pages.faculty.edit',compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        abort_if_forbidden('faculty.edit');
        $request->validate([
            'name' => 'required|unique:faculties,name,'.$id
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->fill([
            'name' => $request->name
        ]);
        $faculty->save();
        message_set('Saqlandi!','success',1);
        return redirect()->route('facultyIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        abort_if_forbidden('faculty.delete');

        $faculty = Faculty::findOrFail($id);
        $groups = $faculty->groups()->count();
        if ($groups)
        {
            message_set("Ushbu fakultetda guruhlar mavjud o'chirishdan oldin ushbu fakultetga tegishli guruhlarni o'chirish yoki boshqa fakultetga biriktirish lozim!",'warning',7);
            // there should be redirect to groups list with this status, it will be done later
        }
        else
        {
            $faculty->delete();
            message_set("'$faculty->name' fakulteti o'chirib yuborildi!",'success',3);
        }
        return redirect()->back();
    }
}
