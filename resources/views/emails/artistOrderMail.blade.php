@component('mail::message')
<style>
    @font-face {
    font-family: "tajawal-regular";
    src: url("https://naqshart.com/fonts/Tajawal-Regular.ttf");
    font-style: normal;
    font-weight: 500;
    font-size: 17px;
}
img{
    width:150px;
}
*{
    font-family: 'tajawal-regular', sans-serif !important;
    text-align: right !important;
    font-size: 20px;
}
.footer *,.header{
    text-align: center !important;
    font-size: 15px !important;
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
.product__image{
    display: block;
}
.order-summary__small-text{
    font-size: 15px;
    color:#718096 !important;
}
hr{
    color:#d3d3d3;
}
</style>
![Some option text][logo]

[logo]: {{asset('/images/Logo_grey.png')}} "Logo"

<h1> !تم طلب إحدى أعمالك الفنية </h1>

تهانينا {{$palette->tag}}!
تم طلب أحد أعمالك الفنية ,واصل فنك وابداعك

<hr>
<table class="product-table" style="width:100%;">
    <tbody data-order-summary-section="line-items">
      <tr class="product" data-product-id="4643313582183" data-variant-id="32636147105895" data-product-type="Walltones" data-customer-ready-visible>
        <td class="product__image">
          <div class="product-thumbnail ">
<div class="product-thumbnail__wrapper">
  <img  class="product-thumbnail__image" src="https://naqshart.com/{{$palette->img}}" />
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
