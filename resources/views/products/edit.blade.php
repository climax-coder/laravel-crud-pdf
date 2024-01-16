@extends('products.layout')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <div class="flex justify-between mb-6">
      <h2 class="text-xl font-semibold leading-tight">Edit Product</h2>
      <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">Back</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Whoops!</strong> There were some problems with your input.
      <ul class="mt-3 list-disc list-inside text-sm text-red-700">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
          <div class="form-group">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name" required>
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Price" required>
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Description" required>{{ $product->description }}</textarea>
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="feature_image" class="block text-gray-700 text-sm font-bold mb-2">Feature Image:</label>
            <input type="file" name="feature_image" id="feature_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if($product->feature_image)
            <div class="mt-4">
              <img src="/image/feature/{{ $product->feature_image }}" class="w-48 h-auto bg-white">
            </div>
            @endif
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="gallery_images" class="block text-gray-700 text-sm font-bold mb-2">Gallery Images:</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
            @if($product->gallery_images)
            <div class="flex space-x-2 mt-4">
              @foreach(json_decode($product->gallery_images, true) as $image)
              <img src="/image/gallery/{{ $image }}" class="w-20 h-20 rounded">
              @endforeach
            </div>
            @endif
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="shipping_cost" class="block text-gray-700 text-sm font-bold mb-2">Shipping Cost:</label>
            <input type="number" name="shipping_cost" id="shipping_cost" value="{{ $product->shipping_cost }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Shipping Cost" required>
          </div>
        </div>

        <div class="md:col-span-2">
          <div class="form-group">
            <label for="product_status" class="block text-gray-700 text-sm font-bold mb-2">Product Status:</label>
            <select name="product_status" id="product_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <option value="active" {{ $product->product_status == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ $product->product_status == 'inactive' ? 'selected' : '' }}>Inactive</option>
              <option value="archived" {{ $product->product_status == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
          </div>
        </div>

        <div class="md:col-span-2 text-center">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection