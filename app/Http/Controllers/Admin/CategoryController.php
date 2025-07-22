<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::paginate(2);
        //dd($categories);
        return view('admin.categories.index',compact ('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(__METHOD__);
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ([
            'title'=>'required',
        ]);
        Category::create($request->all());
        //$request->session ()->flash('success','Категория добавлена');
        return redirect ()->route('admin.categories.index')->with ('success','Категория добавлена');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);
        return view('admin.categories.edit',compact ('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate ([
            'title'=>'required',
        ]);

        $category=Category::find($id);

        $category->slug=null;
        $category->update($request->all());
        return redirect ()->route('admin.categories.index')->with ('success','Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // dd(__METHOD__);
     //   $category=Category::find($id);
     //   $category=delete();
//Category::destroy ($id);
        $category=Category::find($id);
if($category->posts->count()) {
    return redirect()->route('admin.categories.index')->with('error','Ошибка, у категории есть записи, удалите, либо перенести их в другую категорию');
}
        $category->delete();
        return redirect ()->route('admin.categories.index')->with ('success','Удалено');


    }
}
