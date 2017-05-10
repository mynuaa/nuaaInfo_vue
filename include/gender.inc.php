<?php

function genderProcess (&$value){
    if($value['gender'] == 1){
        $value['nickname'] = '某男生';
        $value['avatar'] = '/bottle/static/avatar/boy' . ($value['id'] % 6 + 1 ) . '.gif';
    }else{
        $value['nickname'] = '某女生';
        $value['avatar'] = '/bottle/static/avatar/girl' . ($value['id'] % 6 + 1 ) . '.gif';
    }
    unset($value['userId']);
}
