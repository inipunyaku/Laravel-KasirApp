@extends('layout.v_template')
@section('title','Home')
@section('content')
<div class="container">
    <table>
        <tr>
            <td>
                No
            </td>
            <td>
                Id pesanan
            </td>
            <td>
                Antrian
            </td>
            <td>
                Waktu pemesanan
            </td>
            <td>
                Nama Pemesan
            </td>
            <td>
                Total Harga
            </td>
            <td>
                action
            </td>
        </tr>
        
        @foreach ($ambil as $a)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $a->ID_PESANAN }}
                </td>
                <td>
                    {{ $a->no_urut }}
                </td>
                <td>
                    {{ $a->WAKTU_PEMESANAN }}
                </td>
                <td>{{ $a->NAMA_PEMESAN }}</td>
                <td>
                    {{ $a->TOTAL_HARGA }}
                </td>
                <td>
                    <a href="/transaksi/proses2/{{ $a->ID_PESANAN }}" type="button" class="btn btn-success">SELESAI</a>    
                </td>
            </tr>
        @endforeach
        
    </table>
      <!-- /.modal -->
</div>
@endsection