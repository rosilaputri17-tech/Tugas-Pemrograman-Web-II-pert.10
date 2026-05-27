use App\Models\Buku;
use App\Models\Anggota;

Route::get('/test-accessor-scope', function () {

    $html = '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container mt-4">
    <h1>Testing Accessor & Scope</h1>
    ';

    /*
    |--------------------------------------------------------------------------
    | TEST ACCESSOR BUKU
    |--------------------------------------------------------------------------
    */

    $html .= '<h3 class="mt-4">Semua Buku</h3>';

    $buku = Buku::all();

    foreach ($buku as $item) {
        $html .= '
        <div class="card mb-2 p-3">
            <strong>' . $item->judul . '</strong><br>
            Stok: ' . $item->stok . '<br>
            Status: ' . $item->status_stok_badge . '<br>
            Tahun: ' . $item->tahun_terbit . ' (' . $item->tahun_label . ')
        </div>
        ';
    }

    /*
    |--------------------------------------------------------------------------
    | TEST SCOPE BUKU TERBARU
    |--------------------------------------------------------------------------
    */

    $html .= '<h3 class="mt-4">Buku Terbaru</h3>';

    $terbaru = Buku::terbaru()->get();

    foreach ($terbaru as $item) {
        $html .= '<p>' . $item->judul . ' - ' . $item->tahun_terbit . '</p>';
    }

    /*
    |--------------------------------------------------------------------------
    | TEST SCOPE STOK MENIPIS
    |--------------------------------------------------------------------------
    */

    $html .= '<h3 class="mt-4">Buku Stok Menipis</h3>';

    $menipis = Buku::stokMenipis()->get();

    foreach ($menipis as $item) {
        $html .= '<p>' . $item->judul . ' - Stok: ' . $item->stok . '</p>';
    }

    /*
    |--------------------------------------------------------------------------
    | TEST ACCESSOR ANGGOTA
    |--------------------------------------------------------------------------
    */

    $html .= '<h3 class="mt-4">Data Anggota</h3>';

    $anggota = Anggota::all();

    foreach ($anggota as $item) {
        $html .= '
        <div class="card mb-2 p-3">
            <strong>' . $item->nama . '</strong><br>
            Status: ' . $item->status_badge . '<br>
            Umur: ' . $item->umur . '<br>
            Kategori Usia: ' . $item->kategori_usia . '
        </div>
        ';
    }

    /*
    |--------------------------------------------------------------------------
    | TEST SCOPE TERDAFTAR BULAN INI
    |--------------------------------------------------------------------------
    */

    $html .= '<h3 class="mt-4">Anggota Terdaftar Bulan Ini</h3>';

    $bulanIni = Anggota::terdaftarBulanIni()->get();

    foreach ($bulanIni as $item) {
        $html .= '<p>' . $item->nama . '</p>';
    }

    $html .= '</div>';

    return $html;
});