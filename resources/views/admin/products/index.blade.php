@extends('layouts.admin')

@section('content')
    <div class="grid_3 grid_5">
        <h3 class="head-top">Товары</h3>


        <div class="but_list">
            <div class="col-md-12 page_1">
                <p><a href="{{ route('admin.product.create') }}" class="btn btn-info"> Создать</a></p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название товара</th>
                        <th>Изображения товара</th>
                        <th> Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td> {{$loop->iteration}}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                @foreach($images as $image)
                                    @if ($image->imageable_id == $product->id)
                                        <img src="{{ asset($image->path) }}" style="max-width: 100px; max-height: 100px">
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <form method="POST"
                                      action="{{ route('admin.product.destroy', ['product'=> $product ]) }}">
                                    <a href="{{ route('admin.product.edit', ['product'=> $product ]) }}"
                                       class="btn btn-lg btn-info">Редактировать</a>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-lg btn-danger">Удалить</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links('partials.pagination') }}

            <div class="clearfix"></div>
        </div>
    </div>
@endsection
