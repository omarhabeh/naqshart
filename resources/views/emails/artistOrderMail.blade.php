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
    text-align: right !important;
    font-size: 20px;
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
    width: 40%;
    margin-top:5%;
}
.product__description__name{
    color: black;
    margin-bottom: -5px;
}
.product__image{
    display: block;
    float: left;
    width: 100px
}
.order-summary__small-text{
    font-size: 15px;
    color:#718096 !important;
}
hr{
    color:#d3d3d3;
}
p{
    direction:rtl;
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
.product__price *{
    font-size:17px;
}
</style>

![logo][logo]

[logo]: {{asset('https://naqshart.com/images/Logo_new.png')}} "Logo"

<h1>تم طلب إحدى أعمالك الفنية </h1>
<p>
    تهانينا {{$palette->tag}}! <br>
    تم طلب أحد أعمالك الفنية ,واصل فنك وابداعك</p>

<hr>
<table class="product-table" style="width:100%;">
    <tbody data-order-summary-section="line-items">
      <tr class="product" data-product-id="4643313582183" data-variant-id="32636147105895" data-product-type="Walltones" data-customer-ready-visible>
        <td class="product__image">
          <div class="product-thumbnail ">
<div class="product-thumbnail__wrapper">
  <img  class="product-thumbnail__image" src="https://naqshart.com/{{$palette->images[0]->img}}" />
</div>
</div>
        </td>
        <th class="product__description" scope="row">
            <span class="product__description__name order-summary__emphasis">{{$palette->name}}</span>
            <span class="product__description__variant order-summary__small-text">{{$palette->tag}}</span>
          </th>
        <td class="product__price">
          <span class="order-summary__emphasis skeleton-while-loading">العمل الفني</span>
        </td>
      </tr>
    </tbody>
  </table>
    <hr>
    <div class="footer">
        <span>إذا كانت لديك أي أسئلة، يرجى الرد على هذا البريد الإلكتروني أو التواصل معنا على <a href="mailto:hello@naqshart.com">hello@naqshart.com</a>
        </span>
    </div>


@endcomponent
