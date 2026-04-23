@extends('layouts.app')

@section('content')
    <!-- Hero & Featured -->
    @include('pages.home.parts.hero')

    <!-- Full Menu -->
    @include('pages.home.parts.menu')

    <!-- Map & Locations -->
    @include('pages.home.parts.locations')

    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
@endsection
