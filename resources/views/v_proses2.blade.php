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
            <tr>
                <td colspan="5" align="right"><a href="/transaksi/selasai/{{ $id}}" type="button" class="btn btn-success">SELESAI</a> </td>
            </tr>
        </tbody>
    </table>

@endsection