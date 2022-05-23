<?php

use Utility\Database;

require_once '../utility/Database.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();


if (isset($_POST['email']) && $_POST['password']) {

  function is_jwt_valid($jwt, $secret = 'secretKey')
  {

    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    $signature_provided = $tokenParts[2];

    $expiration = json_decode($payload)->exp;
    $is_token_expired = ($expiration - time()) < 0;

    $base64_url_header = base64url_encode($header);
    $base64_url_payload = base64url_encode($payload);
    $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
    $base64_url_signature = base64url_encode($signature);

    $is_signature_valid = ($base64_url_signature === $signature_provided);

    if ($is_token_expired || !$is_signature_valid) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  $is_jwt_valid = is_jwt_valid($jwt);

  if ($is_jwt_valid === TRUE) {
    echo "JWT is valid </br>";
    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    echo $payload;
    // $q = "SELECT * from users INNER JOIN tokens on users.id=tokens.id WHERE tokens.token=?";
    // $stmt2 = $db->prepare($q);
    // $stmt2->bindParam(1, $jwt);
    // $stmt2->execute();
    // $row2 = $stmt2->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    // echo json_encode([
    //   'status' => 'ok',
    //   'data' => $row2
    // ]);
  } else {
    echo 'invalid';
  }

}
else{
  echo'not set';
}
