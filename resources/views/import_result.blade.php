@extends('app')

@section('content')
    <section class="py-5 text-center container import-page">
        <div class="row py-lg-5">
            @if($status)
                <div class="alert alert-success" role="alert">
                    {{ $status }}
                    You can visit
                    <a href="{{ route('products') }}" class="alert-link">Products</a> page.
                </div>
            @endif
            @if($error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                    Get back to <a href="{{ route('index') }}" class="alert-link">Home</a> page.
                </div>
            @endif
        </div>
    </section>
@endsection
