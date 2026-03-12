public function index()
{
    $data = [
        ['id' => 1, 'nama' => 'Spasium', 'kode' => 'SPA'],
        ['id' => 2, 'nama' => 'Artavia', 'kode' => 'ART'],
    ];
    return response()->json(['success' => true, 'data' => $data]);
}