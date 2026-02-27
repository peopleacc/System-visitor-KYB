{{-- Detail Modal Component - Premium Design --}}
<div id="detailModal" class="fixed inset-0 z-50 hidden" style="font-family: 'Inter', sans-serif;">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300"
        onclick="closeDetailModal()"></div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="detailModalContent"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl transform transition-all duration-300 scale-95 opacity-0"
            style="box-shadow: 0 25px 60px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0,0,0,0.03);">

            {{-- Header with gradient accent --}}
            <div class="relative overflow-hidden rounded-t-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600"></div>
                <div
                    class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48Y2lyY2xlIGN4PSIyMCIgY3k9IjIwIiByPSIxIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiLz48L3N2Zz4=')] opacity-50">
                </div>
                <div class="relative flex items-center justify-between p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <span id="detailModalIcon" class="material-icons-outlined text-white text-xl">info</span>
                        </div>
                        <div>
                            <h3 id="detailModalTitle" class="text-lg font-bold text-white">Detail</h3>
                            <p class="text-xs text-blue-100/80">Informasi lengkap data</p>
                        </div>
                    </div>
                    <button onclick="closeDetailModal()"
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/15 text-white/80 hover:bg-white/25 hover:text-white transition-all duration-200">
                        <span class="material-icons-outlined text-lg">close</span>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div id="detailModalBody" class="p-5 max-h-[55vh] overflow-y-auto"
                style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                {{-- Dynamic content will be inserted here --}}
            </div>

            {{-- Footer --}}
            <div id="detailModalFooter"
                class="flex items-center justify-end gap-3 px-5 py-4 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
                <button onclick="closeDetailModal()"
                    class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    #detailModalBody::-webkit-scrollbar {
        width: 5px;
    }

    #detailModalBody::-webkit-scrollbar-track {
        background: transparent;
    }

    #detailModalBody::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    #detailModalBody::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .detail-field-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 12px;
        transition: background-color 0.15s ease;
    }

    .detail-field-row:hover {
        background-color: #f1f5f9;
    }

    .detail-icon-wrap {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-field-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        margin-bottom: 2px;
    }

    .detail-field-value {
        font-size: 14px;
        font-weight: 500;
        color: #1f2937;
        word-break: break-word;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge-waiting {
        background: #fef3c7;
        color: #d97706;
    }

    .status-badge-approved {
        background: #d1fae5;
        color: #059669;
    }

    .status-badge-default {
        background: #f1f5f9;
        color: #64748b;
    }
</style>

<script>
    const iconColors = [
        { bg: '#eff6ff', text: '#3b82f6' },
        { bg: '#f0fdf4', text: '#22c55e' },
        { bg: '#fefce8', text: '#eab308' },
        { bg: '#fdf2f8', text: '#ec4899' },
        { bg: '#f5f3ff', text: '#8b5cf6' },
        { bg: '#ecfeff', text: '#06b6d4' },
        { bg: '#fff7ed', text: '#f97316' },
        { bg: '#fef2f2', text: '#ef4444' },
    ];

    function getStatusBadge(value) {
        const lower = (value || '').toLowerCase();
        if (lower === 'waiting') {
            return `<span class="status-badge status-badge-waiting"><span class="material-icons-outlined" style="font-size:14px;">schedule</span>${value}</span>`;
        } else if (lower === 'approved') {
            return `<span class="status-badge status-badge-approved"><span class="material-icons-outlined" style="font-size:14px;">check_circle</span>${value}</span>`;
        }
        return `<span class="status-badge status-badge-default">${value || '-'}</span>`;
    }

    function openDetailModal(title, fields, options = {}) {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('detailModalContent');
        const body = document.getElementById('detailModalBody');
        const modalTitle = document.getElementById('detailModalTitle');
        const modalIcon = document.getElementById('detailModalIcon');
        const footer = document.getElementById('detailModalFooter');

        modalTitle.textContent = title;
        if (options.icon) modalIcon.textContent = options.icon;

        // Build detail rows
        let html = '<div style="display:flex;flex-direction:column;gap:2px;">';
        fields.forEach(function (field, index) {
            const color = iconColors[index % iconColors.length];
            const isStatus = (field.label || '').toLowerCase() === 'status';
            const displayValue = isStatus ? getStatusBadge(field.value) : (field.value || '<span style="color:#cbd5e1;">—</span>');

            html += `
                <div class="detail-field-row">
                    <div class="detail-icon-wrap" style="background:${color.bg};">
                        <span class="material-icons-outlined" style="font-size:18px;color:${color.text};">${field.icon || 'info'}</span>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="detail-field-label">${field.label}</div>
                        <div class="detail-field-value">${displayValue}</div>
                    </div>
                </div>`;
        });
        html += '</div>';
        body.innerHTML = html;

        // Set footer with optional action buttons
        let footerHtml = '';
        if (options.actions) {
            footerHtml = options.actions;
        } else {
            footerHtml = `
                <button onclick="closeDetailModal()"
                    class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm">
                    Tutup
                </button>`;
        }
        footer.innerHTML = footerHtml;

        modal.classList.remove('hidden');
        // Force reflow
        content.offsetHeight;
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        const content = document.getElementById('detailModalContent');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 250);
    }

    // Close with ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDetailModal();
    });
</script>