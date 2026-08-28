<div x-data="{ 
    search: '',
    matches(name, order, gate) {
        if (!this.search || this.search.trim() === '') return true;
        const q = this.search.toLowerCase().trim();
        return (name && name.toLowerCase().includes(q)) || 
               (order && order.toLowerCase().includes(q)) ||
               (gate && gate.toLowerCase().includes(q));
    }
}" class="space-y-4">
    <style>
        .regis-modal-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            text-align: left;
        }
        .regis-modal-table th {
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            background-color: #f9fafb;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
        }
        .dark .regis-modal-table th {
            background-color: #1f2937;
            color: #9ca3af;
            border-bottom-color: #374151;
        }
        .regis-modal-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            color: #1f2937;
        }
        .dark .regis-modal-table td {
            border-bottom-color: #1f2937;
            color: #f3f4f6;
        }
        .regis-modal-table tr:hover td {
            background-color: #f9fafb;
        }
        .dark .regis-modal-table tr:hover td {
            background-color: #111827;
        }
        .badge-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-blue {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }
        .dark .badge-blue {
            background-color: rgba(37, 99, 235, 0.2);
            color: #93c5fd;
            border-color: rgba(59, 130, 246, 0.3);
        }
        .badge-green {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        .dark .badge-green {
            background-color: rgba(22, 163, 74, 0.2);
            color: #86efac;
            border-color: rgba(34, 197, 94, 0.3);
        }
        .search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            font-size: 0.875rem;
            color: #111827;
            outline: none;
            transition: all 0.2s;
        }
        .dark .search-input {
            background-color: #1f2937;
            border-color: #374151;
            color: #f9fafb;
        }
        .search-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
    </style>

    <!-- Header Stats -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(156, 163, 175, 0.2);">
        <div>
            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af; font-weight: 700;">Event</span>
            <h3 style="font-size: 1.125rem; font-weight: 700; margin: 0;">{{ $event->name }}</h3>
        </div>
        <div>
            <span class="badge-pill badge-green" style="font-size: 0.875rem; padding: 0.375rem 0.875rem;">
                <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Total: {{ $regisUlangs->count() }} Peserta
            </span>
        </div>
    </div>

    @if ($regisUlangs->isNotEmpty())
        <!-- Live Search Bar -->
        <div style="position: relative;">
            <svg style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 1.125rem; height: 1.125rem; color: #9ca3af; pointer-events: none;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input 
                type="text" 
                x-model="search" 
                placeholder="Cari nama peserta, ID order, atau gate..." 
                class="search-input"
            />
        </div>

        <!-- Participants Table -->
        <div style="overflow-x: auto; border: 1px solid rgba(156, 163, 175, 0.2); border-radius: 0.75rem; max-height: 420px; overflow-y: auto;">
            <table class="regis-modal-table">
                <thead style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Nama Peserta</th>
                        <th>ID Order</th>
                        <th>Gate</th>
                        <th>Tanggal Registrasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regisUlangs as $index => $item)
                        @php
                            $namaPeserta = $item->order?->peserta?->user?->name ?? $item->order?->peserta?->name_on_certificate ?? 'Peserta';
                            $idOrder = $item->order?->order_code ?? $item->order_id ?? '-';
                            $gateNama = $item->gate?->nama ?? '-';
                            $tglRegis = $item->waktu ? \Carbon\Carbon::parse($item->waktu)->translatedFormat('d F Y, H:i') : ($item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') : '-');
                        @endphp
                        <tr x-show="matches('{{ addslashes($namaPeserta) }}', '{{ addslashes($idOrder) }}', '{{ addslashes($gateNama) }}')">
                            <td style="text-align: center; color: #9ca3af; font-weight: 500;">
                                {{ $index + 1 }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <div style="width: 2rem; height: 2rem; border-radius: 9999px; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; flex-shrink: 0;">
                                        {{ strtoupper(substr($namaPeserta, 0, 1)) }}
                                    </div>
                                    <span style="font-weight: 600;">{{ $namaPeserta }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-pill badge-blue" style="font-family: monospace; letter-spacing: 0.05em;">
                                    {{ $idOrder }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-pill badge-green">
                                    {{ $gateNama }}
                                </span>
                            </td>
                            <td style="white-space: nowrap; font-size: 0.8125rem; color: #6b7280;">
                                <div style="display: flex; align-items: center; gap: 0.375rem;">
                                    <svg style="width: 0.875rem; height: 0.875rem; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $tglRegis }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 3rem 1rem; color: #9ca3af;">
            <svg style="width: 3.5rem; height: 3.5rem; margin: 0 auto 0.75rem auto; color: #d1d5db;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <p style="font-weight: 600; font-size: 0.9375rem; color: #6b7280;">Belum Ada Registrasi Ulang</p>
            <p style="font-size: 0.8125rem; margin-top: 0.25rem;">Belum ada peserta yang melakukan scan atau registrasi ulang pada event ini.</p>
        </div>
    @endif
</div>
