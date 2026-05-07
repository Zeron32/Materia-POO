<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    // GET /schedules → lista todos os agendamentos
    public function index()
    {
        // retorna todos os registros em JSON
        $schedules = Schedule::all();
        return response()->json($schedules);
    }

    public function destroy($id)
{
    $schedule = Schedule::findOrFail($id);
    $schedule->delete();
    return response()->json(['success' => true]);
}

    // POST /schedules → cria um novo agendamento
    public function store(Request $request)
    {
        // valida os dados recebidos
        $validated = $request->validate([
            'produto' => 'required|string|max:255',
            'tamanho' => 'required|string|max:50',
            'cor' => 'required|string|max:50',
            'quantidade' => 'required|integer|min:1',
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required|string|max:20',
            'scheduledDate' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        // cria e salva no banco
        $schedule = Schedule::create($validated);

        // responde em JSON para o JS
        return response()->json([
            'success' => true,
            'message' => 'Agendamento salvo com sucesso!',
            'schedule' => $schedule
        ]);
    }
}
