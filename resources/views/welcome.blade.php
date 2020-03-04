@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home Page</div>
                    @include('includes.error')
                    @include('includes.success')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
