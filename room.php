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

// ตรวจสอบเมื่อผู้ใช้ค้นหา
$searchQuery = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

$sql = "SELECT * FROM Rooms WHERE RoomNumber LIKE ? OR RoomType LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%" . $searchQuery . "%";
$stmt->bind_param("ss", $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <style>
        /* พื้นหลังและตัวอักษร */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            margin: 0;
            color: #333;
        }

        /* หัวข้อหน้า */
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* ฟอร์มค้นหา */
        .search-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-search {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-search:hover {
            background-color: #0056b3;
        }

        /* ตารางแสดงห้องพัก */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f4f4f9;
        }

        td span {
            color: #d9534f;
            font-weight: bold;
        }

        .btn-book {
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        .btn-book:hover {
            background-color: #218838;
        }

        /* แถบเมนูด้านบน */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        .tab:hover,
        .active-tab {
            background-color: #0056b3;
        }

        /* Popup */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .popup-close:hover {
            color: #ff0000;
        }

        /* ฟอร์มใน popup */
        .popup-container form {
            display: flex;
            flex-direction: column;
        }

        .popup-container input[type="date"] {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .popup-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .popup-container button:hover {
            background-color: #0056b3;
        }

        .booked {
            background-color: red;
            /* เปลี่ยนพื้นหลังเป็นสีแดง */
            color: white;
            /* เปลี่ยนตัวอักษรเป็นสีขาว */
            font-weight: bold;
            /* ทำให้ตัวอักษรหนาขึ้น */
        }
    </style>
</head>

<body>
    <h1>Room List</h1>

    <form method="GET" class="search-form">
        <input
            type="text"
            name="search"
            class="search-input"
            placeholder="Search by room number or type..."
            value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit" class="btn-search">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Price per Night</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['RoomNumber']); ?></td>
                    <td><?php echo htmlspecialchars($row['RoomType']); ?></td>
                    <td><?php echo htmlspecialchars($row['PricePerNight']); ?></td>
                    <td><?php echo $row['IsAvailable'] ? 'Available' : 'Booked'; ?></td>
                    <!-- <td>
                        <button class="btn-book" onclick="openBookingPopup(<?php echo $row['RoomID']; ?>)">Book Now</button>
                    </td> -->
                    <td>
                        <?php if ($row['IsAvailable']): ?>
                            <button class="btn-book" onclick="openBookingPopup(<?php echo $row['RoomID']; ?>)">Book Now</button>
                        <?php else: ?>
                            <button class="btn-book booked" disabled>Booked</button>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- SweetAlert2 booking form -->
    <script>
        function openBookingPopup(roomID) {
            Swal.fire({
                title: 'Book Your Room',
                html: `
                    <input type="date" id="checkInDate" class="swal2-input" placeholder="Check-in Date" required>
                    <input type="date" id="checkOutDate" class="swal2-input" placeholder="Check-out Date" required>
                `,
                confirmButtonText: 'Confirm Booking',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const checkInDate = document.getElementById('checkInDate').value;
                    const checkOutDate = document.getElementById('checkOutDate').value;
                    if (!checkInDate || !checkOutDate) {
                        Swal.showValidationMessage('Please fill out both dates');
                    } else {
                        // Send the booking request via AJAX or a form submission
                        return {
                            roomID,
                            checkInDate,
                            checkOutDate
                        };
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        roomID,
                        checkInDate,
                        checkOutDate
                    } = result.value;

                    // Sending data to the server using AJAX
                    fetch('bookings.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                roomID,
                                checkInDate,
                                checkOutDate
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Booking Successful!',
                                    text: 'Your room has been booked successfully.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was an error with your booking.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error with your booking.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        }
    </script>
</body>

</html>