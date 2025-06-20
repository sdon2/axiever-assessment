<a href="{{ route('salesOrders.show', $row->id) }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ route('salesOrders.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('salesOrders.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
