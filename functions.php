<?php
function saveFeedback($name, $email, $message) {
    require_once 'db.php';
    $conn = getDbConnection();

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    $stmt->execute();

    $conn = null;
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function checkAdminCredentials($username, $password) {
    require_once 'db.php';
    $conn = getDbConnection();

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $conn = null;

    if ($result && password_verify($password, $result['password'])) {
        return true;
    } else {
        return false;
    }
}

function getAllMessages() {
    require_once 'db.php';
    $conn = getDbConnection();

    $stmt = $conn->prepare("SELECT * FROM feedback ORDER BY created_at DESC");
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
    return $messages;
}

function deleteMessage($id) {
    require_once 'db.php';
    $conn = getDbConnection();

    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $conn = null;
}

function markMessageAsRead($id) {
    require_once 'db.php';
    $conn = getDbConnection();

    $stmt = $conn->prepare("UPDATE feedback SET is_read = 1 WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $conn = null;
}
?>
