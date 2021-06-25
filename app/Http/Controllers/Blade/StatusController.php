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
        abort_if_forbidden('status.view');
        $statuses = Status::all();
        return view('pages.status.index',compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if_forbidden('status.add');
        return view("pages.status.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        abort_if_forbidden('status.add');
        $this->validate($request,[
            'name' => 'required|unique:statuses'
        ]);
        $status = Status::create([
            'name' => $request->name
        ]);
        message_set("Yangi '$status->name' statusi muvaffaqiyatli qo'shildi!",'success',3);
        return redirect()->route('statusIndex');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     */
    public function edit($id)
    {
        abort_if_forbidden('status.edit');
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
       abort_if_forbidden('status.edit');
       $request->validate([
           'name' => 'required|unique:statuses,name,'.$id
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
        abort_if_forbidden('status.delete');
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
