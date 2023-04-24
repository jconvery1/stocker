<div>
    You've received an order from James' Shoe Shop!
</div>
<br />
<br />
<div>
    Order Details:
</div>
<div>
    @foreach($stockOrders as $stockOrder)
    <tr>
        Item: {{ $stockOrder->item_name }}
    </tr>
    <br />
    <tr>
        Quantity: {{ $stockOrder->quantity }}
    </tr>
    <br />
    <br />
    @endforeach
</div>
<br />
<div>
    Notes:
</div>
<div>
    {{ $order->notes ? $order->notes : 'No notes attached to this order' }}
</div>