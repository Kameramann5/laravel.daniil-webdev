<?php

$target = storage_path('app/public');
$link = public_path('storage');

if (file_exists($link)) {
    echo "Ссылка уже существует.";
} else {
    if (symlink($target, $link)) {
        echo "Символическая ссылка успешно создана.";
    } else {
        echo "Не удалось создать символическую ссылку.";
    }
}