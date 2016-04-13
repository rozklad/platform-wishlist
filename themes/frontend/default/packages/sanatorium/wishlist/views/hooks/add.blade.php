<form method="POST" action="{{ route('sanatorium.wishlist.wishlist.add') }}" class="form-inline form-to-cart" role="form">
	<input type="hidden" name="id" value="{{ $object->id }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<input class="form-control quantity" name="quantity" type="hidden" value="1">
	<button class="btn btn-success btn-add-to-cart" type="submit">
		<i class="fa fa fa-heart"></i>
	</button>

</form>