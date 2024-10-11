<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(StoreConsultationRequest $request)
    {
        $isModal = $request->get('is_modal', 0);
        $isEstate = $request->get('is_estate', 0);

        $data = [];
        if ($isModal) {
            $data = ['name' => $request->name_modal_feedback, 'phone' => $request->phone_modal_feedback];
        } elseif ($isEstate) {
            $data = ['name' => $request->name_estate_consultation, 'phone' => $request->phone_estate_consultation];
        } else {
            $data = ['name' => $request->name, 'phone' => $request->phone];
        }

        Consultation::create($data);

        return response()->json(['message' => 'Заявка успешно отправлена. В скором времени мы вам перезвоним!'], 201);
    }
}