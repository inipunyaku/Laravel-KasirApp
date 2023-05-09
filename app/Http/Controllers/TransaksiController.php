<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
        $this->TransaksiModel = new TransaksiModel();
    }
    public function insertcart(){
        $id = request()->id;
        $jumlah = request()->quantity;
        $data  = $this->MenuModel->detail_menu($id)->first();
        $cart = session("cart");
        $cart[$id] = [
           "nama_menu" => $data ->NAMA_MENU,
           "harga" => $data ->HARGA,
           "jumlah" => $jumlah
       ];

       session(["cart" => $cart]);
       return redirect("/cart");

    }
    function cart(){
        $cart = session ("cart");
        return view("v_cart")->with("cart",$cart);
    }
    function hapuscart($ID_MENU){
        $cart = session("cart");
        unset($cart[$ID_MENU]);
        session(["cart" => $cart]);
         return redirect("/cart");

    }

    function tambahtransaksi(){
        $cart = session("cart");
        $totalharga=0;
        foreach($cart as $ct => $val){
            $totalharga = $totalharga+ ($val["harga"]* $val["jumlah"]);
        }
        $today= Carbon::now()->isoFormat('YMDD');
        $lastorder =$this->TransaksiModel->tglini()->first();

        if($lastorder == null){
            $intUrut = 1;
            $id_pesanan=$today.'-'.$intUrut;
        }
        else{
            $strUrut = substr( $lastorder->ID_PESANAN, 9);
            $intUrut = (int)$strUrut;
            $id_pesanan=$today.'-'.$intUrut+1;
        }

        $namapemesan = request()->nama;
        $emailpemesan = request()->mail;

  
        $data=[
            'NAMA_PEMESAN' => $namapemesan,
            'ID_PESANAN' => $id_pesanan,
            'no_urut' => $intUrut,
            'EMAIL_PEMESAN'=> $emailpemesan,
            'WAKTU_SELESAI' =>NULL,
            'TOTAL_HARGA' => $totalharga,
            'STATUS_PESANAN' => "BELUM BAYAR"
        ];
        $returnid=[
            'id' => $id_pesanan
        ];
        $this->TransaksiModel->tambahtransaksi($data);
        return redirect()->route('tambahdetail', $returnid);
    }
    function tambah_detail(){
        $cart = session("cart");
        $id_pesanan = request()->id;
        foreach($cart as $ct => $val){
            $ID_MENU=$ct;
            $ambil  = $this->MenuModel->detail_menu($ID_MENU)->first();
            $quantity=$val['jumlah'];
            $data=[
                'ID_PESANAN' => $id_pesanan,
                'ID_MENU' => $ID_MENU,
                'QUANTITY' => $quantity,
                'NAMA_MENU' => $ambil->NAMA_MENU,
                'HARGA_MENU' => $ambil->HARGA
            ];
        $this->TransaksiModel->tambahdetail($data);
        }
    return 'pesanan berhasil dibuat';
    }


    function belumbayar(){
    $data = ['ambil'=> $this->TransaksiModel->belumbayar()];
        return view('v_blmbyr',$data);
    
    }
    function belumbayar2($id){
        $data = collect($this->TransaksiModel->belumbayar());
        $data1= $data->where('ID_PESANAN',$id);
        $data2 = [
            'ambil' =>$this->TransaksiModel->belumbayar3($id),
            ];
        // return dd($data2);
        return view('v_blmbyr2',[
            'pesan' =>$data1,
            'detail'=>$data2

        ]);
    
    }
    function bayar(){
        $id = request()->id;
        $data = [
            'STATUS_PESANAN' =>'DIPROSES',
            'TOTALBAYAR' => request()->bayar,
            'KEMBALI' => request()->kembali,
        ];

        $this->TransaksiModel->updatedata($id,$data);
        return redirect()->route('menu');
    }

    function proses(){
    $data = ['ambil'=> $this->TransaksiModel->proses()];
        return view('v_proses',$data);
    
    }
    function proses2($id){
        $data = collect($this->TransaksiModel->proses());
        $data1= $data->where('ID_PESANAN',$id);
        $data2 = [
            'ambil' =>$this->TransaksiModel->belumbayar3($id),
            ];
        // return dd($data2);
        return view('v_blmbyr2',[
            'pesan' =>$data1,
            'detail'=>$data2

        ]);
    
    }

    

    function selesai(){
        $id = request()->id;
        $data = [
            'STATUS_PESANAN' =>'SELESAI',
        ];

        $this->TransaksiModel->updatedata($id,$data);
        return redirect()->route('menu');
    }

    function sendEmail(){
        $data = [
        'ambil' =>$this->TransaksiModel->ambilterakhir(),
         ];
    

        $dataMail =[
            'title' => 'Struk Online CafeKu',
            'id_pesanan' => $data['ambil']->ID_PESANAN,
            'nama_pemesan' => $data['ambil']->NAMA_PEMESAN,
            'email_pemesan' => $data['ambil']->EMAIL_PEMESAN,
            'total_harga' => $data['ambil']->TOTAL_HARGA,
            'waktu_pemesanan' => $data['ambil']->WAKTU_PEMESANAN,
        ];
        $datadetail= [
            'ambil'=> $this->TransaksiModel->ambilid(),
        ];

        return 
        Mail::to('unlimitedgems123@gmail.com')->send(new SendEmail($dataMail, $datadetail));
        return"send email berhasiL";

    }

}