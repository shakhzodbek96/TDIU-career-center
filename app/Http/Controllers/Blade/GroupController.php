<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if_forbidden('group.view');
        $groups = Group::with('faculty')->latest()->get();
        return view('pages.group.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('group.add');
        $faculties = Faculty::all();
        return view('pages.group.add',compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        abort_if_forbidden('group.add');
        $request->validate([
            'name' => 'required',
            'begin' => 'numeric',
            'end' => 'numeric',
            'faculty_id' => 'nullable|numeric'
        ]);

        Group::create([
            'name' => $request->name,
            'begin' => $request->begin,
            'end' => $request->end,
            'faculty_id' => $request->faculty_id
        ]);
        message_set("Yangi '$request->name' guruh muvoffaqiyatli qo'shildi!",'success',3);
        return redirect()->route('groupIndex');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        abort_if_forbidden('group.edit');
        $group = Group::findOrFail($id);
        $faculties = Faculty::all();
        return view('pages.group.edit',compact('group','faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        abort_if_forbidden('group.edit');
        $request->validate([
            'name' => 'required',
            'begin' => 'nullable|numeric',
            'end' => 'nullable|numeric',
            'faculty_id' => 'nullable|numeric'
        ]);

        $group = Group::findOrFail($id);
        $group->fill([
            'name' => $request->name,
            'begin' => $request->begin,
            'end' => $request->end,
            'faculty_id' => $request->faculty_id
        ]);
        $group->save();
        message_set('Saqlandi!','success',1);
        return redirect()->route('groupIndex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        abort_if_forbidden('group.delete');

        $group = Group::findOrFail($id);
        $groups = $group->students()->count();
        if ($groups)
        {
            message_set("Ushbu guruhda studentlar mavjud o'chirishdan oldin ushbu guruhdagi studentlarni o'chirish yoki boshqa guruhga biriktirish lozim!",'warning',7);
            // there should be redirect to groups list with this status, it will be done later
        }
        else
        {
            $group->delete();
            message_set("'$group->name' guruhi o'chirib yuborildi!",'success',3);
        }
        return redirect()->back();
    }
}
