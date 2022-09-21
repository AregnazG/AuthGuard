<?php
use Illuminate\Support\Facades\Auth;

    ?>
@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        You are Logged In
                        <h1>Welcome {{ 'username' }} !</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
