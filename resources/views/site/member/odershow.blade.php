@extends('site.layout.member')
@section('content')
<div class="container-fluid">
    <div id="ui-view">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <strong>{{ trans('lang_woocommerce::sale_order.title_show') }} {{ $saleOrder->code }}</strong>
            </div>
            <div class="card-body">

                <div class="table-responsive-sm">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 50px" class="center">#</th>
                                <th>SKU</th>
                                <th>Item</th>
                                <th class="center">Quantity</th>
                                <th class="right">Unit Cost</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($saleOrder->sale_order_lines->count() > 0)
                            @foreach($saleOrder->sale_order_lines as $key => $saleOrderLine)
                            <tr>
                                <td class="center">{{ $key+ 1 }}</td>
                                <td class="left">{{ $saleOrderLine->product_sku }}</td>
                                <td class="left">{{ $saleOrderLine->product_name }}</td>
                                <td class="center">{{ $saleOrderLine->quantity }}</td>
                                <td class="right">{{ number_format($saleOrderLine->item_price_sell) }}</td>
                                <td class="right">{{ number_format($saleOrderLine->sub_total) }}</td>
                            </tr>
                            @endforeach
                            @endif

                            <tr>
                                <td colspan="5" class="text-right"><strong>Subtotal</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_sell) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Discount</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_discount) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>VAT</strong></td>
                                <td class="right">{{ number_format($saleOrder->price_tax) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Total</strong></td>
                                <td>
                                    <strong>{{ number_format($saleOrder->price_final) }}</strong>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>


        </div>
        <div class="no-print sale_order_action col-lg-12 col-sm-12">
            <a class="btn btn-default" href="{{ base_url('member/oder') }}" 
            style="
                color: #333;
                background-color: #ffc107;
                border-color: #ffc107; margin-top:10px;">
                <i class="fa fa-history"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection