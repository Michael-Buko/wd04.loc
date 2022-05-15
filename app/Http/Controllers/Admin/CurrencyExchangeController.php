<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CurrencyExchangeController extends Controller
{
    public function exchangeNbrb()
    {
        $currencies = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])
            ->get('https://www.nbrb.by/api/exrates/rates?periodicity=0')->collect();
        return view('admin.exchange.nbrb', [
            'currencies' => $currencies,
        ]);
    }
}
