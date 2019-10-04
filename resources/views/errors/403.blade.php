@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Error 403 - Unauthorized</h2>
                <h2>{{ $exception->getMessage() }}</h2>
            </div>
        </div>
    </div>
@endsection
