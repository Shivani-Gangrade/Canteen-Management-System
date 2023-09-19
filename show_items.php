<?php
  session_start();
  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "HCU_FOOD");
  
  // Check the database connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Select all customers from the database
  $query = "SELECT c.username, c.email, c.user_type, o.id, o.user_name, o.pizza_quantity, o.burger_quantity, o.sandwich_quantity, o.drinks_quantity, o.total_amt
        FROM orders AS o LEFT JOIN customers AS c ON c.username=o.user_name WHERE c.user_type != 'admin'";
  $result = mysqli_query($conn, $query);

  // Check if there are any customers in the database
  if (mysqli_num_rows($result) > 0) {
    echo "<table style='margin: auto'>";
    echo "<tr>";
    echo "<th style='padding: 4px 12px;'>Pizza quantity</th>";
    echo "<th style='padding: 4px 12px;'>Burger quantity</th>";
    echo "<th style='padding: 4px 12px;'>Sandwich quantity</th>";
    echo "<th style='padding: 4px 12px;'>Drinks quantity</th>";
    echo "</tr>";

    $pizza = 0;
    $burger = 0;
    $sandwich=0;
    $drink=0;
    // Output data for each customer
    while ($row = mysqli_fetch_assoc($result)) {
      $pizza += $row["pizza_quantity"];
      $burger += $row["burger_quantity"];
      $sandwich += $row["sandwich_quantity"];
      $drink += $row["drinks_quantity"];
    }
      echo "<td style='text-align: center'>" . $pizza . "</td>";
      echo "<td style='text-align: center'>" . $burger . "</td>";
      echo "<td style='text-align: center'>" . $sandwich . "</td>";
      echo "<td style='text-align: center'>" . $drink . "</td>";
      echo "</tr>";
    echo "</table>";
  } else {
    echo "No customers found in the database.";
  }
  // Close the database connection
  mysqli_close($conn);
?>
