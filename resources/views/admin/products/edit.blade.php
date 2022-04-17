@extends('layouts.admin')

@section('content')


    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Редактирование карточки товара</h3>
            <form action="{{ route('admin.product.update', compact('product')) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="name" class="form-control" value="{{$product->name}}">
                </div>
                <div class="form-group">
                    <label>Описание</label>
                    <textarea name="description" class="form-control">
                        {{$product->description}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Цена</label>
                    <input type="text" name="price" class="form-control" value="{{$product->price}}">
                </div>
                @if($product->img)
                    <img src="{{asset($product->img)}}" alt="">
                @endif
                <div class="form-group">
                    <label>Изображение </label>
                    <input type="file" name="img" class="form-control">
                </div>

                <div class="form-group">
                    <label>Категория товара</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $сategory)
                            <option
                                value="{{$сategory->id}}" {{$сategory->id == $product->category->id ?'selected':''}}>{{$сategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('admin.product.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
