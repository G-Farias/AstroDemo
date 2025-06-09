<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes pendientes a ser almacenados en sistema') }}
                </h2>
            </div>        
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
  @if (session('success'))
    <div class="alert alert-success">
       {{ session('success') }}
    </div>
  @endif
  @if (session('danger'))
  <div class="alert alert-danger">
        {{ session('danger') }}
  </div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-1 mb-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                    <div class="p-4 text-gray-900 row">
                        <div class="col font-semibold text-gray-800 leading-tight">
                            <p>Pacientes pendientes a ser almacenados en sistema: {{$q_patients}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class=" text-gray-900">
                @foreach ($prePatients as $prepatient)
                <div class="card border-light">
                   
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre/s y apellido/s : </strong> {{ucfirst($prepatient->name) }} {{ ucfirst($prepatient->surname) }}</p>
                      <p class="card-text"><strong>D.N.I / Pasaporte : </strong> {{ $prepatient->user }}</p> 
                      <p class="card-text"><strong>Email : </strong>{{$prepatient->email}}</p>

                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-third-a href="{{ route('pacientes.pendiente_save',$prepatient->user) }}">{{__('Almacenar')}}</x-third-a>
                      </div>
                    </div>
                 </div>
                 @endforeach

                </div>
            </div>
            <div class="py-3">
                {{$prePatients->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
