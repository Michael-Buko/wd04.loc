@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление категории товара</h3>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label >Название</label>
                    <input type="text" name="name" class="form-control"  value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label >Изображение </label>
                    <input type="file" name="image" class="form-control"  >
                </div>

                <div class="form-group">
                    <label >Родительская категория </label>
                    <select name="parent_id" class="form-control">
                        <option value="0"> Нет родителя</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
