<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
$this->middleware('auth')->except('index');
    }
    
    public function index()
    {
        $schedules = Auth::user()->schedules;
        return view('schedules.index', compact('schedules'));
    }
    
    public function create()
    {
        return view('schedules.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable|string'
        ]);
        
        $schedule = Auth::user()->schedules()->create($validated);
        
        return redirect()->route('schedules.index')
            ->with('success', 'Agendamento criado com sucesso!');
    }
    
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.show', compact('schedule'));
    }
    
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable|string'
        ]);
        
        $schedule = Schedule::findOrFail($id);
        $schedule->update($validated);
        
        return redirect()->route('schedules.index')
            ->with('success', 'Agendamento atualizado com sucesso!');
    }
    
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        
        return redirect()->route('schedules.index')
            ->with('success', 'Agendamento removido com sucesso!');
    }
}