<?php
include("connection/dbconnect.php");
function generatePaymentID($connection) {
    do {
        $randomID = rand(100000, 999999);  // Generate a random ID
        $paymentID = "mkvd" . $randomID;  // Add the "mkvd" prefix
        $query = "SELECT * FROM payment WHERE Payment_ID = '$paymentID'";
        $result = mysqli_query($connection, $query);
    } while (mysqli_num_rows($result) > 0);
    return $paymentID;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $uid = $_POST['uid'];
    $price = $_POST['price'];
    $movie_id = $_POST['mid'];
    //$title = $_POST['titlex'];
    //$Cinema_type = $_POST['Cine_type'];
    $hall_no = $_POST['hall_no'];
    $timing = $_POST['timing'];
    $no_of_seats = $_POST['number_of_seats'];
    $date = $_POST['date'];
    $total = $price*$no_of_seats;
    $remaining_seat = $_POST["Availableseats"];

    if ($no_of_seats <= $remaining_seat){
        // Update the remaining seats in hall_details
        $newAvailableSeats = $remaining_seat - $no_of_seats;
        $updateSeatsQuery = "UPDATE hall_details  SET Remaining_Seat = '$newAvailableSeats' WHERE Hall_Number = '$hall_no' AND Times= '$timing' ";
        mysqli_query($db, $updateSeatsQuery);

        $paymentID = generatePaymentID($db);


        // Insert payment details into database
        $insertPaymentQuery = "INSERT INTO payment (Payment_ID, Customer, Amount) VALUES ('$paymentID', '$uid', '$total')";
        mysqli_query($db, $insertPaymentQuery);


        $insertPaymentTicketQuery = "INSERT INTO ticket (Ticket_day,Ticket_Time,Customer_ID , Movie_Index ,Hall_Number,Seat_Amount, Transaction_ID 	) VALUES ('$date', '$timing','$uid','$movie_id','$hall_no','$no_of_seats', '$paymentID')";
        mysqli_query($db, $insertPaymentTicketQuery);
       
        

        echo "<script>
        alert('Payment successful. Your Payment ID is: $paymentID. You will be redirected to the homepage in 5 seconds.');
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 1000);
      </script>";
    }
    else{
        if ($no_of_seats > $remaining_seat) {
    
            echo "<script>
            alert('Error: This hall has only $remaining_seat seats left.');
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 1000);
          </script>"; 
        } elseif ($remaining_seat == 0) {
    
            echo "<script>
                    alert('No seats available.');
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1000);
                  </script>";
        
         } 
    }
    
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>