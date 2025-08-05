<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;


use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class SkillController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view_admins|add_admins', ['only' => ['index','store']]);
    //     $this->middleware('permission:add_admins', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit_admins', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete_admins', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        return view('admin.skills.index');
    }

    public function datatable(Request $request)
    {
        $items = Skill::query()->orderBy('id', 'DESC')->search($request);
        return $this->filterDataTable($items, $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        try {
            DB::beginTransaction();
                $skill = Skill::create($data);
            DB::commit();

            return $this->response_api(200 , __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['skill'] = Skill::findOrFail($id);
        return view('admin.skills.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $data = $request->all();
        $skill = Skill::findOrFail($id);
            try {
                DB::beginTransaction();
                $skill->update($data);
                DB::commit();

                return $this->response_api(200, __('admin.form.updated_successfully'), '');
            } catch (\Exception $e) {
                DB::rollback();
                return $this->response_api(400, $this->exMessage($e));
            }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Skill::destroy($id);
        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
    }



}

