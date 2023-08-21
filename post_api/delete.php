<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once 'connection.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['id'])) {
    http_response_code(404);
    die();
} else {
    $id = $data['id'];
    $query = "DELETE FROM t_post WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $conn->close();
        $response['status'] = 0;
        $response['message'] = "Delete berhasil";
        http_response_code(200);
        echo json_encode($response);
        return;
    } else {
        $conn->close();
        $response['status'] = 1;
        $response['message'] = "Delete gagal";
        http_response_code(404);
        echo json_encode($response);
    }
}
