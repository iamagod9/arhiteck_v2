<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Builder;

class AvitoController extends Controller
{
    public function newBuilding()
    {
        $estates = Estate::whereHas('type', function (Builder $builder) {
            $builder->where('name', "Новостройка");
        })->get();

        return response()->view('avito.new', compact('estates'))->header('Content-Type', 'text/xml');
    }

    public function secondaryBuilding()
    {
        $estates = Estate::whereHas('type', function (Builder $builder) {
            $builder->where('name', "Вторичное");
        })->get();

        return response()->view('avito.secondary', compact('estates'))->header('Content-Type', 'text/xml');
    }

    public function houses()
    {
        $estates = Estate::whereHas('type', function (Builder $builder) {
            $builder->where('name', "Дом, дача");
        })->get();

        return response()->view('avito.houses', compact('estates'))->header('Content-Type', 'text/xml');
    }

    public function area()
    {
        $estates = Estate::whereHas('type', function (Builder $builder) {
            $builder->where('name', "Участок");
        })->get();

        return response()->view('avito.area', compact('estates'))->header('Content-Type', 'text/xml');
    }
}
