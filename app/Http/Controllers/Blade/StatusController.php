<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('pages.status.index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.status.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $status = Status::create([
            'name' => $request->name
        ]);
        message_set("Yangi '$status->name' statusi muvaffaqiyatli qo'shildi!",'success',3);
        return redirect()->route('statusIndex');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $status = Status::findOrFail($id);
        return view('pages.status.edit',compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('pages.status.edit',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
       $request->validate([
           'name' => 'required'
       ]);

        $status = Status::findOrFail($id);

        $status->fill([
            'name' => $request->name
        ]);
        $status->save();

        return redirect()->route('statusIndex');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $count = $status->students()->count();
        if ($count)
        {
            message_set("Ushbu statusda studentlar mavjud o'chirishdan oldin ushbu statusni studentlardan butunlay tozalash lozim!",'warning',7);
            // there should be redirect to student list with this status, it will be done later
        }
        else
        {
            $status->delete();
            message_set("'$status->name' statusi o'chirib yuborildi!",'success',3);
        }
        return redirect()->back();
    }
}
