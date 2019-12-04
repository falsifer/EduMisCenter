<?php
function get_view_path($view_name)
{
    $target_file=APPPATH.'views/'.$view_name.'.php';
    if(file_exists($target_file)) return $target_file;
}