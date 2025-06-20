<x-app-layout>

    <x-slot:header>
        <li class="nav-item d-none d-md-block"><a href="{{ url('/salesOrders') }}" class="nav-link">Sales Orders</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Create Sales Order</a></li>
    </x-slot>

    @section('title', 'Create Sales Order')

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">Create Sales Order</div>
                    <div class="card-body">
                        @livewire('sales-order', ['salesOrder' => null])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content-->

</x-app-layout>
