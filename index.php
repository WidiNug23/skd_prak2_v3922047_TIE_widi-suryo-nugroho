<?php
// Fungsi untuk melakukan enkripsi menggunakan metode Caesar Cipher
function encryptShift($plaintext, $shift) {
    $encryptedText = '';
    
    // Loop melalui setiap karakter dalam plaintext
    for ($i = 0; $i < strlen($plaintext); $i++) {
        $char = $plaintext[$i];
        
        // Cek apakah karakter merupakan huruf alfabet
        if (ctype_alpha($char)) {
            $isUpperCase = ctype_upper($char); // Cek apakah huruf kapital
            $char = ord($char); // Mengubah karakter menjadi nilai ASCII
            
            // Melakukan pergeseran sesuai dengan shift
            $char = ($char - ($isUpperCase ? 65 : 97) + $shift) % 26;
            $char = $char < 0 ? $char + 26 : $char; // Memastikan nilai ASCII tidak kurang dari 0
            $char = $char + ($isUpperCase ? 65 : 97); // Mengembalikan ke nilai ASCII huruf
            $char = chr($char); // Mengubah kembali ke karakter
            
        }
        
        $encryptedText .= $char; // Menambahkan karakter yang telah diubah ke teks terenkripsi
    }
    
    return $encryptedText; // Mengembalikan teks terenkripsi
}

// Fungsi untuk mendekripsi adalah kebalikan dari enkripsi
function decryptShift($encryptedText, $shift) {
    return encryptShift($encryptedText, -$shift); // Menggunakan enkripsi dengan shift negatif
}

// Memeriksa apakah tombol "Enkripsi" atau "Dekripsi" ditekan
if (isset($_POST['encrypt'])) {
    $plaintext = $_POST['plaintext']; // Mengambil teks dari input plaintext
    $shift = 47; // Jumlah pergeseran
    $encrypted = encryptShift($plaintext, $shift); // Melakukan enkripsi
} elseif (isset($_POST['decrypt'])) {
    $ciphertext = $_POST['ciphertext']; // Mengambil teks dari input ciphertext
    $shift = 47; // Jumlah pergeseran
    $decrypted = decryptShift($ciphertext, $shift); // Melakukan dekripsi
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enkripsi dan Dekripsi Pergeseran 47</title>
</head>
<body>
    <h1>Enkripsi dan Dekripsi Pergeseran 47</h1>
    
    <!-- Formulir untuk mengenkripsi -->
    <form method="post" action="">
        <label for="plaintext">Plaintext:</label>
        <input type="text" id="plaintext" name="plaintext">
        <input type="submit" name="encrypt" value="Enkripsi">
    </form>
    
    <?php
    // Menampilkan teks terenkripsi jika ada
    if (isset($encrypted)) {
        echo "<p>Teks Terenkripsi: $encrypted</p>";
    }
    ?>
    
    <!-- Formulir untuk mendekripsi -->
    <form method="post" action="">
        <label for="ciphertext">Ciphertext:</label>
        <input type="text" id="ciphertext" name="ciphertext">
        <input type="submit" name="decrypt" value="Dekripsi">
    </form>
    
    <?php
    // Menampilkan teks terdekripsi jika ada
    if (isset($decrypted)) {
        echo "<p>Teks Terdekripsi: $decrypted</p>";
    }
    ?>
</body>
</html>
