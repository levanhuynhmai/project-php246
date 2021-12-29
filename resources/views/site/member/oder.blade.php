@extends('site.layout.member')
@section('content')
<div class="p-5 mb-4 bg-light rounded-3">


    <table class="table table-responsive-sm table-bordered table-hover font12">
        <thead>
            <tr class="bg-light">
                <th>{{ trans('lang_woocommerce::sale_order.code') }}</th>
                <th class="th-category_id">{{ trans('lang_woocommerce::sale_order.billing_fullname') }}</th>
                <th class="th-category_id">{{ trans('lang_woocommerce::sale_order.billing_phone') }}</th>
                <th class="th-created_at">{{ trans('lang_woocommerce::sale_order.created_at_web') }}</th>
                <th class="th-created_at">{{ trans('lang_woocommerce::sale_order.price_final') }}</th>
                <th class="th-status text-center">{{ trans('lang_woocommerce::sale_order.status') }}</th>
            </tr>
        </thead>
        <tbody>

            @if ($items->count() > 0)
            @foreach ($items as $item)
            <tr>
                <td><a href="{{ base_url('oder/'.$item->id)}}">{{ $item->code }}</a></td>
                <td>{{ $item->billing_fullname }}</td>
                <td>{{ $item->billing_phone }}</td>
                <td>{{ $item->created_at->format(config('app.date_format')) }}</td>
                <td class="text-primary">{{ number_format($item->price_final) }}</td>
                <td class="text-center">
                    <label class="label label-{{ $item->status_color }}">
                        {{ $item->status_text }}
                    </label>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">
                    {{ trans('common.data_empty') }}
                </td>
            </tr>
            @endif
        </tbody>
        
    </table>


</div>
@endsection