@component('mail::message')
<style>
    @font-face {
    font-family: "tajawal-regular";
    src: url("/fonts/Tajawal-Regular.ttf");
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

<h1> !تم استلام طلب الانضمام </h1>
مرحباً {{$name}},
تم استلام طلب انضمامك لعائلة نقش  .
ونود إعلامك بإضافتك لقائمة الدعوات لورش العمل والمناسبات التي تنظمها نقش.
واصل فنك وابداعك
    <hr>
    <div class="footer">
        <span>إذا كانت لديك أي أسئلة، يرجى الرد على هذا البريد الإلكتروني أو التواصل معنا على <a href="mailto:hello@naqshart.com">hello@naqshart.com</a>
        </span>
    </div>
@endcomponent
