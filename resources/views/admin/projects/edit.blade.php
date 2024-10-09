@extends('layouts.dashboard')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Modifica Progetto</h2>
            </div>
        </div>
        <div class="row mt-3">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-12">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nome Progetto</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $project->name }}" required>
                    </div>
                    <div class="form-group mt-3">
                        @if (Str::startsWith($project->project_image, 'https'))
                            <img class="project_image" src="{{ $project->project_image }}"
                                alt="{{ $project->project_image }}">
                        @else
                            <img class="project_image" src="{{ asset('./storage/' . $project->project_image) }}"
                                alt="{{ $project->name }}">
                        @endif
                        <br>
                        <label for="project_image">Immagine Progetto</label>
                        <input type="file" class="form-control" id="project_image" name="project_image">
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
