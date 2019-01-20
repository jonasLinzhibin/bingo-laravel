<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Settings::paginate(10);
        return view('admin.settings.index', compact(['items']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Kris\LaravelFormBuilder\FormBuilder  $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create('App\Forms\GeneralForm', [
            'method' => 'POST',
            'url' => route('config.store'),
            'role=' => 'form',
        ], ['form_type' => 'setting']);

        return view('admin.settings.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'group'=>'required',
            'key'=>'required|unique:settings',
            'value' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        Settings::create($data);
        \Setting::get($data['key'], $data['value']);
        session()->flash('success','添加成功');
        return redirect()->route('config.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Kris\LaravelFormBuilder\FormBuilder  $formBuilder
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FormBuilder $formBuilder)
    {
        $setting = Settings::findOrFail($id);

        $form = $formBuilder->create('App\Forms\GeneralForm', [
            'method' => 'POST',
            'url' => route('config.update',$setting),
            'model' => $setting,
        ], ['form_type'=>'setting', 'method_field'=>'PUT']);

        return view('admin.settings.edit',compact(['setting','form']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $this->validate($request,[
            'group'=>'required',
            'key'=>'required',
            'value' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $data = Settings::findOrFail($id);
        if($data->key != $input['key']){
            \Setting::forget($input['key']);
        }
        $data->group = $input['group'];
        $data->key = $input['key'];
        $data->value = $input['value'];
        $data->description = $input['description'];
        $data->status = $input['status'];

        if($data->save()){
            session()->flash('success','修改成功');
        }else{
            session()->flash('danger','修改失败');
        } 

        return redirect()->route('config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Settings::findOrFail($id);
        setting()->forget($setting->key);
        if($setting->delete()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
        }
        return redirect()->route('config.index');
    }
}
