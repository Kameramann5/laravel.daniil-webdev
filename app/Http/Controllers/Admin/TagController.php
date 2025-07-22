<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::paginate(2);
        //dd($categories);
        return view('admin.tags.index',compact ('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(__METHOD__);
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ([
            'title'=>'required',
        ]);
        Tag::create($request->all());
        return redirect ()->route('admin.tags.index')->with ('success','Тег добавлен');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag=Tag::find($id);
        return view('admin.tags.edit',compact ('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate ([
            'title'=>'required',
        ]);

        $tag=Tag::find($id);

        $tag->slug=null;
        $tag->update($request->all());
        return redirect ()->route('admin.tags.index')->with ('success','Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag=Tag::find($id);
        if($tag->posts->count()) {
            return redirect()->route('admin.tags.index')->with('error','Ошибка, у тегов есть записи, удалите, либо перенести их в другие теги');
        }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with ('success','Удалено');
        //Tag::destroy ($id);

       // return redirect ()->route('admin.tags.index')->with ('success','Удалено');


    }
}
