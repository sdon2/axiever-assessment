<x-app-layout>

    <x-slot:header>
        <li class="nav-item d-none d-md-block"><a href="{{ url('/salesOrders') }}" class="nav-link">Sales Orders</a></li>
    </x-slot>

    @section('title', 'Sales Orders')

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">Manage Sales Orders</div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('salesOrders.create') }}" class="btn btn-primary">Add New Sales Order</a>
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
