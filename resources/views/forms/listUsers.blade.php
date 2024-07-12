@extends('layout.userBase')

@section('userContent')
    <div class="user-list-container">
        <div class="user-list">
            <h2>Lista de Usuarios</h2>

            <form method="GET" action="{{ route('user.list') }}" class="filter-form">
                <label for="role">Filtrar por rol:</label>
                <select name="role" id="role" onchange="this.form.submit()">
                    <option value="all" {{ $role == 'all' ? 'selected' : '' }}>Todos</option>
                    <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Administradores</option>
                    <option value="client" {{ $role == 'client' ? 'selected' : '' }}>Clientes</option>
                </select>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($users->isEmpty())
                <p>No hay usuarios disponibles.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role == 1 ? 'Administrador' : 'Cliente' }}</td>
                                <td class="actions-cell">
                                    <a href="{{ route('admin.editUser', $user->id) }}">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </a>
                                    {{-- <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display:inline-block;"> --}}
                                    <form action="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                    this.submit();
                }
            });
        });
    </script>
    
@endsection