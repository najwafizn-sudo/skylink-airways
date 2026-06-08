<?php 
include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroOptima | Seat Allocation DSS</title>
    <!-- Bootstrap 5 CDN for a premium UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #0B2545; --secondary-color: #134074; --accent-color: #8DA9C4; --light-bg: #EEF4F8; }
        body { background-color: var(--light-bg); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .hero-section { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; padding: 60px 0; border-radius: 0 0 25px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-premium { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .card-premium:hover { transform: translateY(-5px); }
        .btn-premium { background-color: var(--secondary-color); color: white; border-radius: 8px; padding: 12px 24px; font-weight: 60px; border: none; }
        .btn-premium:hover { background-color: var(--primary-color); color: white; }
		
		.card-premium { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.03); 
            transition: transform 0.2s; 
            background-color: var(--brown-card-bg) !important; /* Forces the nude background */
            color: var(--brown-text) !important; /* Applies the elegant warm text color */
        }
        .card-premium:hover { transform: translateY(-5px); }
        .card-premium .text-muted { color: #7A6F5D !important; } /* Softens description text */
        
        .btn-premium { background-color: var(--secondary-color); color: white; border-radius: 8px; padding: 12px 24px; font-weight: 60px; border: none; }
        .btn-premium:hover { background-color: var(--white); color: white; }
    </style>
</head>
<body>

    <!-- Premium Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase tracking-wider" href="index.php">✈️ Skylink Airways</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" href="index.php">Dashboard</a>
            <a class="nav-link btn btn-sm btn-outline-light px-3 ms-2" href="input.php">Optimize Flight</a>
        </div>
    </div>
</nav>

    <!-- Hero Header Module -->
    <header class="hero-section text-center">
        <div class="container col-lg-8">
            <h1 class="display-5 fw-bold mb-3">Seat Allocation Optimization</h1>
            <p class="lead text-white-50 mb-4">Utilizing Linear Programming to mathematically maximize cabin configurations for Economy (RM) and Business (RM) seats under strict weight and layout constraints.</p>
            <a href="input.php" class="btn btn-light btn-lg fw-semibold px-5 py-3 shadow">Start New Optimization Analysis</a>
        </div>
    </header>

    <!-- Process Workflow Cards -->
    <main class="container my-5">
        <div class="row g-4 text-center mb-5">
            <div class="col-md-4">
                <div class="card card-premium p-4 h-100 bg-c">
                    <div class="fs-1 mb-2">📊</div>
                    <h5 class="fw-bold text-dark">1. Model Parameters</h5>
                    <p class="text-muted small">Input localized ticket yield matrices along with maximum gross takeoff weight constraints.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-premium p-4 h-100 bg-white">
                    <div class="fs-1 mb-2">⚙️</div>
                    <h5 class="fw-bold text-dark">2. LP Processing Engine</h5>
                    <p class="text-muted small">System iterates combinations validating operational limits to isolate optimal variables.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-premium p-4 h-100 bg-white">
                    <div class="fs-1 mb-2">🏆</div>
                    <h5 class="fw-bold text-dark">3. Strategic Insights</h5>
                    <p class="text-muted small">Extract maximized yield numbers alongside objective limits to present during layout design.</p>
                </div>
            </div>
        </div>

        <!-- History/Database Retrieval Module -->
        <section class="card card-premium bg-white p-4">
            <h4 class="fw-bold mb-4" style="color: var(--primary-color);">Historical Deployment Logs</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Flight ID</th>
                            <th>Target Economy (RM) </th>
                            <th>Target Business (RM)</th>
                            <th>Max Weight Allowance</th>
                            <th>Date Processed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($pdo)): ?>
                            <?php
                            // Retrieves saved problem configurations
                            $stmt = $pdo->query("SELECT * FROM problems ORDER BY id DESC LIMIT 5");
                            $rows = $stmt->fetchAll();
                            if(count($rows) > 0):
                                foreach($rows as $row): ?>
                                    <tr>
                                        <td class="fw-semibold">#<?= htmlspecialchars($row['id']) ?> - <?= htmlspecialchars($row['title']) ?></td>
                                        <td>RM<?= number_format($row['price_economy'], 2) ?></td>
                                        <td>RM<?= number_format($row['price_business'], 2) ?></td>
                                        <td><?= number_format($row['max_weight']) ?> kg</td>
                                        <td class="text-muted small"><?= $row['created_at'] ?? 'Recent' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center text-muted py-4">No previous configurations log detected. Launch a new session above!</td></tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-danger py-4">Database Connection Offline: <?= $database_error ?? 'Check configuration.' ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>