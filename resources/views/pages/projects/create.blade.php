@extends('layouts.app')

@section('title', 'Projects | Create')

@section('content')

<main class="container mt-5">

    <h2>Add a new project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label for="img" class="form-label">Image</label>
          <input name="img" type="file" class="form-control" id="img">
        </div>

        <div class="mb-3">
            <label for="software" class="form-label">Softwares</label>
            <input name="software" type="text" class="form-control" id="software">
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
      </form>
</main>

@endsection