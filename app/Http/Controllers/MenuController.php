<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\TransaksiModel;

class MenuController extends Controller
{
     public function __construct()
    {
        $this->MenuModel = new MenuModel();
    }
    
    public function index() {
    $data = [
        'menu' =>$this->MenuModel->allData(),
    ];
        return view('v_menu', $data);
    }
    
}
