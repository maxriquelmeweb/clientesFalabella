<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div
            class="mt-3 block full-width bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Cargar archivo csv con
                    clientes falabella</h5>
                <p class="text-gray-900 dark:text-white">Aquí debes cargar el archivo que contiene todos los clientes
                    que se desea mostrar en el webservice.</p>
                @include('flash-message')
                <form action="{{ route('clients.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <input
                            class="block text-lg text-gray-200 rounded-lg border border-gray-300 cursor-pointer focus:outline-none dark:border-gray-600 dark:placeholder-gray-400"
                            id="large_size" type="file" name="file" onclick="cleanAllMessage()" accept=".csv">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-200" id="file_input_help">Solo archivo csv
                        </p>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cargar Clientes</button>
                </form>
            </div>
        </div>
        <div
            class="mt-2 block full-width bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Lista de clientes
                    falabella ({{ $registerTotal }} registros activos)</h5>
                <p class="text-gray-900 dark:text-white">Aquí se muestran todos los clientes activos los cuales se
                    exponen para consumir en el webservice.</p>
            </div>
            @livewire('client-pagination')
            @livewireScripts
        </div>
        <div
            class="mt-2 block full-width bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Descargar lista de
                    clientes falabella</h5>
                <p class="text-gray-900 dark:text-white">Aquí puedes descagar la lista completa de los clientes
                    falabellas activos.</p>

                <div class="mb-3 mt-4">
                    <a class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        href="{{ route('clients.export') }}">Descargar Clientes</a>
                </div>
            </div>
        </div>
        <div
            class="mt-2 block full-width bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Eliminar lista de
                    clientes falabella</h5>
                <p class="text-gray-900 dark:text-white">Aquí puedes eliminar la lista de clientes para cargar un
                    listado limpio.</p>
                <div class="mb-3 mt-4">
                    <form action="{{ route('clients.destroy'), 1 }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('¿Seguro deseas eliminar?')"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Eliminar
                            todos los clientes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('page-script')
    <script type="text/javascript">
        function hiddenMessage(id){
        element = document.getElementById(id);
        element.classList.add("hidden");
        }
        function cleanAllMessage(){
            for(let i=1; i<=3; i++){
                element = document.getElementById('alert-'+i);
                if(element)
                element.classList.add("hidden");
            }
        }
    </script>
    @stop
</x-app-layout>