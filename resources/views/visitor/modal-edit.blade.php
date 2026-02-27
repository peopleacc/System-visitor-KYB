<!-- Add Customer Modal -->
<div id="addCustomerModal_edit" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="closeCustomerModal()"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl transform transition-all scale-95 opacity-0"
            id="customerModalContent_edit">
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
                        <h3 class="text-lg font-bold text-gray-800">Tambah Customer</h3>
                        <p class="text-xs text-gray-400">Isi data customer baru</p>
                    </div>
                </div>
                <button onclick="closeCustomerModal_edit()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="#" id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="space-y-1.5">
                    <label class="text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </span>
                        <input type="text" id="edit_id" name="custid" required placeholder="Nama perusahaan" value=""
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 hidden focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </input>
                        <input type="text" id="edit_nama" name="nama" required placeholder="Nama perusahaan" value=""
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200  focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </input>
                    </div>
                </div>

                <!-- Bidang & NPWP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">Bidang</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="text" name="bidang" id="edit_bidang" placeholder="Contoh: Konstruksi"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">NPWP</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </span>
                            <input type="text" name="npwp" id="edit_npwp" placeholder="00.000.000.0-000.000"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                </div>

                <!-- Telepon & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">No. Telepon</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <input type="text" name="notelp" id="edit_notelp" placeholder="08xxxxxxxxxx"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" name="emailid" id="edit_email" placeholder="email@perusahaan.com"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                </div>

                <!-- Lokasi & Alamat -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">Lokasi</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <input type="text" name="lokasi" id="edit_lokasi" placeholder="Contoh: Jakarta"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-gray-700">Alamat</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </span>
                            <input type="text" name="alamat" id="edit_alamat" placeholder="Alamat lengkap"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:outline-none text-sm transition-all">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeCustomerModal_edit()"
                        class="px-5 py-2.5 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl text-sm font-semibold shadow-lg shadow-red-500/25 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCustomerModal_edit(data) {

        const modal = document.getElementById('addCustomerModal_edit');
        const form = document.getElementById('editForm');
        const itemdata = data;
        // console.log(itemData);
        const idInput = document.getElementById('edit_id');
        const nameInput = document.getElementById('edit_nama');
        const bidangInput = document.getElementById('edit_bidang');
        const npwpInput = document.getElementById('edit_npwp');
        const telpInput = document.getElementById('edit_notelp');
        const alamatInput = document.getElementById('edit_alamat');
        const lokasiInput = document.getElementById('edit_lokasi');
        const emailInput = document.getElementById('edit_email');
        // const modal = document.getElementById('addCustomerModal_edit');
        const content = document.getElementById('customerModalContent_edit');

        // Set data ke modal
        idInput.value = itemdata.custid;
        nameInput.value = itemdata.nama;
        bidangInput.value = itemdata.bidang;
        npwpInput.value = itemdata.npwp;
        telpInput.value = itemdata.notelp;
        lokasiInput.value = itemdata.lokasi;
        alamatInput.value = itemdata.alamat;
        emailInput.value = itemdata.emailid;

        modal.classList.remove('hidden');

        // Sesuaikan route

        const text = "{{ route('customer.update', ':id') }}";
        const update = text.replace(':id', itemdata.custid);
        form.action = update;



        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeCustomerModal_edit() {
        const content = document.getElementById('customerModalContent_edit');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            document.getElementById('addCustomerModal_edit').classList.add('hidden');
        }, 200);
    }

    function editModal(item) {
        const itemData = item;

        querySelector('#nama').val()
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeCustomerModal_edit();
    });
</script>