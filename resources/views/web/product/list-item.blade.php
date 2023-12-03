@foreach($products as $k => $item)
	@include('web.products.product_item', compact('item'))
@endforeach