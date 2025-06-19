<x-app-layout>

    <x-slot:header>
        <li class="nav-item d-none d-md-block"><a href="{{ url('/products') }}" class="nav-link">Products</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Create Product</a></li>
    </x-slot>

    @section('title', 'Create Product')

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">Create Product</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="is-invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku"
                                        value="{{ old('sku') }}" required>
                                    @error('sku')
                                        <div class="is-invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        step="0.01" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="is-invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="stock" class="form-label">Opening Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock') }}">
                                    @error('stock')
                                        <div class="is-invalid text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Create Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content-->

</x-app-layout>
