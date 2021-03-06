<!-- Code Field -->
<div class="form-group col-sm-5">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Percentage Field -->
<div class="form-group col-sm-5">
    {!! Form::label('discount_percentage', 'Discount Percentage:') !!}
    {!! Form::text('discount_percentage', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('all_shipping_cost', 'Discount full shippment cost') !!}
    @isset ($discount)
        <input type="checkbox" name="all_shipping_cost" id="all_shipping_cost" {{$discount->all_shipping_cost? 'checked':''}}>
    @else
        <input type="checkbox" name="all_shipping_cost" id="all_shipping_cost">
    @endisset

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('discounts.index') }}" class="btn btn-default">Cancel</a>
</div>
