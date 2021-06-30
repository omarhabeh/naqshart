@section('main')
<script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutid}}"></script>
<form action="{{route('payment',$orderid)}}" class="paymentWidgets" data-brands="VISA MASTER MADA"></form>
@stop
