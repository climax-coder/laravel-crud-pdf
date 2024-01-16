@extends('products.layout')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <div class="flex justify-between mb-6">
      <h2 class="text-xl font-semibold leading-tight">Show Product</h2>
      <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-900">Back</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Product Information
        </h3>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Name
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              {{ $product->name }}
            </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Price
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              ${{ number_format($product->price, 2) }}
            </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Description
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              {{ $product->description }}
            </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Feature Image
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              <img src="/image/feature/{{ $product->feature_image }}" class="w-32 h-32 rounded">
            </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Gallery Images
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 space-x-2">
              @if($product->gallery_images)
                @foreach(json_decode($product->gallery_images, true) as $image)
                  <img src="/image/gallery/{{ $image }}" class="inline-block w-20 h-20 rounded">
                @endforeach
              @endif
            </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Shipping Cost
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              ${{ number_format($product->shipping_cost, 2) }}
            </dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Product Status
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
              {{ ucfirst($product->product_status) }}
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</div>
@endsection