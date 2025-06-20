<a href="{{ route('salesOrders.show', $row->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye"></i></a>
<a href="{{ route('salesOrders.edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
<a href="{{ route('salesOrders.download', $row->id) }}" target="_blank" class="btn btn-sm btn-info" title="Download"><i class="fa fa-download"></i></a>
<form action="{{ route('salesOrders.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa fa-trash"></i></button>
</form>
