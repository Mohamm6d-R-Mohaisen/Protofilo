<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AdminNotification;
use App\Models\About;
use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Slider;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\UserMessages;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index(){
        $data['slider']=Slider::latest()->first();
        $data['about']=About::latest()->first();
        $data['skills']=Skill::all();
        $data['categories']=Category::with('projects.images')->get();
        $data['services']=Service::all();
        $data['testimonials']=Testimonial::all();

        return view('frontend.home.index',$data);
    }
    public function project_details($id){
       $project= Project::with('images','category')->findorfail($id);

       return view('frontend.home.project_details',compact('project'));


    }
    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject'=> [ 'string'],
            'message' => ['required', 'string'],
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter a valid email address',
            'message.required' => 'Please enter your message'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            $data= $request->only(['name', 'subject', 'email', 'message']);
            $message = UserMessages::create($data);

            $email = Setting::where('key', 'email')->first()->value;
            Mail::to($email)->send(new AdminNotification($message, 'contact'));

            return $this->response_api(200, __('admin.form.added_successfully'), '');
        } catch (\Exception $e) {
            return $this->response_api(400, $this->exMessage($e));
        }
    }

}
