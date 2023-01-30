<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UtilController extends Controller
{

    public function levelCheck($level = 0)
    {
        if($level < 1){
            die('Você não tem permissão!');
        }
    }

    public function showOrder()
    {
        return ['title' => 'Title', 'release' => 'Release', 'id' => 'ID'];
    }

    public function showLayout()
    {
        return ['list' => 'List', 'gallery' => 'Gallery'];
    }

    public function arrayToSelect(array $data, $_indice = '', $_value = '')
    {
        $_indice = !empty($_indice) ? $_indice : 'id';
        $_value  = !empty($_value ) ? $_value  : 'title';
        $select  = [];

        foreach($data as $value):
            $select[$value->$_indice] = $value->$_value;
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

    public function convertVisibility($v) {
        switch ($v) {
          case "public": return "+";
          case "private": return "-";
          case "protected": return "#";
          case "package": return "~";
          default: return $v;
        }
      }
}
