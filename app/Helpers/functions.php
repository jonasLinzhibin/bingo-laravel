<?php

function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8').'...';
    return $text;
}

/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    if(empty($bytes)) return 0;
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}


/*
* 递归调用数据
*/
function setChild($data,$pid=0,$sort = 'SORT_ASC',$sort_column = '')
{
    $arr = [];
    if (empty($data)) {
        return [];
    }

    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $pid) {
            $arr[$key] = $value;
            $arr[$key]['child'] = setChild($data,$value['id']);
        }
    }

    if($sort_column != ''){
        foreach ($arr as $key => &$val) {
            if ($val['child']) {
                $temp = array_column($val['child'], $sort_column);
                array_multisort($temp,$sort,$val['child']);
            }
        }
    }

    return $arr;
}

