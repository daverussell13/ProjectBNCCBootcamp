@extends('layouts.user')

@section('content')
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        @foreach ($products as $product)
          <div class="col-md-4 mb-5">
            <div class="card box-shadow">
              <img class="card-img-top" src="{{ asset('storage/' . $product->picture) }}" alt="pic">
              <div class="card-body">
                <p class="text-muted">{{ $product->category->name }}</p>
                <div class="card-text mb-2 px-2">
                  <div>Nama barang : {{ $product->name }}</div>
                  <div>Harga : Rp. {{ number_format($product->price, 2, ',', '.') }}</div>
                  <div>Quantity : {{ $product->quantity }}</div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary">
                      <i class="fa-solid fa-plus fa-xs"></i>
                      Faktur
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/') }}js/user/faktur.js"></script>
@endsection
