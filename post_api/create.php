<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once 'connection.php';
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['judul']) || !isset($data['penulis']) || !isset($data['review'])) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "Data tidak lengkap");
    echo json_encode($response);
    die();
}
$judul = $data['judul'];
$penulis = $data['penulis'];
$review = $data['review'];

$sql = "INSERT INTO t_post (judul, penulis, review) VALUES ('$judul', '$penulis', '$review')";
if ($conn->query($sql) === TRUE) {
    $conn->close();
    $response = array("status" => "success", "message" => "Data berhasil disimpan");
    http_response_code(200);
    echo json_encode($response);
} else {
    $conn->close();
    $response = array("status" => "error", "message" => "Gagal menyimpan data: " . $conn->error);
    http_response_code(500);
    echo json_encode($response);
}
