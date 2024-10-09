@extends('layouts.dashboard')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Aggiungi Nuovo Progetto</h2>
            </div>
        </div>
        <div class="col-12">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Progetto</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Inserisci il nome del progetto" required>
                </div>

                <div class="mb-3">
                    <label for="summary" class="form-label">Sommario</label>
                    <textarea class="form-control" id="summary" name="summary" rows="4"
                        placeholder="Inserisci una descrizione breve del progetto"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Salva Progetto</button>
            </form>
        </div>
    </div>
@endsection