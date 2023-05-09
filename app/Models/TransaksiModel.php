<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class TransaksiModel extends Model
{
    protected $id;
    public function tambahtransaksi($data){
        DB::table('pesanan')->insert($data);
    }
    public function tambahdetail($data){
        DB::table('detail_pesanan')->insert($data);
    }
    public function ambilterakhir(){
        $id=DB::table('pesanan')->orderBy('ID_PESANAN','desc')->first();
        $this->id=$id->ID_PESANAN;
        return DB::table('pesanan')->orderBy('ID_PESANAN','desc')->first();
    }
    public function ambilid(){
        return DB::table('detail_pesanan')->where('ID_PESANAN',$this->id)->get();
    }
    public function tglini(){
        $tgl = Carbon::now()->isoFormat('YMDD');
        return  DB::table('pesanan')->where('ID_PESANAN','like',$tgl.'%')->get();
        
    }

    public function belumbayar(){
        return  DB::table('pesanan')->where('STATUS_PESANAN','=','BELUM BAYAR')->orderBy('ID_PESANAN','desc')->get();
    }

    public function belumbayar2($id){
        return DB::table('pesanan')->where('ID_PESANAN','=',$id)->first();
    }
    public function belumbayar3($id){
         return DB::table('detail_pesanan')->where('ID_PESANAN','=',$id)->get();

    }
    public function updatedata($id,$data){
        DB::table('pesanan')->where('ID_PESANAN', $id)->update(($data));

    }
    public function proses(){
        return  DB::table('pesanan')->where('STATUS_PESANAN','=','DIPROSES')->orderBy('ID_PESANAN','desc')->get();
    }
    
}
