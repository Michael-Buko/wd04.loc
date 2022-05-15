@extends('layouts.admin')

@section('content')
    <head>
        <link rel="stylesheet" href="style.css">

    </head>
    <div class="wrapper">
        <header>Конвертер валют</header>
        <form>
            <div class="amount">
                <p>Введите сумму</p>
                <input type="text" class="exchangeSum" value="1">
            </div>
            <div class="drop-list">
                <div class="from">
                    <p>Из</p>
                    <div class="select-box">
                        <img class="flagFrom" src="https://htmlweb.ru/geo/flags/by.png" alt="flag">
                        <select class="fromCurr">
                            <option value="BYN">Белорусский рубль</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency['Cur_Abbreviation'] }}">{{ $currency['Cur_Name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="to">
                    <p>В</p>
                    <div class="select-box">
                        <img class="flagTo" src="https://htmlweb.ru/geo/flags/by.png" alt="flag">
                        <select class="toCurr">
                            <option value="BYN">Белорусский рубль</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency['Cur_Abbreviation'] }}">{{ $currency['Cur_Name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <p>На дату</p>
                <input type="date" name="dateExchange" class="dateExchange"  value="{{ date('Y-m-d') }}">
            </div>
            <div class="exchange-rate">Getting exchange rate...</div>
            <button class="calculate">Рассчитать</button>
        </form>
    </div>
@endsection
