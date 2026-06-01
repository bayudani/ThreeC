<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Progres Ormawa</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #333; }
        h1 { text-align: center; font-size: 16px; margin-bottom: 5px; }
        .subtitle { text-align: center; font-size: 11px; color: #666; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #ddd; padding: 4px 6px; text-align: left; }
        th { background: #2563eb; color: white; font-size: 9px; }
        td { font-size: 9px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .summary { margin-bottom: 15px; }
        .summary td { border: none; font-size: 10px; padding: 2px 10px; }
        .summary td:first-child { font-weight: bold; width: 200px; }
        .badge-selesai { color: #16a34a; }
        .badge-berjalan { color: #ca8a04; }
        .badge-belum { color: #dc2626; }
        .footer { text-align: center; font-size: 8px; color: #999; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 8px; }
    </style>
</head>
<body>
    <h1>LAPORAN PROGRES ORMAWA</h1>
    <div class="subtitle">{{ $periode ? "Periode: $periode" : 'Semua Periode' }}</div>

    <table class="summary">
        <tr><td>Total Ormawa</td><td>{{ $totalOrmawa }}</td></tr>
        <tr><td>Total Program Kerja</td><td>{{ $totalProker }}</td></tr>
        <tr><td>Selesai</td><td>{{ $totalSelesai }}</td></tr>
        <tr><td>Sedang Berjalan</td><td>{{ $totalBerjalan }}</td></tr>
        <tr><td>Belum Dimulai</td><td>{{ $totalBelum }}</td></tr>
        <tr><td>Tingkat Keberhasilan</td><td>{{ $successRate }}%</td></tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width:30px">No</th>
                <th>Ormawa</th>
                <th>Kategori</th>
                <th>Fakultas</th>
                <th style="width:50px">Total</th>
                <th style="width:50px">Selesai</th>
                <th style="width:50px">Berjalan</th>
                <th style="width:50px">Belum</th>
                <th style="width:60px">Progress</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ormawas as $i => $o)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $o->nama }}</td>
                <td>{{ $o->kategori }}</td>
                <td>{{ $o->fakultas ?? '-' }}</td>
                <td class="text-center">{{ $o->total_proker }}</td>
                <td class="text-center badge-selesai">{{ $o->proker_selesai }}</td>
                <td class="text-center badge-berjalan">{{ $o->proker_berjalan }}</td>
                <td class="text-center badge-belum">{{ $o->proker_belum }}</td>
                <td class="text-center">{{ $o->total_proker > 0 ? round(($o->proker_selesai / $o->total_proker) * 100) : 0 }}%</td>
            </tr>
            @empty
            <tr><td colspan="9" class="text-center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->isoFormat('D MMMM Y') }} &mdash; Three-C (Cakra Control Center)
    </div>
</body>
</html>
