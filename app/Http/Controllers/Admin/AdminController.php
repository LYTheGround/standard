<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(AdminRequest $request,Admin $admin)
    {
        $this->authorize('owner', $admin);

        return redirect()->route('admin.show',['admin' => $admin->onStore($request)]);
    }

    public function show(Admin $admin)
    {
        return view('admin.show',compact('admin'));
    }

    public function params()
    {
        return view('admin.edit');
    }

    public function updateParams(AdminRequest $request, Admin $admin)
    {
        return redirect()->route('admin.show',['admin' => $admin->onUpdate($request)]);
    }

    public function destroy(Admin $admin)
    {
        $this->authorize('owner',Admin::class);

        if($admin->type != 'A'){
            return $admin->onDelete();
        }

        session()->flash('danger', __('admin/admin.owner'));

        return back();
    }
}
