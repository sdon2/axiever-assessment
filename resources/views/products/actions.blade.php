<a href="{{ route('products.show', $row->id) }}" class="btn btn-sm btn-primary">View</a>
<a href="{{ route('products.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('products.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
