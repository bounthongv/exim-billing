<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['uploaded_file'];

    // File metadata
    $fileName    = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize    = $file['size'];
    $fileError   = $file['error'];

    // Extract file extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Security Rules
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $maxFileSize       = 5 * 1024 * 1024; // 5 MB limit

    // 1. Check for upload errors
    if ($fileError !== 0) {
        die("There was an error uploading your file.");
    }

    // 2. Validate file type
    if (!in_array($fileExt, $allowedExtensions)) {
        die("Invalid file type! Allowed: JPG, PNG, PDF.");
    }

    // 3. Validate file size
    if ($fileSize > $maxFileSize) {
        die("File is too large! Maximum allowed size is 5MB.");
    }

    // 4. Create a unique file name to prevent overwriting existing files
    $uniqueFileName = uniqid('', true) . "." . $fileExt;
    
    // Directory where file will be saved (ensure this folder exists and is writable)
    $uploadDir = 'pdf_file/'; 
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $destination = $uploadDir . $uniqueFileName;

    // 5. Move file from temp storage to destination
    if (move_uploaded_file($fileTmpName, $destination)) {
        echo "File uploaded successfully as: " . htmlspecialchars($uniqueFileName);
    } else {
        echo "Failed to save the file.";
    }
}
?>