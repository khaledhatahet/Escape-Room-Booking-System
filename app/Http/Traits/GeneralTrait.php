<?php

namespace App\Http\Traits;

trait GeneralTrait{

    public function returnError($msg)
    {
        return response()->json([
            'status' => false,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "")
    {
        return [
            'status' => true,
            'msg' => $msg
        ];
    }

    public function returnData($value, $key="data" , $msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value
        ]);
    }

}
?>
