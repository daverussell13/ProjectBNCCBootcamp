@extends('layouts.user')

@section('content')
  <div class="container my-4">
    <div class="invoice p-3 mb-3">

      <div class="row mb-2">
        <div class="col-12">
          <h4>
            <i class="fas fa-globe"></i> PT Makmur Jaya
          </h4>
        </div>
      </div>

      <form action="/user/faktur" method="POST" id="store-faktur-form">
        @csrf

        <div class="row invoice-info mb-4">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>{{ $user->name }}</strong><br>
              Phone: {{ $user->phone }}<br>
              Email: {{ $user->email }}
            </address>
          </div>

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
                      <input type="number" style="width: 50px" value="1" min="1"
                        max="{{ $product->quantity }}" name="products[{{ $i }}][new_qty]">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                  </tr>
                  <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>

        <input type="hidden" value="{{ $user->id }}" name="user_id">
        <input type="hidden" value="{{ $invoice }}" name="invoice">
      </form>

      <div class="row no-print">
        <div class="col-12">
          <button type="button" class="btn btn-success float-right" onclick="submitFakturForm(event);"><i
              class="far fa-credit-card"></i> Simpan Faktur
          </button>
          <form action="{{ route('user.faktur.reset') }}" method="POST" class="d-none" id="reset-form">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{ $user->id }}" name="user_id">
          </form>
          <button type="button" class="btn btn-secondary float-right" style="margin-right: 5px;"
            onclick="resetFormSubmit(event);">
            Reset
          </button>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('/') }}js/user/submit_handler.js"></script>
  @if (Session::get('Success'))
    <script>
      Swal.fire(
        'Good job!',
        'Faktur successfully saved!',
        'success'
      )
    </script>
  @elseif (Session::get('Error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
      })
    </script>
  @endif
@endsection
