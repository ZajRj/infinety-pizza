<a href="https://wa.me/584244289888?text={{ urlencode(__('Hola! Me gustaría ordenar una pizza artesanal.')) }}"
    target="_blank" class="fixed bottom-8 left-8 z-[100] group" aria-label="Contact via WhatsApp">

    <!-- Pulse Effect -->
    <div
        class="absolute inset-0 bg-[#25D366] rounded-full blur-xl opacity-20 group-hover:opacity-40 transition-opacity animate-pulse">
    </div>

    <!-- Button Container -->
    <div
        class="relative bg-[#25D366] hover:bg-[#20ba5a] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl shadow-green-500/30 transform hover:scale-110 active:scale-95 transition-all duration-300">
        @svg('fab-whatsapp', ['class' => 'w-8 h-8'])

        <!-- Tooltip/Label  -->
        <span
            class="absolute right-full mr-4 bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-xl opacity-0 group-hover:opacity-100 translate-x-4 group-hover:translate-x-0 transition-all pointer-events-none whitespace-nowrap border border-white/10 backdrop-blur-xl">
            {{ __('Chat with us') }}
        </span>
    </div>
</a>