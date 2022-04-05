@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление записи</h3>
            <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Название страны</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Код страны</label>
                    <input type="text" name="code" class="form-control">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('countries.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
