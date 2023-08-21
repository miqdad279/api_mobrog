<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once 'connection.php';
$data = json_decode(file_get_contents('php://input'), true);
if (
    !isset($data['id']) || !isset($data['judul']) ||
    !isset($data['penulis']) || !isset($data['review']) ||
    !isset($data['judul'])
) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "Data tidak lengkap");
    echo json_encode($response);
    die();
}

$id = $data['id'];
$judul = $data['judul'];
$penulis = $data['penulis'];
$review = $data['review'];

$sql = "UPDATE t_post SET judul='$judul', penulis='$penulis', review='$review' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    $conn->close();
    $response = array("status" => "success", "message" => "Data berhasil diupdate");
    http_response_code(200);
    echo json_encode($response);
} else {
    $conn->close();
    $response = array("status" => "error", "message" => "Gagal mengupdate data: " . mysqli_error($conn));
    http_response_code(500);
    echo json_encode($response);
}
