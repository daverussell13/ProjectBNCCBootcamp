@extends('layouts.admin')

@section('meta')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">List of all products</h3>
          </div>

          <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                    aria-describedby="example1_info">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->name }}</td>
                          <td>
                            <img src="{{ asset('storage/' . $product->picture) }}" class="img-thumbnail" alt="pic"
                              height="100" width="100" style="max-height: 100px; max-width: 100px;">
                          </td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>{{ $product->category->name }}</td>
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg"
                              data-product="{{ $product->id }}" onclick="fetchDataProduct(event);">
                              <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6"></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Products</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-modal">
          <div class="modal-body">
            <div class="pr-3 pl-3">

              @csrf
              <img src="" class="img-thumbnail mb-2" alt="pic" id="modal-thumbnail" height="125"
                width="125" style="max-height: 150px; max-width: 150px;">
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
              @enderror"
                  name="quantity" value="{{ old('quantity') }}">
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
                    <input type="file" class="custom-file-input @error('picture') is-invalid @enderror"
                      id="inputPicture" name="picture">
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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('script')
  <script src="{{ asset('/') }}js/admin/fetchData.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{ asset('/') }}plugins/jszip/jszip.min.js"></script>
  <script src="{{ asset('/') }}plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{ asset('/') }}plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $('#example1').DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  </script>
@endsection
