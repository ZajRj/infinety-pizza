@extends('layouts.app')

@section('content')
    <!-- Hero & Featured -->
    @include('pages.home.parts.hero')

    <!-- Full Menu -->
    @include('pages.home.parts.menu')

    <!-- Brand Story -->
    @include('pages.home.parts.about')

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select links inside the navigation that point to local IDs
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            const sections = document.querySelectorAll('#hero, #menu, #locations, #specials, #about');

            // The classes you are using for Active and Inactive states
            const activeClasses = ['text-brand-primary', 'border-brand-primary'];
            const inactiveClasses = ['text-gray-500', 'border-transparent'];

            function setActiveLink(id) {
                navLinks.forEach(link => {
                    const href = link.getAttribute('href').substring(1);
                    const isCurrent = href === id;
                    
                    if (isCurrent) {
                        link.classList.add(...activeClasses);
                        link.classList.remove(...inactiveClasses);
                    } else {
                        link.classList.remove(...activeClasses);
                        link.classList.add(...inactiveClasses);
                    }
                });
            }

            // Scroll Spy using Intersection Observer
            const observerOptions = {
                root: null,
                rootMargin: '-10% 0px -80% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setActiveLink(entry.target.getAttribute('id'));
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                if (section) observer.observe(section);
            });

            // Smooth scrolling for navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        const offset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - offset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection
