<div>
    <div class="row">
        <div class="col-md-4">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" wire:model="customer_name"
                required>
            @error('customer_name')
                <div class="is-invalid text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" class="form-control" id="order_date" name="order_date" wire:model="order_date"
                required>
            @error('order_date')
                <div class="is-invalid text-danger">{{ $message }}</div>
            @enderror
        </div>
        @if ($status == 'pending')
            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" wire:model="status"
                    {{ $viewMode ? 'disabled' : '' }} required>
                    <option value="">Select Status</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <div class="is-invalid text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif
    </div>
    <div class="row mt-3">
        <div class="row">
            <div class="col-md-4">
                <h3 class="d-inline-block mx-3" style="margin-left: 0 !important;">Products</h3>
                @if (!$viewMode)
                    <button type="button" class="btn btn-success" wire:click="addProduct()">Add Product</button>
                @endif
            </div>
        </div>
        @foreach ($orderProducts as $index => $orderProduct)
            <div class="row">
                <div class="col-md-4">
                    <label for="product_id{{ $index }}" class="form-label">Product</label>
                    <select class="form-select" id="product_id{{ $index }}" name="product_id{{ $index }}"
                        wire:model="orderProducts.{{ $index }}.product_id"
                        wire:change="updatePrice({{ $index }})" required {{ $viewMode ? 'disabled' : '' }}>
                        <option value="">Select a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $product->id == $orderProduct['product_id'] ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('orderProducts.*.product_id')
                        <div class="is-invalid text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                        wire:model="orderProducts.{{ $index }}.quantity" required
                        {{ $viewMode ? 'readonly' : '' }}>
                    @error('orderProducts.*.quantity')
                        <div class="is-invalid text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01"
                        wire:model="orderProducts.{{ $index }}.price" required
                        {{ $viewMode ? 'readonly' : '' }}>
                    @if ($index > 0 && count($orderProducts) > 1 && !$viewMode)
                        <button type="button" class="btn btn-danger"
                            style="position: relative; top: -38px; left: 260px;"
                            wire:click="removeProduct({{ $index }})">Remove Product</button>
                    @endif
                    @error('orderProducts.*.price')
                        <div class="is-invalid text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach
        <div class="row mt-3">
            <div class="col-md-12">
                @if (!$viewMode)
                    <button type="button" class="btn btn-primary" wire:click="save()">Save Sales Order</button>
                @endif
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
