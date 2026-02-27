<!-- Edit Visitor Modal -->
<div id="editVisitorModal" class="fixed inset-0 z-50 hidden">
    <!-- Overlay -->
    <div class="absolute inset-0 backdrop-blur-sm" onclick="closeEditModal()"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="editModalContent"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-200 scale-95 opacity-0">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Konfirmasi Visitor</h3>
                    <p class="text-xs text-gray-400">Pastikan data visitor sudah benar</p>
                </div>

                <button onclick="closeEditModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <p class="text-sm text-gray-600 text-center">
                    Apakah Anda yakin ingin menerima visitor berikut?
                </p>

                <div class="bg-gray-50 p-4 rounded-xl text-sm text-gray-700">
                    <p><span class="font-semibold">Nama:</span>
                        <span id="display_name">-</span>
                    </p>
                    <p><span class="font-semibold">No Telp:</span>
                        <span id="display_telp">-</span>
                    </p>
                    <p><span class="font-semibold">Meeting Dengan:</span>
                        <span id="display_usermeet">-</span>
                    </p>
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" id="edit_name" name="name_tamu">
                <input type="hidden" id="edit_telp" name="no_telp">
                <input type="hidden" id="edit_usermeet" name="user_meeting">
                <input type="hidden" id="edit_type" name="type">

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-semibold shadow-md transition">
                        Ya, Terima
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>

    function openEditModal(data) {
        const modal = document.getElementById('editVisitorModal');
        const content = document.getElementById('editModalContent');
        const form = document.getElementById('editForm');

        // Isi tampilan (TEXT)
        document.getElementById('display_name').textContent = data.name;
        document.getElementById('display_telp').textContent = data.no_hp;
        document.getElementById('display_usermeet').textContent = data.user_meeting;

        // Isi hidden input (untuk dikirim ke backend)
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_name').value = data.name;
        document.getElementById('edit_telp').value = data.no_hp;
        document.getElementById('edit_usermeet').value = data.user_meeting;
        document.getElementById('edit_type').value = data.type;

        // Set route
        let routeTemplate = "{{ route('transaction.update', ':id') }}";
        form.action = routeTemplate.replace(':id', data.id);

        modal.classList.remove('hidden');

        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }


    function closeEditModal() {
        const modal = document.getElementById('editVisitorModal');
        const content = document.getElementById('editModalContent');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Close with ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeEditModal();
    });

</script>