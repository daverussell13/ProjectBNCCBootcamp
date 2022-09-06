@extends('layouts.user')

@section('content')
  <form action="/user/faktur" method="POST" id="store-faktur-form">
    @csrf
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
        <div class="row invoice-info mb-4">
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
              <textarea name="receiver_address" id="" cols="20" class="d-block" style="height: 60px"
                form="store-faktur-form"></textarea>
            </div>
            <div>
              <b>Postal Code :</b>
              <input type="text" style="height: 20px; width: 100px;" name="receiver_postal_code">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #{{ $invoice }}</b><br>
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
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; ?>
                @foreach ($products as $product)
                  <tr>
                    <input type="hidden" value="{{ $product->id }}" name="products[{{ $i }}][product_id]">
                    <td>
                      <input type="number" style="width: 50px" value="{{ $product->quantity }}" min="1"
                        max="{{ $product->quantity }}" name="products[{{ $i }}][new_qty]">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    {{-- <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td> --}}
                  </tr>
                  <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Simpan Faktur
            </button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" value="{{ $user->id }}" name="user_id">
    <input type="hidden" value="{{ $total }}" name="total">
    <input type="hidden" value="{{ $invoice }}" name="invoice">
  </form>
@endsection

@section('scripts')
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
    });
  </script>
  @if (Session::get('Success'))
    <script>
      Toast.fire({
        icon: "success",
        title: "Faktur has been successfully added",
      });
    </script>
  @elseif (Session::get('Error'))
    <script>
      Toast.fire({
        icon: "error",
        title: "Error occured cant save faktur",
      });
    </script>
  @endif
@endsection
