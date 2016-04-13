<?php namespace Sanatorium\Wishlist\Widgets;

use Wishlist;

class Hooks {

	public function wishlist()
	{
		$wishlist = Wishlist::getInstance();
		$items = Wishlist::items();
		$quantity = Wishlist::quantity();

		return view('sanatorium/wishlist::hooks/wishlist', compact('wishlist', 'items', 'quantity'));
	}

	public function add($object = null)
	{
		return view('sanatorium/wishlist::hooks/add', compact('object'));
	}
}