<x-app-layout>

    <x-slot:header>
        <li class="nav-item d-none d-md-block"><a href="{{ url('/salesOrders') }}" class="nav-link">Sales Orders</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">View Sales Order</a></li>
    </x-slot>

    @section('title', 'View Sales Order')

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">View Sales Order</div>
                    <div class="card-body">
                        @livewire('sales-order', ['salesOrder' => $salesOrder, 'viewMode' => true])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
    </div>
    <!--end::App Content-->

</x-app-layout>
