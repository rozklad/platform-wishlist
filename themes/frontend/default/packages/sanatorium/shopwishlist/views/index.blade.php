@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
{{ trans('sanatorium/shoporders::cart.title') }}
@stop

{{-- Meta description --}}
@section('meta-description')
{{ trans('sanatorium/shoporders::cart.title') }}
@stop

{{-- Cart urls --}}
@section('scripts')
@parent
@stop



{{-- Page content --}}
@section('page')

	@section('styles')
<style type="text/css">
	.table > tbody > tr.product-row td {
		vertical-align: middle;
	}
	.table.table-noborder tr td, 
	.table.table-noborder tr th {
		border-top-color: transparent;
	}
	.price-total-row td, .price-total-row th {
		font-weight: 600;
		font-size: 22px;
	}
	.table.table-quantity > tbody > tr > td {
		padding: 0;
		line-height: 0;
	}
	.table.table-quantity > tbody > tr > td > input,
	.table.table-quantity > tbody > tr > td > button {
		height: 100%;
		padding-top: 0;
		padding-bottom: 0;
		line-height: 16px;
	}

	.cart-part.loading {
		opacity: 0.6;
	}
</style>
@parent
@stop

@section('scripts')
@parent
@stop
	
	<div class="panel panel-default cart-panel cart-part">

		<header class="panel-heading">
			
			{{ trans('sanatorium/wishlist::wishlist.title') }}

		</header>

		
		@if ( count($items) )
		<table class="table table-noborder" data-token="{{ csrf_token() }}">
			<tbody>
			@foreach( $items as $item )
				<?php $product = Product::find($item->get('id')); ?>
				@if ( is_object($product) )
				<tr class="product-row" data-id="{{ $item->get('id') }}" data-rowid="{{ $item->get('rowId') }}">
					<td class="text-center">
						@if ( $product->has_cover_image )
							<a href="{{ $product->url }}" target="_blank">
								<img src="{{ $product->coverThumb(60,60) }}" alt="{{ $product->product_title }}" width="60" height="60">
							</a>
						@else
							{{ $item->get('id') }}
						@endif
					</td>
					<td class="col-xs-4">
						
						<a href="{{ $product->url }}" target="_blank">{{ $product->product_title }}</a> 
						
						@if ($product->code)
							<span class="text-muted">({{ $product->code }})</span>
						@endif
					
					</td>
					<td class="text-right">
						{{-- Price one --}}
						{{ $product->getPrice('vat', 1) }}
					</td>
				</tr>
			@endif
			@endforeach
			</tbody>
		</table>
		@else
			
			<p class="alert alert-info">{{ trans('sanatorium/wishlist::wishlist.empty') }}</p>

		@endif

 	</div>
 
	<div class="text-center">
		
		<a href="{{ route('sanatorium.wishlist.wishlist.clear') }}" class="btn btn-default">
		
			{{ trans('sanatorium/wishlist::wishlist.clear') }}
		
		</a>

	</div>

@stop