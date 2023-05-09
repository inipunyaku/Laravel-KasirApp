@extends('layout.v_template')
@section('title','Home')
@section('content')
   @if (empty($cart) || count($cart) ==0 ){
       tidak ada produk
   }
       
   @else
       <table>
           <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Harga</th>
               <th>jumlah</th>
               <th>Subtotal</th>
               <th>action</th>
           </tr>
           @php
               $no=1;
                $total= 0;
           @endphp
           <tr>
            @foreach ($cart as $ct =>$data)
            @php
                $subtotal = $data["harga"]* $data["jumlah"];
            @endphp
                <tr>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $data ["nama_menu"] }}
                    </td>
                    <td>
                        Rp. {{ $data["harga"] }}
                    </td>
                    <td>
                        {{ $data ["jumlah"] }}
                    </td>
                    <td>Rp. {{ $subtotal }}</td>
                    <td><a href="{{ url('/cart/hapus/'.$ct) }}" class="btn btn-danger">hapus</a></td>
                </tr>
                @php
                    $total += $subtotal;
                @endphp
            @endforeach
           </tr>
           <tr>
               <td colspan="4">TOTAL</td>
               <td>Rp. {{ $total }}</td>
           </tr>
           <tr>
            <form action="/transaksi/tambah" method="POST" enctype="multipart/form-data">
               @csrf
                <td colspan="2">
                   Nama Pemesan
               </td>
               <td colspan="4">
                   <input type="text" name="nama" id="nama" placeholder="Masukan Nama" required>
               </td>
           </tr>
            <tr>
               <td colspan="2">
                   Email Pemesan
               </td>
               <td colspan="4">
                   <input type="email" name="mail" id="mail" placeholder="Masukan Email" required>
               </td>
           </tr>
           <tr align="right">
               <td colspan="6">
                   <button class="btn btn-success">beli</button>
                </form>
               </td>
           </tr>
       </table>
   @endif
@endsection