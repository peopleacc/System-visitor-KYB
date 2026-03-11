<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visitor Disetujui</title>
</head>

<body style="font-family: 'Segoe UI', Arial, sans-serif; color: #333; margin: 0; padding: 20px 0; background-color: #f0f2f5;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">

        <!-- Header -->
        <div style="background: linear-gradient(135deg, #b91c1c 0%, #ef4444 60%, #f97316 100%); padding: 36px 24px 28px; text-align: center; position: relative;">
            <!-- Logo centered -->
            <div style="display: inline-block; background: #ffffff; border-radius: 12px; padding: 12px 24px; margin-bottom: 18px; box-shadow: 0 2px 12px rgba(0,0,0,0.15);">
                <img src="{{ asset('image/kayaba-logo.png') }}" alt="Kayaba Logo"
                    style="height: 40px; display: block; margin: 0 auto;" />
            </div>

            <!-- Badge -->
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.35); border-radius: 999px; padding: 6px 18px; margin-bottom: 12px;">
                <span style="display: inline-block; width: 8px; height: 8px; background: #4ade80; border-radius: 50%;"></span>
                <span style="color: #ffffff; font-size: 12px; font-weight: 600; letter-spacing: 0.5px;">KUNJUNGAN DISETUJUI</span>
            </div>

            <h2 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: -0.3px;">Selamat Datang!</h2>
            <p style="color: rgba(255,255,255,0.80); margin: 6px 0 0; font-size: 14px;">Kunjungan Anda telah dikonfirmasi</p>
        </div>

        <!-- Greeting -->
        <div style="padding: 28px 28px 0;">
            <p style="font-size: 16px; margin: 0 0 6px;">Halo, <strong>{{ $visitor->name ?? ($visitor['name'] ?? 'Pengunjung') }}</strong> 👋</p>
            <p style="font-size: 14px; color: #6b7280; margin: 0;">Berikut adalah detail kunjungan Anda. Harap tunjukkan kode QR ini kepada petugas saat tiba.</p>
        </div>

        <!-- Detail Card -->
        <div style="padding: 20px 28px;">
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden;">
                
                <div style="padding: 0 16px;">
                    <!-- Row -->
                    <div style="display: flex; align-items: center; padding: 13px 0; border-bottom: 1px solid #e5e7eb;">
                        <div style="width: 36px; height: 36px; background: #fee2e2; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 14px; flex-shrink: 0;">
                            <span style="font-size: 16px;">👤</span>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Nama</p>
                            <p style="margin: 2px 0 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->name ?? ($visitor['name'] ?? '-') }}</p>
                        </div>
                    </div>

                    <!-- Row -->
                    <div style="display: flex; align-items: center; padding: 13px 0; border-bottom: 1px solid #e5e7eb;">
                        <div style="width: 36px; height: 36px; background: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 14px; flex-shrink: 0;">
                            <span style="font-size: 16px;">📱</span>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">No. HP</p>
                            <p style="margin: 2px 0 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->no_hp ?? ($visitor['no_hp'] ?? '-') }}</p>
                        </div>
                    </div>

                    <!-- Row -->
                    <div style="display: flex; align-items: center; padding: 13px 0; border-bottom: 1px solid #e5e7eb;">
                        <div style="width: 36px; height: 36px; background: #d1fae5; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 14px; flex-shrink: 0;">
                            <span style="font-size: 16px;">📅</span>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Tanggal Kunjungan</p>
                            <p style="margin: 2px 0 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->date ?? ($visitor['date'] ?? '-') }}</p>
                        </div>
                    </div>

                    <!-- Row -->
                    <div style="display: flex; align-items: center; padding: 13px 0;">
                        <div style="width: 36px; height: 36px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 14px; flex-shrink: 0;">
                            <span style="font-size: 16px;">🎯</span>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Tujuan</p>
                            <p style="margin: 2px 0 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->purpose ?? ($visitor['purpose'] ?? '-') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR / Barcode Section -->
        <div style="padding: 0 28px 28px;">
            @if(!empty($codeValue))
                <div style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border: 2px solid #bbf7d0; border-radius: 16px; padding: 28px 20px; text-align: center;">
                    <p style="margin: 0 0 6px; font-size: 13px; font-weight: 600; color: #16a34a; text-transform: uppercase; letter-spacing: 0.5px;">Kode Akses Anda</p>
                    <p style="margin: 0 0 20px; font-size: 13px; color: #6b7280;">Tunjukkan QR code ini kepada petugas saat tiba</p>

                    @if(!empty($qrImageUrl))
                        <div style="display: inline-block; background: #ffffff; padding: 16px; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: 1px solid #e5e7eb; margin-bottom: 20px;">
                            <img src="{{ $qrImageUrl }}" alt="QR Code {{ $codeValue }}" width="180" height="180" style="display: block;" />
                        </div>
                    @endif

                    <!-- Code pill -->
                    <div style="display: inline-block; background: #ffffff; border: 2px dashed #16a34a; border-radius: 10px; padding: 10px 28px;">
                        <p style="margin: 0; font-size: 30px; font-weight: 800; color: #b91c1c; letter-spacing: 6px; font-family: 'Courier New', monospace;">{{ $codeValue }}</p>
                    </div>
                    <p style="margin: 12px 0 0; font-size: 12px; color: #9ca3af;">Kode bersifat rahasia, jangan bagikan ke orang lain</p>
                </div>
            @else
                <div style="background: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px; padding: 18px; text-align: center;">
                    <p style="margin: 0; font-size: 14px; color: #92400e;">⚠️ Tidak ada barcode tersedia untuk kunjungan ini.</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div style="background: #f9fafb; border-top: 1px solid #f0f0f0; padding: 20px 28px; text-align: center;">
            <p style="margin: 0 0 4px; font-size: 13px; font-weight: 600; color: #374151;">PT Kayaba Indonesia</p>
            <p style="margin: 0; font-size: 12px; color: #9ca3af;">Email ini dikirim otomatis, mohon tidak membalas pesan ini.</p>
        </div>

    </div>

</body>
</html>