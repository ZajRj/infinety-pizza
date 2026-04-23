<section id="locations" class="py-24 bg-white relative overflow-hidden">
    <!-- LARGE DECORATIVE GLOBS -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-secondary/5 rounded-full blur-[130px]"></div>
    
    <!-- Accent Dots -->
    <div class="absolute top-1/4 left-10 w-3 h-3 bg-primary/20 rounded-full animate-pulse"></div>
    <div class="absolute bottom-1/4 right-20 w-4 h-4 border-2 border-secondary/20 rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            
            <!-- Left: Info -->
            <div class="lg:w-1/3 relative">
                <!-- Sidebar Blob -->
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>

                <h2 class="relative z-10 text-4xl md:text-5xl font-black text-gray-900 mb-6 font-heading uppercase tracking-tighter leading-none">
                    {{ __('Find us in') }} <br>
                    <span class="text-primary italic">{{ __('Madrid') }}</span>
                </h2>
                <p class="relative z-10 text-gray-500 mb-10 text-lg leading-relaxed font-medium">
                    {{ __('We have 3 artisanal kitchens spread across the heart of the city. Order for pickup or visit us for the full experience.') }}
                </p>

                <div class="space-y-6 relative z-10">
                    <div class="flex gap-4 p-5 rounded-3xl bg-brand-neutral/50 backdrop-blur-sm border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-primary/10 p-3 rounded-2xl text-primary">
                            @svg('fas-map-marker-alt', ['class' => 'w-6 h-6'])
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 uppercase text-sm">Puerta del Sol</h4>
                            <p class="text-gray-500 text-xs uppercase font-medium">Calle Mayor, 1, 28013 Madrid</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-5 rounded-3xl bg-white/80 backdrop-blur-sm border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="bg-gray-100 p-3 rounded-2xl text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                            @svg('fas-map-marker-alt', ['class' => 'w-6 h-6'])
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 uppercase text-sm">Malasaña Central</h4>
                            <p class="text-gray-500 text-xs uppercase font-medium">Calle de la Palma, 12, 28004 Madrid</p>
                        </div>
                    </div>

                    <div class="flex gap-4 p-5 rounded-3xl bg-white/80 backdrop-blur-sm border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="bg-gray-100 p-3 rounded-2xl text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                            @svg('fas-map-marker-alt', ['class' => 'w-6 h-6'])
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 uppercase text-sm">Retiro Park Side</h4>
                            <p class="text-gray-500 text-xs uppercase font-medium">Calle de Alfonso XII, 28, 28014 Madrid</p>
                        </div>
                    </div>
                </div>

              
            </div>

            <!-- Right: Map -->
            <div class="lg:w-2/3 w-full h-[500px] rounded-[40px] overflow-hidden border-8 border-white shadow-2xl shadow-red-900/5 relative group">
                <!-- Map Blob Decor -->
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-1000"></div>
                
                <div id="map" class="w-full h-full bg-gray-100 relative z-10"></div>
                
                <!-- Map Overlay Decoration -->
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-6 py-2 rounded-full border border-white/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest z-[1000] shadow-sm">
                    {{ __('Infinety Pizza Interactive Map') }}
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Leaflet.js Assets -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map centered in Madrid
        var map = L.map('map', {
            scrollWheelZoom: false
        }).setView([40.4168, -3.7038], 13);

        // Add a clean, minimal tile layer (Positron by CartoDB)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO'
        }).addTo(map);

        // Custom Marker Icon
        var pizzaIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color:#D32F2F; width:12px; height:12px; border-radius:50%; border:3px solid white; box-shadow: 0 0 10px rgba(211,47,47,0.5);'></div>",
            iconSize: [12, 12],
            iconAnchor: [6, 6]
        });

        // Add Locations
        var locations = [
            { name: "Sol", coords: [40.4168, -3.7038] },
            { name: "Malasaña", coords: [40.4248, -3.7042] },
            { name: "Retiro", coords: [40.4153, -3.6839] },
        ];

        locations.forEach(function(loc) {
            L.marker(loc.coords, {icon: pizzaIcon})
                .addTo(map)
                .bindPopup("<b style='font-family:Epilogue; font-weight:800; text-transform:uppercase;'>" + loc.name + "</b><br><span style='color:#D32F2F; font-weight:bold;'>Infinety Pizza Kitchen</span>");
        });
    });
</script>
