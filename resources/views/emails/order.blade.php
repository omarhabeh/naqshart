@component('mail::message')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet"> 
<link rel="stylesheet" href="https://cdn.shopify.com/app/services/30004362/assets/76713951280/checkout_stylesheet/v2-ltr-edge-c3b6d318409215f8f96ba35f2a7373c0-176600" media="all" />
<style>

img{
    width:300px;
}
*{
    font-family: 'Tajawal', sans-serif !important;
    font-size: 20px;
    direction: ltr;
}
.footer *,.header{
    text-align: center !important;
    font-size: 12px !important;
}
.product-thumbnail__image{
    width:100px;
    float: left;
}
.product__description,.product__description * {
    text-align: left !important;
    float: left;
    display: grid;
    padding-left: 5px;
}
.product__description{
    width: 50%;
}
.product__image{
    display: block;
    float: left;
}
.order-summary__small-text{
    font-size: 15px;
    color:#718096 !important;
}
hr{
    color:#d3d3d375;
}
.product__price{
    float: right;
}
h1{
    font-size: 25px;
}
.total-line-table{
    width: 100%;
}
.total-line-table *{
    text-align: center !important;
}
.total{
    font-size: 30px;
    color: black;
}
.content-box{
    border:none;
}
.content-box *{
    text-align: left;
}
.total-line-table__tbody + .total-line-table__tbody .total-line:first-child th, .total-line-table__tbody + .total-line-table__tbody .total-line:first-child td, .total-line-table__tbody + .total-line-table__footer .total-line:first-child th, .total-line-table__tbody + .total-line-table__footer .total-line:first-child td{
    padding-top: 0px;
}
h1{
    font-size: 25px;
margin-bottom: 15px;
}
.product-table{
    margin: 30px 8px !important;
}
.header {
    display: none !important;
}
p{
    text-align: left !important;
}
</style>

![logo][logo]

[logo]: {{asset('https://naqshart.com/images/Logo_new.png')}} "Logo"

<small style="width: 25%;
margin-top: -60px;">Order #{{$order->id}}</small>

<h1 style="color: black"> Thank you for your order! </h1>
<p>
    Hi  {{$order->fname}},
We hope you enjoyed the digital gallery; We will send you tracking information when
the order ships, you can find your order information bellow
</p>
    <hr>
    <h2 style="color: black">Order Summary</h2>
    <table class="product-table" style="width:100%;">
        <tbody data-order-summary-section="line-items">
            @foreach ($palettes as $key=>$item)
          <tr class="product" data-product-id="4643313582183" data-variant-id="32636147105895" data-product-type="Walltones" data-customer-ready-visible>
            <td class="product__image">
              <div class="product-thumbnail ">
    <div class="product-thumbnail__wrapper">
      <img  class="product-thumbnail__image" src="https://naqshart.com/{{$item->images[0]->img}}" />
    </div>
    </div>
            </td>
            <th class="product__description" scope="row">
                <span class="product__description__name order-summary__emphasis">{{$item->name}}</span>
                <span class="product__description__variant order-summary__small-text">{{$item->tag}}</span>
              </th>
            <td class="product__price">
              <span class="order-summary__emphasis skeleton-while-loading">{{$order->items[$key]->price}} SAR</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <hr>
      <table class="total-line-table">
          <tbody class="total-line-table__tbody">
            <tr class="total-line total-line--subtotal">
              <th class="total-line__name" scope="row">Subtotal</th>
              <td class="total-line__price">
                  <span class="order-summary__emphasis skeleton-while-loading" data-checkout-subtotal-price-target="6000">
                  {{$pallete_price}} {{$data->currency}}
                  </span>
        </td>
      </tr>
              <tr class="total-line total-line--shipping">
        <th class="total-line__name" scope="row">
            <span>
              Shipping
            </span>
        </th>
        <td class="total-line__price">
          <span class="skeleton-while-loading order-summary__emphasis" data-checkout-total-shipping-target="1230">
            {{$data->amount - $pallete_price}} {{$data->currency}}
          </span>
        </td>
      </tr>
          </tbody>
        <tfoot class="total-line-table__footer">
          <tr class="total-line">
            <th class="total-line__name" scope="row">
                <span>
                  Total
                </span>
            </th>
            <td class="total-line__price payment-due" data-presentment-currency="USD">
                <span class="payment-due__currency remove-while-loading">{{$data->currency}}</span>
              <span class="payment-due__price skeleton-while-loading--lg total">
                {{$data->amount}}
              </span>
            </td>
          </tr>
        </tfoot>
      </table>
    <hr>
    <div class="content-box">
<div class="content-box__row">
    <div class="section__content">
        <div class="section__content__column section__content__column--half">
        <div class="text-container">
                <h3 class="heading-3">Shipping address</h3>
                <address class="address">{{$order->fname}} {{$order->lname}}<br />{{$order->address}}<br />{{$order->city}} {{$order->postcode}}<br />{{$order->country}}<br />{{$order->phonecode}}{{$order->phone}}</address>
                <h3 class="heading-3">Shipping method</h3>
                <p>Standard Shipping (5-12 business days)</p>
        </div>
        </div>
                <div class="section__content__column section__content__column--half">
                <div class="text-container">
                        <h3 class="heading-3">Payment method</h3>
                        <li class="payment-method-list__item">
                            @if ($order->payment_method == "VISA")
                            <i class="payment-icon payment-icon--visa payment-method-list__item-icon"></i> 
                            @endif
                            @if ($order->payment_method == "MASTER")
                            <i class="payment-icon payment-icon--master payment-method-list__item-icon"></i> 
                            @endif
          <span class="payment-method-list__item__info">ending with {{$data->last4Digits}}</span>
            <span class="payment-method-list__item__amount emphasis"> - {{$data->currency}} {{$data->amount}}</span>
        </li>
            </ul>
            <h3 class="heading-3">Billing address</h3>
            <address class="address">{{$order->fname}} {{$order->lname}}<br />{{$order->address}}<br />{{$order->city}} {{$order->postcode}}<br />{{$order->country}}<br />{{$order->phonecode}}{{$order->phone}}</address>
        </div>
        </div>
    </div>
</div>
</div>
    <div class="footer">
        <span>If you have any questions, reply to this email or contact us at <a href="mailto:hello@naqshart.com">hello@naqshart.com</a>
        </span>
    </div>
@endcomponent
