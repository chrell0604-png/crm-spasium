<?php

namespace App\Exports;

use App\Models\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InquiriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;
    protected $tanggal_mulai;
    protected $tanggal_selesai;

    public function __construct($status = null, $tanggal_mulai = null, $tanggal_selesai = null)
    {
        $this->status = $status;
        $this->tanggal_mulai = $tanggal_mulai;
        $this->tanggal_selesai = $tanggal_selesai;
    }

    public function collection()
    {
        $query = Inquiry::with(['sumberLead', 'jenisLokasi', 'perusahaan']);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->tanggal_mulai && $this->tanggal_selesai) {
            $query->whereBetween('created_at', [
                $this->tanggal_mulai . ' 00:00:00',
                $this->tanggal_selesai . ' 23:59:59'
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama PIC',
            'Sumber Lead',
            'Jenis Lokasi',
            'Perusahaan',
            'Nilai',
            'Status',
            'Tanggal Dibuat'
        ];
    }

    public function map($inquiry): array
    {
        return [
            $inquiry->id,
            $inquiry->nama_pic,
            $inquiry->sumberLead->nama ?? '-',
            $inquiry->jenisLokasi->nama ?? '-',
            $inquiry->perusahaan->nama ?? '-',
            'Rp ' . number_format($inquiry->nilai, 0, ',', '.'),
            ucfirst($inquiry->status),
            $inquiry->created_at->format('d/m/Y H:i')
        ];
    }
}