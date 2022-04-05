@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление записи</h3>
            <form action="{{ route('countries.update', ['id' => $country->id ]) }}" method="POST"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Название страны</label>
                    <input type="text" name="name" class="form-control" value="{{$country->name}}">
                </div>
                <div class="form-group">
                    <label>Код страны</label>
                    <input type="text" name="code" class="form-control" value="{{$country->code}}">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('countries.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
