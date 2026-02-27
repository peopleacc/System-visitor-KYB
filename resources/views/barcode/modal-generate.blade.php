<!-- Add Customer Modal -->
<div id="addCustomerModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeCustomerModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl transform transition-all scale-95 opacity-0"
            id="customerModalContent">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Generate Barcode</h3>
                        <p class="text-xs text-gray-400">Generate barcode baru</p>
                    </div>
                </div>
                <button onclick="closeCustomerModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('barcode.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <!-- Nama -->
                <!-- No input needed, auto generated -->
                <div class="p-4 bg-blue-50 text-blue-700 rounded-xl text-sm">
                    Barcode akan digenerate secara otomatis oleh sistem.
                </div>


                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeCustomerModal()"
                        class="px-5 py-2.5 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-semibold shadow-lg shadow-red-500/25 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Generate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCustomerModal() {
        const modal = document.getElementById('addCustomerModal');
        const content = document.getElementById('customerModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeCustomerModal() {
        const content = document.getElementById('customerModalContent');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            document.getElementById('addCustomerModal').classList.add('hidden');
        }, 200);
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeCustomerModal();
    });
</script>