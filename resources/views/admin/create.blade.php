@extends('layouts.admin')

@section('content')
  <form action="/admin/create" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row pr-2 pl-2">
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Product</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Name</label>
              <input type="text" id="inputName"
                class="form-control @error('name')
                is-invalid @enderror" name="name"
                value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPrice">Price</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa-solid fa-rupiah-sign"></i>
                  </span>
                </div>
                <input type="text"
                  class="form-control @error('price')
                  is-invalid
                @enderror"
                  id="inputPrice" name="price" value="{{ old('price') }}">
                <div class="input-group-append">
                  <div class="input-group-text">.00</div>
                </div>
                @error('price')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

            </div>
            <div class="form-group">
              <label for="inputCategory">Category</label>
              <select id="inputCategory" class="form-control custom-select" name="category">
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="inputQuantity">Quantity</label>
              <input type="number" id="inputQuantity"
                class="form-control @error('quantity')
                is-invalid
              @enderror" name="quantity"
                value="{{ old('quantity') }}">
              @error('quantity')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPicture">Picture</label>
              <div class="input-group @error('picture') is-invalid @enderror">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('picture') is-invalid @enderror" id="inputPicture"
                    name="picture">
                  <label class="custom-file-label" for="exampleInputFile">Choose File</label>
                </div>
              </div>
              @error('picture')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row pr-2 pl-2">
      <div class="col-12">
        <a href="{{ route('admin.create') }}" class="btn btn-secondary mr-2">Reset</a>
        <input type="submit" value="Create new Product" class="btn btn-success">
      </div>
    </div>
  </form>
@endsection

@section('script')
  <script src="{{ asset('/') }}js/admin/create_page.js"></script>
  @if (Session::get('Success'))
    <script>
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        body: '{{ Route::get('Success') }}',
        autohide: true,
        delay: 2000
      });
    </script>
  @elseif (Session::get('Failed'))
    <script>
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Failed',
        body: '{{ Route::get('Failed') }}',
        autohide: true,
        delay: 2000
      })
    </script>
  @endif
@endsection
