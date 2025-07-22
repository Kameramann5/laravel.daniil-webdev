<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;


class AdminController extends Controller

{

    protected function redirectRoute($route, $parameters = [], $with = [])

    {

        if (!str_starts_with($route, 'admin.')) {

            $route = 'admin.' . $route;

        }

        

        $redirect = redirect()->route($route, $parameters);

        

        foreach ($with as $key => $value) {

            $redirect->with($key, $value);

        }

        

        return $redirect;

    }

}
