<?php


if (!function_exists('admin_route')) {

    function admin_route($name, $parameters = [], $absolute = true)

    {

        // Если маршрут уже начинается с admin., не добавляем префикс

        if (strpos($name, 'admin.') === 0) {

            return route($name, $parameters, $absolute);

        }

        

        // Добавляем префикс admin.

        return route('admin.' . $name, $parameters, $absolute);

    }

}

