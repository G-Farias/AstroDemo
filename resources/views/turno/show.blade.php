<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Turnos') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('turno.index') }}">{{ __('Ver turnos reservados') }}</x-primary-a>
        </div>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
@if (session('danger'))
    <div class="alert alert-danger">
          {{ session('danger') }}
    </div>
@endif
  @if (session('success'))
    <div class="alert alert-success">
       {{ session('success') }}
    </div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Reservar turnos') }}
                    </h2>
                    <form action="{{ route('turno.index')}}" method="post">  
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                            <input type="date" name="date" id="date" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        </div>

                        <x-success-button >{{ __('Buscar') }}</x-success-button>
                        </form>
                    </div>
                      
                </div>    
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Turnos reservados') }} 
                    </h2>
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
