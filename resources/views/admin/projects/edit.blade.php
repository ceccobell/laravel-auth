@extends('layouts.dashboard')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Modifica Progetto</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nome Progetto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}"
                            required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ $project->slug }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="summary">Riassunto</label>
                        <textarea class="form-control" id="summary" name="summary" rows="3">{{ $project->summary }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning mt-3">Aggiorna Progetto</button>
                </form>
            </div>
        </div>
    </div>
@endsection
