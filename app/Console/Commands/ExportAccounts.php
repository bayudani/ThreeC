<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportAccounts extends Command
{
    protected $signature = 'accounts:export {--path= : Lokasi file output (default: storage/app/exports)}';

    protected $description = 'Export daftar akun (username/email & password) ke file Excel';

    public function handle(): int
    {
        $users = User::with('ormawa')->get()->sortBy->name->values();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Daftar Akun');

        $sheet->setCellValue('A1', 'DAFTAR AKUN THREE-C (CAKRA CONTROL CENTER)');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->mergeCells('A1:H1');

        $sheet->setCellValue('A2', 'Ekspor dibuat pada ' . now()->format('d M Y H:i'));
        $sheet->getStyle('A2')->getFont()->setColor(new Color('FF6B7280'));

        $headers = ['No', 'Nama', 'Username', 'Email', 'Role', 'Organisasi', 'Password', 'Keterangan'];
        $headerRow = 4;

        foreach (array_values($headers) as $i => $label) {
            $coord = Coordinate::stringFromColumnIndex($i + 1) . $headerRow;
            $sheet->setCellValue($coord, $label);
        }

        $sheet->getStyle('A' . $headerRow . ':H' . $headerRow)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => 'FF2563EB']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension($headerRow)->setRowHeight(22);

        $row = $headerRow + 1;
        foreach ($users as $i => $user) {
            $resolve = $this->resolvePassword($user);

            $values = [
                $i + 1,
                $user->name,
                $user->username,
                $user->email ?? '-',
                $this->roleLabel($user->role),
                $user->ormawa?->nama ?? '-',
                $resolve['password'],
                $resolve['note'],
            ];

            foreach (array_values($values) as $j => $value) {
                $sheet->setCellValueExplicit(
                    Coordinate::stringFromColumnIndex($j + 1) . $row,
                    $value,
                    \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
                );
            }

            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                'font' => ['size' => 11],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            if ($i % 2 === 1) {
                $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['argb' => 'FFF1F5F9']],
                ]);
            }

            $pwColor = $resolve['password'] === '-' ? 'FFDC2626' : 'FF16A34A';
            $sheet->getStyle(Coordinate::stringFromColumnIndex(7) . $row)
                ->getFont()
                ->setColor(new Color($pwColor));

            $row++;
        }

        $lastRow = $row - 1;

        if ($lastRow >= $headerRow + 1) {
            $sheet->getStyle('A' . $headerRow . ':H' . $lastRow)->applyFromArray([
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']],
                ],
            ]);
        }

        foreach ([1 => 6, 2 => 34, 3 => 22, 4 => 32, 5 => 16, 6 => 28, 7 => 28, 8 => 44] as $col => $width) {
            $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($col))->setWidth($width);
        }

        $noteRow = $lastRow + 2;
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $noteRow, 'Catatan: Password hanya tampil jika masih merupakan password default. Akun dengan keterangan "Password diubah oleh pengguna" tidak dapat ditampilkan karena tersimpan sebagai hash.');
        $sheet->getStyle(Coordinate::stringFromColumnIndex(1) . $noteRow)
            ->getFont()
            ->setColor(new Color('FF6B7280'));
        $sheet->getRowDimension($noteRow)->setRowHeight(28);

        $sheet->freezePane('A5');

        $path = $this->option('path')
            ?? storage_path('app/exports/akun-' . now()->format('Y-m-d') . '.xlsx');

        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        (new Xlsx($spreadsheet))->save($path);

        $this->info('Export selesai: ' . $path);
        $this->info('Total akun: ' . $users->count());

        return self::SUCCESS;
    }

    private function resolvePassword(User $user): array
    {
        $candidates = match ($user->role) {
            'admin_kampus' => ['password123'],
            'admin_ormawa' => [$user->username . '@unsera26', $user->username . 'unsera@26'],
            default => [],
        };

        foreach ($candidates as $candidate) {
            if (Hash::check($candidate, $user->password)) {
                return ['password' => $candidate, 'note' => 'Password default'];
            }
        }

        return ['password' => '-', 'note' => 'Password diubah oleh pengguna'];
    }

    private function roleLabel(string $role): string
    {
        return match ($role) {
            'admin_kampus' => 'Admin Kampus',
            'admin_ormawa' => 'Admin Ormawa',
            'viewer' => 'Viewer',
            default => ucfirst($role),
        };
    }
}