<?php

use App\Models\donate_schedual;

if(!function_exists("operation_fun")){
    function operation_fun($operation,$value){
        $amount = donate_schedual::all()->sum("amount");
        if($operation == "+"){
            $amount = $amount + $value;
        }else{
            $amount = $amount - $value;
        }
    }
}
