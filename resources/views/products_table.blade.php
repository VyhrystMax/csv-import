@extends('app')

@section('content')
    <section class="py-5 text-center container import-page">
        <div class="row py-lg-5">
            @if(empty($data))
                <h3>No products found!</h3>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Manufacturer</th>
                            <th scope="col">Model</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $product)
                            <tr>
                                <th scope="row">
                                    <a href="{{route('product.show', ['id'=>$product->id])}}">{{$product->id}}</a>
                                </th>
                                <td>{{$product->manufacturer}}</td>
                                <td>{{$product->model}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <div class="row">
                        {!! $data->links() !!}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
