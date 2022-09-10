<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header text-center">
                <h4>Laravel 9 Import Export Excel & CSV File to Database</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-primary">Importar Clientes</button>
                </form>

                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="3">
                            Lista de clientes
                            <a class="btn btn-danger float-end" href="{{ route('clients.export') }}">Exporta lista</a>
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                    </tr>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->rut }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->last_name }}</td>
                        <td>{{ $client->second_last_name }}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

</x-app-layout>