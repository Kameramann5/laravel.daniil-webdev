<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class StorageController extends Controller
{
    public function createLink()
    {
        Artisan::call('storage:link');
        $output = Artisan::output();
        return response()->json(['message' => 'Symbolic link created!', 'output' => $output]);
    }
}
