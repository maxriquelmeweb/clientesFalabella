<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
      </tr>
      @endforeach

    </tbody>
  </table>
  <nav class="w-full text-sm text-left text-xs uppercase bg-gray-50 dark:bg-gray-200" aria-label="Table navigation">
    {{ $clients->links() }}
  </nav>
</div>