@extends('layouts.user')

@section('meta')
  <!-- Sweet alert -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection

@section('content')
  @csrf
  <div class="album py-5 bg-light">
    @if (!count($products))
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">No Products Available</h1>
        </div>
      </section>
    @else
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
                      <button type="button" class="btn btn-primary faktur-btn" data-product="{{ $product->id }}"
                        data-user="{{ $user->id }}">
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
    @endif
  </div>
@endsection

@section('scripts')
  <!-- Sweet alert -->
  <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="{{ asset('/') }}js/user/send_data.js"></script>
@endsection
