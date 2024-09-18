@extends('layouts.app')

@section('title', 'Fibonacci')

@section('content')
<h1>Fibonacci</h1>
<form action="{{ route('fibonacci.calculate') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="position">Enter position (1-20):</label>
        <input type="number" id="position" name="position" class="form-control" min="1" max="20" value="{{ old('position', $position) }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Calculate</button>
</form>

    @if (isset($fibonacciNumber))
        <div class="mt-4">
            <h2>Result:</h2>
            <p>{{ $fibonacciNumber }}</p>
        </div>
    @endif
@endsection
