<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visitor Disetujui</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; color: #333; margin: 0; padding: 0; background-color: #f4f4f4;">
    <div
        style="max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #c0392b, #e74c3c); padding: 24px; text-align: center;">
            <h2 style="color: #ffffff; margin: 0; font-size: 22px;">Pengunjung Disetujui</h2>
        </div>

        <!-- Body -->
        <div style="padding: 24px;">
            <p style="font-size: 16px;">Halo
                <strong>{{ $visitor->name ?? ($visitor['name'] ?? 'Pengunjung') }}</strong>,</p>

            <p>Kunjungan Anda telah <strong style="color: #27ae60;">disetujui</strong>. Berikut detail kunjungan:</p>

            <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
                <tr>
                    <td
                        style="padding: 10px 12px; background: #f9f9f9; border: 1px solid #eee; font-weight: bold; width: 35%;">
                        Nama</td>
                    <td style="padding: 10px 12px; border: 1px solid #eee;">
                        {{ $visitor->name ?? ($visitor['name'] ?? '-') }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 12px; background: #f9f9f9; border: 1px solid #eee; font-weight: bold;">No
                        HP</td>
                    <td style="padding: 10px 12px; border: 1px solid #eee;">
                        {{ $visitor->no_hp ?? ($visitor['no_hp'] ?? '-') }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 12px; background: #f9f9f9; border: 1px solid #eee; font-weight: bold;">
                        Tanggal</td>
                    <td style="padding: 10px 12px; border: 1px solid #eee;">
                        {{ $visitor->date ?? ($visitor['date'] ?? '-') }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 12px; background: #f9f9f9; border: 1px solid #eee; font-weight: bold;">
                        Tujuan</td>
                    <td style="padding: 10px 12px; border: 1px solid #eee;">
                        {{ $visitor->purpose ?? ($visitor['purpose'] ?? '-') }}</td>
                </tr>
            </table>

            @if(!empty($codeValue))
                <div
                    style="background: #f0faf0; border: 2px solid #27ae60; border-radius: 8px; padding: 20px; text-align: center; margin: 16px 0;">
                    <p style="margin: 0 0 12px 0; font-size: 14px; color: #555;">Gunakan kode/QR berikut saat datang:</p>

                    @if(!empty($qrImageUrl))
                        <div
                            style="display: inline-block; background: #fff; padding: 12px; border-radius: 8px; border: 1px solid #ddd;">
                            <img src="{{ $qrImageUrl }}" alt="QR Code {{ $codeValue }}" width="200" height="200"
                                style="display: block;" />
                        </div>
                    @endif

                    <p style="margin: 16px 0 0 0; font-size: 28px; font-weight: bold; color: #c0392b; letter-spacing: 4px;">
                        {{ $codeValue }}</p>
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #999;">Tunjukkan kode ini kepada petugas</p>
                </div>
            @else
                <div
                    style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 16px; text-align: center; margin: 16px 0;">
                    <p style="margin: 0; color: #856404;">Tidak ada barcode tersedia untuk kunjungan ini.</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div style="background: #f8f8f8; padding: 16px; text-align: center; border-top: 1px solid #eee;">
            <p style="margin: 0; font-size: 13px; color: #999;">Terima kasih atas kunjungan Anda.</p>
        </div>
    </div>
</body>

</html>