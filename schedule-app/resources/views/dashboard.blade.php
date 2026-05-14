<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h5 class="mb-3">Bem-vindo, {{ Auth::user()->name }}!</h5>
                    
                    <div class="mb-3">
                        <a href="{{ route('schedules.create') }}" class="btn btn-primary">
                            Novo Agendamento
                        </a>
                    </div>
                    
                    <h5>Seus próximos agendamentos:</h5>
                    
                    @if(Auth::user()->schedules && count(Auth::user()->schedules) > 0)
                        <ul class="list-group">
                            @foreach(Auth::user()->schedules as $schedule)
                                <li class="list-group-item">
                                    {{ $schedule->title }} - {{ $schedule->date }} às {{ $schedule->time }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Nenhum agendamento encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>