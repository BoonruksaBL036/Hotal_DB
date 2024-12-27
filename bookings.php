<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Hotel_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากการจอง
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $userID = 1; // ตัวอย่าง: สมมุติว่า userID ของผู้ใช้อยู่ที่ 1
    $roomID = $data['roomID'];
    $checkInDate = $data['checkInDate'];
    $checkOutDate = $data['checkOutDate'];

    // SQL สำหรับบันทึกการจองห้องพัก
    $sql = "INSERT INTO Bookings (UserID, RoomID, CheckInDate, CheckOutDate) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $userID, $roomID, $checkInDate, $checkOutDate);

    if ($stmt->execute()) {
        // เปลี่ยนสถานะห้องให้ไม่ว่าง
        $updateSql = "UPDATE Rooms SET IsAvailable = 0 WHERE RoomID = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $roomID);
        $updateStmt->execute();
        $updateStmt->close();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$conn->close();
?>
