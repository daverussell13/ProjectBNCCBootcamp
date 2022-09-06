@extends('layouts.user')

@section('content')
  <div class="container my-4">
    <div class="invoice p-3 mb-3">
      <!-- title row -->
      <div class="row mb-2">
        <div class="col-12">
          <h4>
            <i class="fas fa-globe"></i> PT Makmur Jaya
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info mb-3">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{ $user->name }}</strong><br>
            Phone: {{ $user->phone }}<br>
            Email: {{ $user->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <div class="mb-2">
            <b>Address :</b>
            <textarea name="" id="" cols="20" class="d-block" style="height: 60px"></textarea>
          </div>
          <div>
            <b>Postal Code :</b>
            <input type="text" style="height: 20px; width: 100px;">
          </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Qty</th>
                <th>Name</th>
                <th>Category</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>
                    <input type="number" style="width: 50px" value="{{ $product->quantity }}" min="1"
                      max="{{ $product->quantity }}">
                  </td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->category->name }}</td>
                  <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row mb-2">
        <div class="col-6"></div>
        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <th style="width:50%">Total:</th>
                  <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Simpan Faktur
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection
