<td class="text-nowrap">
    <a href="{{ route("$ruta.show", $m) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
    <a href="{{ route("$ruta.edit", $m) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
    <form method="POST" action="{{ route("$ruta.destroy", $m) }}" data-confirmar="{{ $msg }}" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
    </form>
</td>