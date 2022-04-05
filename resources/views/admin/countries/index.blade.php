@extends('layouts.admin')

@section('content')
    <div class="grid_3 grid_5">
        <h3 class="head-top">Counries</h3>
        <div class="but_list">
            <div class="col-md-12 page_1">
                <p><a href="{{ route('admin.countries.create') }}"
                      class="btn btn-lg btn-info">Создать запись</a></p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Название страны</th>
                        <th>Код страны</th>
                        <th> Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->code }}</td>
                            <td>
                                <form method="POST"
                                      action="{{ route('admin.countries.destroy', ['country'=> $country]) }}">
                                <a href="{{ route('admin.countries.edit', ['country'=> $country]) }}"
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
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
