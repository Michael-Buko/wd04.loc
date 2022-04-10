@extends('layouts.admin')

@section('content')
    <div class="grid-form">
        <div class="grid-form1">
            <h3 id="forms-example" class="">Добавление записи</h3>
            <form action="{{ route('admin.countries.update', ['country' => $country]) }}" method="POST"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Название страны</label>
                    <input type="text" name="name" class="form-control" value="{{$country->name}}">
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $errorMessage)
                            <div class="alert alert-danger" role="alert">
                                {{ $errorMessage }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <label>Код страны</label>
                    <input type="text" name="code" class="form-control" value="{{$country->code}}">
                    @if($errors->has('code'))
                        @foreach($errors->get('code') as $errorMessage)
                            <div class="alert alert-danger" role="alert">
                                {{ $errorMessage }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="{{ route('admin.countries.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
@endsection
