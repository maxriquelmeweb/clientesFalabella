<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
  <div class="grid grid-cols-5 gap-4 mb-2 ml-2">
    <input type="number" min="0" max="9999999999" placeholder="Buscar por rut" wire:model="searchTerm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
</div>
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-100">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
      <tr>
        <th scope="col" class="py-3 px-6">
          Id
        </th>
        <th scope="col" class="py-3 px-6">
          Rut
        </th>
        <th scope="col" class="py-3 px-6">
          Nombre
        </th>
        <th scope="col" class="py-3 px-6">
          Apellido1
        </th>
        <th scope="col" class="py-3 px-6">
          Apellido2
        </th>
        <th scope="col" class="py-3 px-6">
          Monto Deuda
        </th>
        <th scope="col" class="py-3 px-6">
          Cartera
        </th>
        <th scope="col" class="py-3 px-6">
          4 Digitos
        </th>
        <th scope="col" class="py-3 px-6">
          Vencimiento
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clients as $client)
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          {{ $client->id }}
        </th>
        <td class="py-4 px-6">
          {{ $client->rut }}
        </td>
        <td class="py-4 px-6">
          {{ $client->client_name }}
        </td>
        <td class="py-4 px-6">
          {{ $client->last_name }}
        </td>
        <td class="py-4 px-6">
          {{ $client->second_last_name }}
        </td>
        <td class="py-4 px-6">
          ${{ $client->debt }}
        </td>
        <td class="py-4 px-6">
          {{ $client->wallet_name }}
        </td>
        <td class="py-4 px-6">
          {{ $client->digits }}
        </td>
        <td class="py-4 px-6">
          {{date('d-m-Y', strtotime($client->expiration)) }}
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <nav class="w-full text-sm text-left text-xs uppercase bg-gray-50 dark:bg-gray-200" aria-label="Table navigation">
    {{ $clients->links() }}
  </nav>
</div>