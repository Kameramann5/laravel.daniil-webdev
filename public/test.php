<?php

//exec('cd ..', $output, $return_var);
exec('php artisan storage:link', $output, $return_var);

// Вывод результата
echo "Returned with status $return_var and output:\n";
print_r($output);