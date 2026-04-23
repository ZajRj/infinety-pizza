@extends('layouts.app')

@section('content')
    <!-- Hero & Featured -->
    @include('pages.home.parts.hero')

    <!-- Full Menu -->
    <livewire:home.menu />

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
            const sections = document.querySelectorAll('#hero, #menu, #about, #locations');
            const navLinks = document.querySelectorAll('nav a[href*="#"]');

            // Exact classes from the previous consistent design
            const activeClasses = ['text-brand-primary', 'border-brand-primary'];
            const inactiveClasses = ['text-gray-500', 'border-transparent'];

            function setActiveLink(id) {
                navLinks.forEach(link => {
                    const dataLink = link.getAttribute('data-nav-link');
                    const isCurrent = dataLink === id;
                    
                    if (isCurrent) {
                        link.classList.add(...activeClasses);
                        link.classList.remove(...inactiveClasses);
                        link.classList.remove('hover:text-gray-900');
                    } else {
                        link.classList.remove(...activeClasses);
                        link.classList.add(...inactiveClasses);
                        link.classList.add('hover:text-gray-900');
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

            // Fallback for the top of the page
            window.addEventListener('scroll', () => {
                if (window.scrollY < 100) {
                    setActiveLink('hero');
                }
            });

            // Smooth scrolling for navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // If the link is just a hash (or points to the current page + hash)
                    if (href.includes('#')) {
                        const targetId = href.split('#')[1];
                        const targetElement = document.getElementById(targetId);
                        
                        if (targetElement) {
                            e.preventDefault();
                            const offset = 80;
                            const elementPosition = targetElement.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - offset;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
