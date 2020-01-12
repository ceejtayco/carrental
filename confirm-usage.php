<?php
    include('includes/config.php');

    $booking_id = $_POST['booking_id'];

    $sql = "UPDATE tblusage SET confirmation = 1 WHERE booking_id = :booking_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':booking_id', $booking_id, PDO::PARAM_STR);
    $query->execute();


    $sql = "SELECT user.id as user_id FROM tblbooking booking INNER JOIN tblvehicles vehicle ON booking.VehicleId = vehicle.id INNER JOIN tblusers user ON vehicle.user_id = user.id WHERE booking.id = :booking_id;";
    $query = $dbh->prepare($sql);
    $query->bindParam(':booking_id', $_REQUEST['usage_id'], PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    // SEND NOTIF TO LENDER
    $_SESSION['lenderid'] = $results[0]->user_id;
    $_SESSION['renter_notification_message'] = 'A renter has booked one of your vehicle';
    include('includes/one-signal.php');
    
    echo "Booking ID #" . $booking_id . " usage has successfully started.";
    
?>