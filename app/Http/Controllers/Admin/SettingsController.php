<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
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
            'key'=>'required|unique:settings',
            'value' => 'required',
        ]);
        setting([$data['key'] => $data['value']]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Settings::findOrFail($id);
        return view('admin.settings.edit',compact(['data']));
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
        $data = $this->validate($request,[
            'key'=>'required',
            'value' => 'required',
        ]);
        $data = Settings::findOrFail($id);
        $data->key = $data['key'];
        $data->value = $data['value'];

        if($data->save()){
            session()->flash('success','删除成功');
        }else{
            session()->flash('danger','删除失败');
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
