@extends('products.layout')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <div class="flex justify-between mb-6">
      <h2 class="text-xl font-semibold leading-tight">Elliephant Products</h2>
      <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create New Product</a>
    </div>

    @if ($message = Session::get('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Success!</strong>
      <span class="block sm:inline">{{ $message }}</span>
    </div>
    @endif

    <table class="min-w-full leading-normal mt-6">
      <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2">No</th>
          <th class="px-4 py-2">Feature Image</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Price</th>
          <th class="px-4 py-2">Shipping Cost</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
        <tr>
          <td class="border px-4 py-2">{{ ++$i }}</td>
          <td class="border px-4 py-2">
            <img src="/image/feature/{{ $product->feature_image }}" class="w-16 h-16 rounded">
          </td>
          <td class="border px-4 py-2">{{ $product->name }}</td>
          <td class="border px-4 py-2">${{ number_format($product->price, 2) }}</td>
          <td class="border px-4 py-2">${{ number_format($product->shipping_cost, 2) }}</td>
          <td class="border px-4 py-2">{{ $product->product_status }}</td>
          <td class="border px-4 py-2">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
              <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded h-[40px]"><i class="fa fa-address-book"></i></a>
              <a href="{{ route('products.edit', $product->id) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white py-1 px-3 rounded"><i class="fa fa-pencil"></i></a>
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"><i class="fa fa-remove"></i></button>
              <a href="{{ route('products.pdf', $product) }}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded"><i class="fa fa-file-pdf-o"></i></a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4">
      {!! $products->links() !!}
    </div>
  </div>
</div>
@endsection