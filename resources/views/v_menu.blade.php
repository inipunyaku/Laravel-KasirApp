@extends('layout.v_template')
@section('title','Home')
@section('content')

<div class="container">
    <div class="row">
        @foreach ($menu as $data)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="card" style="max-width: 16rem">
                    <img
                        class="card-img-top"
                        src="{{ url('FOTO_MENU/'.$data->FOTO_MENU) }}"
                        alt="Card image cap"
                    />
                    <div class="card-body">
                      {{-- <form method="POST" action="/menu/insertcart/{{ $data ->ID_MENU }}"> --}}
                        {{-- <input type="hidden" name="nama" value="{{ $data->NAMA_MENU }}"> --}}
                        <h5 class="card-title">{{ $data -> NAMA_MENU }}</h5>
                        <p class="card-text">stock : {{ $data->STOK }}</p>
                        <P class="card-text">Rp. {{ $data->HARGA }}</P>
                        {{-- <input type="hidden" name="harga" value="{{ $data->HARGA }}"> --}}
                        <form action="/menu/insertcart" method="POST" enctype="multipart/form-data">

                        <input type="text" name="quantity" value="0" class="form-control" />
                        @csrf  
                        {!! Form::hidden('id', $data->ID_MENU) !!}
                        {{-- <a href="/menu/insertcart/{{ $data ->ID_MENU }}-" class="btn btn-success">add</a> --}}
                        <button type="submit" class="btn btn-success">Tambah</button>
                        {{-- <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" /> --}}
                      </form>
                    </div>
                    </div>
                </div>
                
        @endforeach
    </div>
</div>


@endsection