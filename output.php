<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: input.php');
    exit;
}

// Extract parameters safely from input payloads
$title = $_POST['title'] ?? 'Generic Flight Run';
$price_economy = (float)($_POST['price_economy'] ?? 350.00);
$price_business = (float)($_POST['price_business'] ?? 950.00);
$max_seats = (int)($_POST['max_seats'] ?? 180);
$max_weight = (float)($_POST['max_weight'] ?? 22000);
$weight_economy = (float)($_POST['weight_economy'] ?? 100);
$weight_business = (float)($_POST['weight_business'] ?? 140);

// --- THE SOLUTION ENGINE (Linear Programming Brute-Force Matrix Search) ---
$optimal_x = 0; // Ideal Economy Seats
$optimal_y = 0; // Ideal Business Seats
$max_revenue = 0.0; // Optimum Objective Target

// Multi-variable search iterations bounding constraints
for ($x = 0; $x <= $max_seats; $x++) {
    for ($y = 0; $y <= ($max_seats - $x); $y++) {
        
        // Assert Weight Constraints
        $calculated_weight = ($x * $weight_economy) + ($y * $weight_business);
        if ($calculated_weight > $max_weight) {
            continue; // Violates weight bounds, skip option
        }
        
        // Target Equation calculation: Max Z = P_x(x) + P_y(y)
        $current_revenue = ($x * $price_economy) + ($y * $price_business);
        
        if ($current_revenue > $max_revenue) {
            $max_revenue = $current_revenue;
            $optimal_x = $x;
            $optimal_y = $y;
        }
    }
}

// Compute final utilized metrics
$final_weight_used = ($optimal_x * $weight_economy) + ($optimal_y * $weight_business);
$final_seats_used = $optimal_x + $optimal_y;

// --- DATABASE PERSISTENCE LAYER (MySQL Storage) ---
if (isset($pdo)) {
    try {
        // Insert into parameters table
        $stmt = $pdo->prepare("INSERT INTO problems (title, price_economy, price_business, max_weight, weight_economy, weight_business, max_seats) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $price_economy, $price_business, $max_weight, $weight_economy, $weight_business, $max_seats]);
        $problem_id = $pdo->lastInsertId();

        // Insert configuration outcomes into corresponding solution map
        $stmt_sol = $pdo->prepare("INSERT INTO solutions (problem_id, optimal_economy, optimal_business, max_revenue) VALUES (?, ?, ?, ?)");
        $stmt_sol->execute([$problem_id, $optimal_x, $optimal_y, $max_revenue]);
    } catch (\Exception $e) {
        $db_save_warn = "Calculations succeeded but optimization archiving bypassed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimization Results | AeroOptima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #0B2545; --success-color: #1A5F7A; --light-bg: #EEF4F8; }
        body { background-color: var(--light-bg); font-family: 'Segoe UI', sans-serif; }
        .result-card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .metric-badge { font-size: 2.5rem; font-weight: 700; color: var(--primary-color); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">✈️ AeroOptima System Dashboard</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="text-uppercase tracking-wider text-muted small fw-bold">Analysis Output Case Run</span>
                <h2 class="fw-bold text-dark"><?= htmlspecialchars($title) ?></h2>
            </div>
            <a href="input.php" class="btn btn-outline-secondary btn-sm">Modify Initial Coefficients</a>
        </div>

        <?php if(isset($db_save_warn)): ?>
            <div class="alert alert-warning"><?= $db_save_warn ?></div>
        <?php endif; ?>

        <!-- Primary Solution Outputs -->
        <div class="row g-4 mb-4">
            <!-- Optimal Revenue Card -->
            <div class="col-12">
                <div class="card result-card text-white text-center p-4 shadow-sm" style="background: linear-gradient(135deg, #1A5F7A, #0B2545);">
                    <div class="text-uppercase small fw-bold text-white-50">Maximized Projected Route Yield </div>
                    <div class="display-3 fw-bold my-2">RM<?= number_format($max_revenue, 2) ?></div>
                    <p class="mb-0 text-white-50 small">Optimal financial performance within specified structural boundaries.</p>
                </div>
            </div>

            <!-- Variable Solutions -->
            <div class="col-md-6">
                <div class="card result-card bg-white p-4 text-center">
                    <div class="text-uppercase text-muted small fw-bold">Economy Configuration</div>
                    <div class="metric-badge my-2"><?= $optimal_x ?></div>
                    <p class="text-muted small">Assigned Passenger Capacity Seats</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card result-card bg-white p-4 text-center">
                    <div class="text-uppercase text-muted small fw-bold">Business Configuration</div>
                    <div class="metric-badge my-2"><?= $optimal_y ?></div>
                    <p class="text-muted small">Assigned Premium Allocation Seats</p>
                </div>
            </div>
        </div>

        <!-- Verification Metrics Grid -->
        <div class="card result-card bg-white p-4">
            <h4 class="fw-bold mb-4 text-dark border-bottom pb-2">Operational Boundary Verification</h4>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb-1 fw-semibold">
                        <span>Total Structural Seat Boundaries Used</span>
                        <span><?= $final_seats_used ?> / <?= $max_seats ?> Seats</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= ($final_seats_used / $max_seats) * 100 ?>%"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb-1 fw-semibold">
                        <span>Gross structural Aircraft Payload Used</span>
                        <span><?= number_format($final_weight_used) ?> / <?= number_format($max_weight) ?> kg</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= ($final_weight_used / $max_weight) * 100 ?>%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                <a href="index.php" class="btn btn-primary px-4" style="background-color: var(--primary-color);">Return to Dashboard</a>
            </div>
        </div>
    </div>

</body>
</html>