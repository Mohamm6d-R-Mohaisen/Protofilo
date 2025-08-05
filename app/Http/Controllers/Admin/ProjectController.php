<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\SaveImageTrait;
use App\Traits\HasImages;

class ProjectController extends Controller
{
    use SaveImageTrait,HasImages;

    // public function __construct()
    // {
    //     $this->middleware('permission:view_abouts|add_abouts', ['only' => ['index','store']]);
    //     $this->middleware('permission:add_abouts', ['only' => ['create','store']]);
    //     $this->middleware('permission:edit_abouts', ['only' => ['edit','update']]);
    //     $this->middleware('permission:delete_abouts', ['only' => ['destroy']]);
    // }

    public function index()
    {
        return view('admin.projects.index');
    }

    public function datatable(Request $request)
    {
        $items = Project::query()->orderBy('id', 'DESC');
        return $this->filterDataTable($items, $request);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }
public function show($id)
{

}
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $project = Project::create($request->except('media_repeater','images'));

            // حفظ الصور
            if ($request->hasFile('images')) {
                $this->storeModelImages($project, $request->file('images'));
            }

            DB::commit();

            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->response_api(400, $this->exMessage($e));
        }
    }


    public function edit($id)
    {
        $project = Project::with('images')->findOrFail($id);
        $categories = Category::all();
        return view('admin.projects.create', compact('project', 'categories'));
    }


    public function update(Request $request, $id)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();

            $project = Project::findOrFail($id);
            $project->update($request->except([ 'images', 'id','current_image']));


            $this->updateModelImages(
                $project,
                $request->images ?? [],
                $request->id ?? [],
                $request->images_current ?? []
            );
            DB::commit();

            return $this->response_api(200, __('admin.form.updated_successfully'), '');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response_api(400, $this->exMessage($e));
        }
    }

    public function destroy($id)
    {
//        Project::destroy($id);
//         return $this->response_api(200, __('admin.form.deleted_successfully'), '');
//



        try {
            DB::beginTransaction();
            $project=Project::findorfail($id);
            if($project->images->count() > 0){
                foreach ($project->images as $image){
                    $this->deleteImage($image->image);
                }
            }

            Project::destroy($id);
            return $this->response_api(200, __('admin.form.deleted_successfully'), '');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->response_api(400, $this->exMessage($e));
        }
    }
}
