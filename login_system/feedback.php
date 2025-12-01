<?php
// الاتصال بقاعدة البيانات
include 'db_connect.php';

// استرجاع التعليقات من قاعدة البيانات
$sql = "SELECT * FROM feedback ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// التحقق من وجود تعليقات
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $feedback_id = $row['id'];
        $username = $row['user_name'];
        $feedback_text = $row['comment'];
        $rating = $row['rating']; // 5-stars or whatever system you use
        echo "<div class='feedback-item' data-id='$feedback_id'>";
        echo "<p><i class='fas fa-user'></i> $username: “$comment ⭐⭐⭐⭐⭐</p>";
        echo "<button class='delete' onclick='deleteFeedback($feedback_id)' aria-label='Delete Feedback'>";
        echo "<i class='fas fa-trash'></i> Delete</button>";
        echo "</div>";
    }
} else {
    echo "<p>No feedback available.</p>";
}

mysqli_close($conn);
?>
