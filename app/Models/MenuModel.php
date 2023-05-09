<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuModel extends Model
{
    public function allData()
    {
      return DB::table('menu')->get();
    }

    public function detail_menu($ID_MENU){
      return DB::table('menu')->where('ID_MENU',$ID_MENU);
    }

}
