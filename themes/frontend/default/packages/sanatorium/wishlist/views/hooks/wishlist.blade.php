{{ trans('sanatorium/wishlist::wishlist.title') }}

{{ $quantity }}

@foreach($items as $item)
	{{ $item->id }}
@endforeach