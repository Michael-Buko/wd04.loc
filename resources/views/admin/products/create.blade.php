@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление товара</h3>
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label >Название</label>
                    <input type="text" name="name" class="form-control"  value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label >Описание</label>
                    <textarea name="description" class="form-control">
                        {{old('description')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label >Цена</label>
                    <input type="text" name="price" class="form-control"  value="{{old('price')}}">
                </div>
                <div class="form-group">
                    <label >Изображение </label>
                    <input type="file" name="img1" class="form-control">
                    <input type="file" name="img2" class="form-control">
                    <input type="file" name="img3" class="form-control">
                    <input type="file" name="img4" class="form-control">
                    <input type="file" name="img5" class="form-control">
                </div>

                <div class="form-group">
                    <label >Категория товара</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('admin.product.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
