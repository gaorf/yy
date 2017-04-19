<?php
/**
 * 数字映射
 * @param array $data
 * @return array
 */
function int_to_string(&$data,array $map){
    if($data === false || $data === null ){
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key=>$row){
        foreach ($map as $col=>$pair){
            if(isset($row[$col]) && isset($pair[$row[$col]])){
                $data[$key][$col] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

function get_switch($data){
    if(isset($data)){
        return 1;
    }else{
        return -1;
    }
}