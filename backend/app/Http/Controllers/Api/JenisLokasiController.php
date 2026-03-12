public function index()
{
    $data = [
        ['id' => 1, 'nama' => 'Private Residence'],
        ['id' => 2, 'nama' => 'Show Unit'],
        ['id' => 3, 'nama' => 'Office'],
        ['id' => 4, 'nama' => 'Hotel'],
    ];
    return response()->json(['success' => true, 'data' => $data]);
}