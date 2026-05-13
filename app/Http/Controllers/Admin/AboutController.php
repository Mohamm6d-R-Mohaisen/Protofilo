<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\SaveImageTrait;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
    use SaveImageTrait;



    public function index()
    {
        return view('admin.abouts.index');
    }
  public function datatable(Request $request)
    {
        $query = About::select('id', 'name', 'position', 'title' )
            ->orderByDesc('id');

        return DataTables::of($query)

// ✅ عمود العمليات
            ->addColumn('operations', function($row){
                return view('components.table-action', [
                    'resource' => 'abouts',
                    'id' => $row->id
                ])->render();
            })
            ->rawColumns([ 'operations'])
            ->make(true);
    }
    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
             DB::beginTransaction();
            $about = About::first();

            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'),'abouts');
            }
            if ($about) {
                $about->update($data);
            } else {
                $about = About::create($data);
            }





            DB::commit();
            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }
    }


    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.abouts.create', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            if ($request->input('remove_image') == '1') {
                if ($about->image) {
                    $this->deleteImage($about->image);
                    $data['image'] = null; // اجعل الحقل فارغًا
                }
            }

                if ($request->hasFile('image')) {
                    if ($about->image) {
                        $this->deleteImage($about->image);
                    }
                    $data['image'] = $this->saveImage($request->file('image'), 'abouts');

                }

                $about->update($data);

                DB::commit();
                return $this->response_api(200, __('admin.form.updated_successfully'), '');
            }
        catch(\Exception $e) {
                DB::rollback();
                return $this->response_api(400, $this->exMessage($e));
            }

    }


    public function destroy($id)
    {
//        About::destroy($id);
//        return $this->response_api(200, __('admin.form.deleted_successfully'), '');
        $about=About::findorfail($id);
        try {
            DB::beginTransaction();
            $about->delete();
            $this->deleteImage($about->image);
            DB::commit();
            return $this->response_api(200, __('admin.form.deleted_successfully'), '');

        }catch (\Exception $e) {
            DB::rollback();
            return $this->response_api(400, $this->exMessage($e));
        }

    }
}
