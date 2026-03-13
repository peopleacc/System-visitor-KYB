<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visitor Disetujui</title>
</head>

<body style="font-family: 'Segoe UI', Arial, sans-serif; color: #333; margin: 0; padding: 20px 0; background-color: #f0f2f5;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e0e0e0;">

        <!-- Header -->
        <div style="background: #b91c1c; padding: 40px 32px 32px; text-align: center;">

            <!-- Logo -->
            <div style="display: inline-block; background: #ffffff; border-radius: 10px; padding: 10px 22px; margin-bottom: 20px;">
                @if(!empty($logoBase64))
                    <img src="{{ $logoBase64 }}" alt="Kayaba Logo" style="height: 36px; display: block; margin: 0 auto;" />
                @else
                    <span style="font-size: 15px; font-weight: 700; color: #b91c1c; letter-spacing: 1px;">KAYABA</span>
                @endif
            </div>

            <!-- Badge -->
            <div style="display: block; margin-bottom: 16px;">
                <span style="display: inline-block; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 999px; padding: 5px 16px; color: #ffffff; font-size: 11px; font-weight: 600; letter-spacing: 1px;">KUNJUNGAN DISETUJUI</span>
            </div>

            <h2 style="color: #ffffff; margin: 0 0 6px; font-size: 22px; font-weight: 600;">Selamat Datang</h2>
            <p style="color: rgba(255,255,255,0.75); margin: 0; font-size: 13px;">Kunjungan Anda telah dikonfirmasi</p>
        </div>

        <!-- Greeting -->
        <div style="padding: 28px 32px 0;">
            <p style="font-size: 15px; margin: 0 0 6px; color: #111827;">
                Halo, <strong>{{ $visitor->name ?? ($visitor['name'] ?? 'Pengunjung') }}</strong>
            </p>
            <p style="font-size: 13px; color: #6b7280; margin: 0; line-height: 1.6;">
                Berikut adalah detail kunjungan Anda. Harap tunjukkan kode QR ini kepada petugas saat tiba.
            </p>
        </div>

        <!-- Detail Card — 2-column grid -->
        <div style="padding: 20px 32px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; border-collapse: separate; border-spacing: 0;">
                <!-- Row 1 -->
                <tr>
                    <td width="50%" style="padding: 16px 20px; border-bottom: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; vertical-align: top;">
                        <p style="margin: 0 0 4px; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600;">Nama</p>
                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->name ?? ($visitor['name'] ?? '-') }}</p>
                    </td>
                    <td width="50%" style="padding: 16px 20px; border-bottom: 1px solid #e5e7eb; vertical-align: top;">
                        <p style="margin: 0 0 4px; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600;">No. HP</p>
                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->no_hp ?? ($visitor['no_hp'] ?? '-') }}</p>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr>
                    <td width="50%" style="padding: 16px 20px; border-right: 1px solid #e5e7eb; vertical-align: top;">
                        <p style="margin: 0 0 4px; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600;">Tanggal Kunjungan</p>
                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->date ?? ($visitor['date'] ?? '-') }}</p>
                    </td>
                    <td width="50%" style="padding: 16px 20px; vertical-align: top;">
                        <p style="margin: 0 0 4px; font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.6px; font-weight: 600;">Tujuan</p>
                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">{{ $visitor->purpose ?? ($visitor['purpose'] ?? '-') }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- QR / Barcode Section -->
        <div style="padding: 0 32px 32px;">
            @if(!empty($codeValue))
                <div style="background: #f9fafb; border: 1px solid #d1fae5; border-radius: 12px; padding: 28px 24px; text-align: center;">
                    <p style="margin: 0 0 4px; font-size: 11px; font-weight: 600; color: #059669; text-transform: uppercase; letter-spacing: 0.8px;">Kode Akses Anda</p>
                    <p style="margin: 0 0 20px; font-size: 13px; color: #9ca3af;">Tunjukkan QR code ini kepada petugas saat tiba</p>

                    @if(!empty($qrImageUrl))
                        <div style="display: inline-block; background: #ffffff; padding: 14px; border-radius: 10px; border: 1px solid #e5e7eb; margin-bottom: 20px;">
                            <img src="{{ $qrImageUrl }}" alt="QR Code {{ $codeValue }}" width="160" height="160" style="display: block;" />
                        </div>
                    @endif

                    <!-- Code pill -->
                    <div>
                        <div style="display: inline-block; background: #ffffff; border: 2px dashed #10b981; border-radius: 8px; padding: 10px 32px;">
                            <p style="margin: 0; font-size: 26px; font-weight: 700; color: #b91c1c; letter-spacing: 8px; font-family: 'Courier New', monospace;">{{ $codeValue }}</p>
                        </div>
                        <p style="margin: 10px 0 0; font-size: 12px; color: #9ca3af;">Kode bersifat rahasia, jangan bagikan ke orang lain</p>
                    </div>
                </div>
            @else
                <div style="background: #fffbeb; border: 1px solid #fcd34d; border-radius: 12px; padding: 18px; text-align: center;">
                    <p style="margin: 0; font-size: 14px; color: #92400e;">Tidak ada barcode tersedia untuk kunjungan ini.</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 18px 32px; text-align: center;">
            <p style="margin: 0 0 3px; font-size: 13px; font-weight: 600; color: #374151;">PT Kayaba Indonesia</p>
            <p style="margin: 0; font-size: 12px; color: #9ca3af;">Email ini dikirim otomatis, mohon tidak membalas pesan ini.</p>
        </div>

    </div>

</body>

</html>