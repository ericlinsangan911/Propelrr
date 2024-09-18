@extends('layouts.app')

@section('title', 'Contructor Class')

@section('content')
    <h1>Contructor Class</h1>
    <form action="{{ route('exam.sort') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ids">Enter IDs (comma separated):</label>
            <input type="text" id="ids" name="ids" class="form-control" placeholder="1,2,3,4">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
    @if (isset($sortedIds))
        <div class="mt-4">
            <h2>Result:</h2>
            @foreach($sortedIds as $id)
                <p>{{ $id }}</p>
            @endforeach
        </div>
    @endif
@endsection
