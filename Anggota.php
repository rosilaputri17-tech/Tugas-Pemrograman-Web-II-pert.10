<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'umur',
        'jenis_kelamin',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    // Accessor Status Badge
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status == 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    // Accessor Kategori Usia
    public function getKategoriUsiaAttribute(): string
    {
        if ($this->umur < 20) {
            return 'Remaja';
        } elseif ($this->umur >= 20 && $this->umur <= 50) {
            return 'Dewasa';
        }

        return 'Senior';
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */

    // Scope jenis kelamin
    public function scopeJenisKelamin($query, $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    // Scope terdaftar bulan ini
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year);
    }
}