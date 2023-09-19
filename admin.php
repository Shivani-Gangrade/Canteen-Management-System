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
    echo "<table>";
    echo "<tr>";
    echo "<th style='padding: 4px 12px;'>ID</th>";
    echo "<th style='padding: 4px 12px;'>User Name</th>";
    echo "<th style='padding: 4px 12px;'>Email</th>";
    echo "<th style='padding: 4px 12px;'>Pizza quantity</th>";
    echo "<th style='padding: 4px 12px;'>Burger quantity</th>";
    echo "<th style='padding: 4px 12px;'>Sandwich quantity</th>";
    echo "<th style='padding: 4px 12px;'>Drinks quantity</th>";
    echo "<th style='padding: 4px 12px;'>Bill</th>";
    echo "</tr>";

    $tot_pizza = 0;
    $burger = 0;
    // Output data for each customer
    while ($row = mysqli_fetch_assoc($result)) {
      $tot_pizza += $row["pizza_quantity"];
      $burger += $row["burger_quantity"];
      echo "<tr>";
      echo "<td style='text-align: center'>" . $row["id"] . "</td>";
      echo "<td style='text-align: center'>" . $row["user_name"] . "</td>";
      echo "<td style='text-align: center'>" . $row["email"] . "</td>";
      echo "<td style='text-align: center'>" . $row["pizza_quantity"] . "</td>";
      echo "<td style='text-align: center'>" . $row["burger_quantity"] . "</td>";
      echo "<td style='text-align: center'>" . $row["sandwich_quantity"] . "</td>";
      echo "<td style='text-align: center'>" . $row["drinks_quantity"] . "</td>";
      echo "<td style='text-align: center'>" . $row["total_amt"] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "No customers found in the database.";
  }
  ?>
  <form action="show_items.php" method="post">
				<input type="submit" name="signup_submit" value="Show">
			</form>
  <?php

  // Close the database connection
  mysqli_close($conn);
?>
