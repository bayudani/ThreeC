<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ormawa;
use App\Models\Proker;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanExportController extends Controller
{
    public function export(Request $request)
    {
        $periode = $request->get('periode', '');
        $format = $request->get('format', 'pdf');

        $ormawas = Ormawa::when($periode, fn($q) => $q->where('periode', $periode))
            ->withCount(['prokers as total_proker'])
            ->withCount(['prokers as proker_selesai' => fn($q) => $q->where('status', 'selesai')])
            ->withCount(['prokers as proker_berjalan' => fn($q) => $q->where('status', 'berjalan')])
            ->withCount(['prokers as proker_belum' => fn($q) => $q->where('status', 'belum_dimulai')])
            ->orderBy('nama')
            ->get();

        $totalOrmawa = $ormawas->count();
        $totalProker = $ormawas->sum('total_proker');
        $totalSelesai = $ormawas->sum('proker_selesai');
        $totalBerjalan = $ormawas->sum('proker_berjalan');
        $totalBelum = $ormawas->sum('proker_belum');
        $successRate = $totalProker > 0 ? round(($totalSelesai / $totalProker) * 100) : 0;

        $periodeList = Ormawa::whereNotNull('periode')->distinct()->orderBy('periode', 'desc')->pluck('periode');

        $data = compact('ormawas', 'totalOrmawa', 'totalProker', 'totalSelesai', 'totalBerjalan', 'totalBelum', 'successRate', 'periode', 'periodeList');

        if ($format === 'csv') {
            return $this->exportCsv($data);
        }

        $pdf = Pdf::loadView('export.laporan-pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        $filename = 'laporan-progres-ormawa' . ($periode ? "-{$periode}" : '') . '.pdf';
        return $pdf->download($filename);
    }

    private function exportCsv($data)
    {
        $filename = 'laporan-progres-ormawa' . ($data['periode'] ? "-{$data['periode']}" : '') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($data) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['LAPORAN PROGRES ORMAWA' . ($data['periode'] ? " - {$data['periode']}" : '')]);
            fputcsv($handle, []);
            fputcsv($handle, ['Total Ormawa', $data['totalOrmawa']]);
            fputcsv($handle, ['Total Proker', $data['totalProker']]);
            fputcsv($handle, ['Selesai', $data['totalSelesai']]);
            fputcsv($handle, ['Sedang Berjalan', $data['totalBerjalan']]);
            fputcsv($handle, ['Belum Dimulai', $data['totalBelum']]);
            fputcsv($handle, ['Tingkat Keberhasilan', $data['successRate'] . '%']);
            fputcsv($handle, []);

            fputcsv($handle, ['No', 'Ormawa', 'Kategori', 'Fakultas', 'Total Proker', 'Selesai', 'Berjalan', 'Belum Dimulai']);

            foreach ($data['ormawas'] as $i => $o) {
                fputcsv($handle, [
                    $i + 1,
                    $o->nama,
                    $o->kategori,
                    $o->fakultas ?? '-',
                    $o->total_proker,
                    $o->proker_selesai,
                    $o->proker_berjalan,
                    $o->proker_belum,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
