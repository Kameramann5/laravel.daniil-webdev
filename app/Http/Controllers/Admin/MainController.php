<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {

     //проверить работу добавления слага
$tag=new Tag();
$tag->title = 'привет';
$tag->save();

return view ('admin.index');
    }
}
