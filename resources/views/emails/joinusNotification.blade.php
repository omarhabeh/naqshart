@component('mail::message')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet"> 
<style>
img{
    width:150px;
}
*{
    font-family: 'Tajawal', sans-serif !important;
    text-align: right !important;
    font-size: 20px;
    direction: rtl;
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

![logo][logo]

[logo]: {{asset('https://naqshart.com/images/Logo_grey.png')}} "Logo"

<h1> تم استلام طلب الانضمام! </h1>
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
