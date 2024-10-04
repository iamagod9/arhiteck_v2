<?php

namespace App\Http\Controllers;

use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(StoreConsultationRequest $request) {
        $isModal = $request->is_modal;
        $data = ['name' => !$isModal ? $request->name : $request->name_modal_feedback, 'phone' => !$isModal ? $request->phone : $request->phone_modal_feedback];
        Consultation::create($data);

        return response()->json(['message' => 'Заявка успешно отправлена. В скором времени мы вам перезвоним!'], 201);
    }
}