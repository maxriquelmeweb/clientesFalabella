<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header text-center">
                <h4>Cargar o descargar archivo excel o csv con clientes falabella</h4>
            </div>
            <div class="card-body">
                @include('flash-message')
                <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="block w-full text-lg text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                        id="large_size" type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Solo archivos xls, xlsx o csv (maximo peso 2mb).</p>
                    </div>
                    <button class="btn btn-primary">Cargar Clientes</button>
                </form>

                <table class="table table-bordered mt-3">
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
                <div>
                    <a class="btn btn-danger mt-2" href="{{ route('clients.export') }}">Descargar Clientes</a>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>