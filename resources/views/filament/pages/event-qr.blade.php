<div class="flex flex-col items-center justify-center p-6 text-center bg-white dark:bg-gray-800 rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">{{ $record->name }}</h2>
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 inline-block">
        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate($record->id) !!}
    </div>
    <p class="mt-6 text-base font-medium text-gray-600 dark:text-gray-300">
        Silakan gunakan menu <b>Self Checkin</b> pada aplikasi untuk memindai kode QR ini.
    </p>
    <div class="mt-8 flex gap-4">
        <button type="button" onclick="window.print()" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold shadow hover:bg-blue-700 transition">
            Cetak QR Code
        </button>
    </div>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .fi-modal-content, .fi-modal-content * {
                visibility: visible;
            }
            .fi-modal-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            button {
                display: none !important;
            }
        }
    </style>
</div>
