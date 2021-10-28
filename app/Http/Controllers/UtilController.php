<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function arrayToSelect(array $data)
    {
        $select = [];
        foreach($data as $value):
            $select[$value->id] = $value->title;
        endforeach;

        return $select;
    }

    public function ledgerGroupToArray(array $data)
    {
        $arr = [];
        foreach($data as $value):
            $arr[$value->id] = [
                'ledger_group_id' => $value->ledger_group_id,
                'title' => $value->title,
            ];
        endforeach;

        return $arr;
    }

    public function transitionTypeToArray(array $data)
    {
        $arr = [];
        foreach($data as $value):
            $arr[$value->id] = [
                'title' => $value->title,
                'description' => $value->description,
                'action' => $value->action,
            ];
        endforeach;

        return $arr;
    }
}
