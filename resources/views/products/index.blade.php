<x-app-layout>

    <x-slot:header>
        <li class="nav-item d-none d-md-block"><a href="{{ url('/products') }}" class="nav-link">Products</a></li>
    </x-slot>

    @section('title', 'Products')

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">Manage Products</div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

</x-app-layout>
