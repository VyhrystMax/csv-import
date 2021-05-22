@extends('app')

@section('content')
    <section class="py-5 text-center container product-page">
        <h3>Product data</h3>
        <div class="row product-fields">
            @foreach ($map as $field => $label)
                <div class="col-6 col-sm-6 p-label">{{ $label }}</div>
                <div class="col-6 col-sm-6 p-value">{{$product[$field]}}</div>
                <div class="w-100 d-none d-md-block"></div>
            @endforeach
            @if(isset($product['attributes']))
                <div class="col-12 col-sm-12"><h5>Attributes</h5></div>
                @foreach ($product['attributes'] as $attribute)
                        <div class="col-6 col-sm-6 p-label">{{ $attribute['column_name'] }}</div>
                        <div class="col-6 col-sm-6 p-value">{{ $attribute['column_value'] }}</div>
                        <div class="w-100 d-none d-md-block"></div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
