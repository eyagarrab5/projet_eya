<?php
include '../../controller/UserC.php';
$userController = new UserC();
$roleStats = $userController->getRoleStatistics();
$topUsers = $userController->getTopUsers();

// Prepare data for charts
$roles = [];
$roleCounts = [];
foreach ($roleStats as $role => $count) {
    $roles[] = $role;
    $roleCounts[] = $count;
}

$userNames = [];
$trajectCounts = [];
foreach ($topUsers as $user) {
    $userNames[] = $user['firstName'] . ' ' . $user['lastName'];
    $trajectCounts[] = $user['trajectCount'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .chart {
            width: 45%;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for chart containers */
            border-radius: 8px; /* Rounded corners for a softer look */
            padding: 10px; /* Padding inside the container */
            background: #fff; /* Background color for contrast */
        }

        .chart canvas {
            width: 100% !important;
            height: auto !important;
            max-height: 300px; /* Adjust height as needed */
            border-radius: 8px; /* Rounded corners for the canvas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow directly on canvas */
        }

        .button-container {
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="users.php" class="btn">Back to Users</a>
    </div>

    <h2>User Role Statistics</h2>
    <div class="chart-container">
        <div class="chart">
            <canvas id="roleChart"></canvas>
        </div>
        <div class="chart">
            <canvas id="userChart"></canvas>
        </div>
    </div>

    <script>
    // Data for Role Statistics
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    const roleChart = new Chart(roleCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($roles); ?>,
            datasets: [{
                data: <?php echo json_encode($roleCounts); ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#E9ECEF', '#6C757D'],
            }]
        },
        options: {
            responsive: true
        }
    });

    // Data for Top Users with Most Trajects
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($userNames); ?>,
            datasets: [{
                label: 'Number of Trajects',
                data: <?php echo json_encode($trajectCounts); ?>,
                backgroundColor: '#36A2EB',
                borderColor: '#36A2EB',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>
