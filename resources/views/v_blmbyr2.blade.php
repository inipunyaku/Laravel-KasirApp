@extends('layout.v_template')
@section('title','Bayar transaksi')
@section('content')
<div class="container">
    <table class="table">
        <tr>
            <th>
                Id pesanan
            </th>
            <th>
                Antrian
            </th>
            <th>
                Waktu pemesanan
            </th>
            <th>
                Nama Pemesan
            </th>
            <th>
                Total Harga
            </th>
        </tr>
        <tbody>
            @foreach ($pesan as $data)
            <tr>
                <td>
                    {{ $data->ID_PESANAN }}
                </td>
                <td>
                    {{ $data->no_urut }}
                </td>
                <td>
                    {{ $data->WAKTU_PEMESANAN }}
                </td>
                <td>{{ $data->NAMA_PEMESAN }}</td>
                <td>
                    @php
                        $id=$data->ID_PESANAN;
                        $totalharga=$data->TOTAL_HARGA;
                    @endphp
                    {{ $data->TOTAL_HARGA }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="detail mt-5">
        <h3 class="mt-3 mb-3">Detai Transaksi</h3>

        <table  class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Menu</th>
                    <th scope="col">Harga satuan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Jumlah</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($detail['ambil'] as $item)
            <tr>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->NAMA_MENU }}</td>
                    <td>{{ $item->HARGA_MENU }}</td>
                    <td>{{ $item->QUANTITY }}</td>
                    @php
                        $h=$item->HARGA_MENU;
                        $j=$item->QUANTITY;
                        $hj=$h*$j;
                    @endphp
                    <td>{{ $hj }}</td>
                </tr>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="bayar mt-4">
        <table margin="10px">
            <form id="formbeli" name="formbeli" action="/transaksi/bayar" method="POST">
            @csrf
             {!! Form::hidden('id', $id) !!}
            <tr>
                <td>Total Harga</td>
                <td> : </td>
                <td>{{ $totalharga }}</td>
            </tr>
            <tr>
                <td>Jumlah Bayar</td>
                <td> : </td>
                <td><input type="number" name="bayar" id="bayar" placeholder="Masukan Jumlah Bayar" onkeyup="OnChange(this.value)" required> <button type="submit" class="btn btn-success">Bayar</button></td>
            </tr>   
            <tr>
                <td>Kembali</td>
                <td> : </td>
                <td><input type="number" name="kembali" id="kembali" readonly> </td>
            </tr>
            </form>
        </table>
    </div>
</div>
<script>
    jumlahbayar= document.formbeli.bayar.value;
    function OnChange(value){
        jumlahbayar= document.formbeli.bayar.value;
        kembali = jumlahbayar-{{ $totalharga }};
        document.formbeli.kembali.value = kembali;
    }
</script>
@endsection