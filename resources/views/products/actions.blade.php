<a href="{{ route('products.show', $row->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye"></i></a>
<a href="{{ route('products.edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit"></i></a></a>
<form action="{{ route('products.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
</form>
