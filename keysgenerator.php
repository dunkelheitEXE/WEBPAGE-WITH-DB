<?php 
$character_list = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+');
$counted = count($character_list);
$new_key = [];
for ($i = 0; $i < 200; $i++) {
    array_push($new_key, $character_list[rand(0,$counted-1)]);
    echo $new_key[$i];
}
?>