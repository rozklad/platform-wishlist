<?php namespace Sanatorium\Wishlist\Controllers\Frontend;

use Wishlist;
use Platform\Foundation\Controllers\Controller;
use Product;

class WishlistController extends Controller {

	public function add()
	{
		$product = Product::find( request()->get('id') );

		$item = [];

		$item['id'] = $product->id;

		$item['quantity'] = (int)request()->get('quantity');
		$item['name'] = $product->product_title;
		$item['price'] = $product->getPrice('vat', 1, null, false);
		$item['weight'] = $product->weight;

		Wishlist::add($item);

		if ( !request()->ajax() ) {
			return redirect()->back();
		}

		return redirect()->back();
	}

	public function index()
	{
		$items = Wishlist::items();

		return view('sanatorium/wishlist::index', compact('items'));
	}

	public function clear()
	{
		Wishlist::clear();

		return redirect()->to('/');
	}
}
