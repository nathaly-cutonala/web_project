<?php

// Include the User.php file
require_once '../app/controllers/ExpensesTypesController.php'; 

// Initialize the User object
$expenses = new ExpensesTypesController();

$expense = $expenses->chart(); //trae un string
$data = json_decode($expense, true);

$typeNames = json_encode(array_column($data, 'type_name'));
$totalAmount = json_encode(array_column($data, 'total_amount'));

?>
<!DOCTYPE html>
<html lang="en">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <body>

  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

  <script>
    //const xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    const xValues = <?php echo ($typeNames); ?>;
    const yValues = <?php echo ($totalAmount); ?>;
    const barColors = [
      "#b91d47",
      "#00aba9",
      "#2b5797",
      "#e8c3b9",
      "#1e7145"
    ];

    new Chart("myChart", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "World Wide Wine Production 2018"
        }
      }
    });
  </script>

  </body>
</html>
