<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';

    protected $fillable = [
        'nama_pic',
        'sumber_lead_id',
        'jenis_lokasi_id',
        'perusahaan_id',
        'nilai',
        'status',
        'first_contact_by_id',
        'keputusan_desain_by_id',
        'pengaruh_desain_by_id',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel sumber_leads
     */
    public function sumberLead()
    {
        return $this->belongsTo(SumberLead::class);
    }

    /**
     * Relasi ke tabel jenis_lokasis
     */
    public function jenisLokasi()
    {
        return $this->belongsTo(JenisLokasi::class);
    }

    /**
     * Relasi ke tabel perusahaans
     */
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    /**
     * Relasi ke tabel role_contacts (first_contact_by)
     */
    public function firstContactBy()
    {
        return $this->belongsTo(RoleContact::class, 'first_contact_by_id');
    }

    /**
     * Relasi ke tabel role_contacts (keputusan_desain_by)
     */
    public function keputusanDesainBy()
    {
        return $this->belongsTo(RoleContact::class, 'keputusan_desain_by_id');
    }

    /**
     * Relasi ke tabel role_contacts (pengaruh_desain_by)
     */
    public function pengaruhDesainBy()
    {
        return $this->belongsTo(RoleContact::class, 'pengaruh_desain_by_id');
    }

    /**
     * Relasi ke tabel inquiry_produks (detail produk)
     */
    public function inquiryProduks()
    {
        return $this->hasMany(InquiryProduk::class);
    }
}