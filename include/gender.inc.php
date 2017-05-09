<?php

function genderProcess (&$value){
    if($value['gender'] == 1){
        $value['nickname'] = '某男生';
        $value['avatar'] = '/bottle/avatar/boy' . ($value['id'] % 6 + 1 ) . '.jpg';
    }else{
        $value['nickname'] = '某女生';
        $value['avatar'] = '/bottle/avatar/girl' . ($value['id'] % 6 + 1 ) . '.jpg';
    }
    $value['userId'] = '0';
}
