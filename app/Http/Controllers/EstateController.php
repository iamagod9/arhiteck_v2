<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstateViewingRequest;
use App\Models\Estate;
use App\Models\EstateType;
use App\Models\EstateViewing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function getParams(Request $request): array
    {
        return [
            'type_slug' => $request->get('type', ''),
            'rooms' => $request->get('rooms', ''),
            'from_price' => $request->get('from_price', ''),
            'to_price' => $request->get('to_price', ''),
            'from_square' => $request->get('from_square', ''),
            'to_square' => $request->get('to_square', ''),
        ];
    }
    public function getEstatesByParams(array $params, bool $isMap = false)
    {
        $type_slug = $params['type_slug'];
        $rooms = $params['rooms'];
        $from_price = $params['from_price'];
        $to_price = $params['to_price'];
        $from_square = $params['from_square'];
        $to_square = $params['to_square'];

        $query = Estate::query();

        if (!empty($type_slug)) {
            $query->whereHas('type', function (Builder $builder) use ($type_slug) {
                $builder->where('slug', $type_slug);
            });
        }

        if ($rooms != '')
            $query->where('rooms', $rooms == "more" ? '>=' : "=", $rooms == "more" ? 4 : $rooms);
        if (!empty($from_price))
            $query->where('price', ">=", $from_price);
        if (!empty($to_price))
            $query->where('price', "<=", $to_price);
        if (!empty($from_square))
            $query->where('square', ">=", $from_square);
        if (!empty($to_square))
            $query->where('square', "<=", $to_square);

        if ($isMap) {
            return $query->get();
        }
        return $query->paginate(5)->withQueryString();
    }
    public function index(Request $request)
    {
        $params = self::getParams($request);
        $estates = self::getEstatesByParams($params);
        $estates_total = $estates->total();
        $types = EstateType::all();

        return view("estate.index", ['estates' => $estates, 'estates_total' => $estates_total, 'types' => $types, ...$params]);
    }

    public function show(Estate $estate, EstateType $type)
    {
        return view("estate.show", compact('estate', 'type'));
    }

    public function viewing(EstateViewingRequest $request)
    {
        EstateViewing::create($request->validated());

        return response()->json(['message' => "Вы успешно записались на просмотр, ожидайте звонка сотрудника."], 201);
    }

    public function map(Request $request)
    {
        $params = self::getParams($request);
        $estates = self::getEstatesByParams($params, true);
        return view("estate.map", compact('estates'));
    }
}