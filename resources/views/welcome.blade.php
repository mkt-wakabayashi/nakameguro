@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dashboard of Nakameguro Project</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <img class="card-img-bottom" src="{{ url('storage/images/dashboard.jpg') }}" alt="Card image cap">
            </div>
        </div>
    </div>
</div>
@endsection