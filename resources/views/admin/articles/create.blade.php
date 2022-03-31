@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление статьи</h3>
            <form action="{{ route('admin.store_article') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Содержание</label>
                    <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection
