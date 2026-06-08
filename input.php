<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configure Constraints | AeroOptima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary-color: #0B2545; --secondary-color: #134074; --light-bg: #EEF4F8; }
        body { background-color: var(--light-bg); font-family: 'Segoe UI', sans-serif; }
        .card-form { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #ffffff; }
        .form-section-title { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; color: var(--secondary-color); font-weight: 700; border-bottom: 2px solid var(--light-bg); padding-bottom: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">✈️ AeroOptima</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-form p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold" style="color: var(--primary-color);">Flight Linear Programming Input</h2>
                        <p class="text-muted">Populate objective targets and constraint restrictions below.</p>
                    </div>

                    <!-- Directing payload action straight to the result processing script -->
                    <form action="output.php" method="POST">
                        
                        <!-- Section: Identity -->
                        <div class="form-section-title">General Specifications</div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Flight / Scenario Reference Title</label>
                            <input type="text" name="title" class="form-control form-control-lg" placeholder="e.g., Flight MH101 - Airbus A320" required>
                        </div>

                        <!-- Section: Objective Variables -->
                        <div class="form-section-title">Objective Coefficients (Revenue Strategy)</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Economy Ticket Price (RM)</label>
                                <div class="input-group">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" step="0.01" name="price_economy" class="form-control" value="350.00" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Business Ticket Price (RM)</label>
                                <div class="input-group">
                                    <span class="input-group-text">RM</span>
                                    <input type="number" step="0.01" name="price_business" class="form-control" value="950.00" required>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Hard System Constraints -->
                        <div class="form-section-title">System Constraints & Limitations</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-10 col-12">
                                <label class="form-label fw-semibold">Maximum Structural Cabin Space Allocation (Total Max Seats)</label>
                                <input type="number" name="max_seats" class="form-control" value="180" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Max Available Cargo/Passenger Payload Weight Capacity (kg)</label>
                                <input type="number" name="max_weight" class="form-control" value="22000" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Avg. Weight Allowance per Economy Pax (Inc. Luggage)</label>
                                <div class="input-group">
                                    <input type="number" name="weight_economy" class="form-control" value="100" required>
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Avg. Weight Allowance per Business Pax (Inc. Luggage)</label>
                                <div class="input-group">
                                    <input type="number" name="weight_business" class="form-control" value="140" required>
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 pt-3">
                            <button type="submit" class="btn btn-lg text-white shadow-sm" style="background-color: var(--secondary-color);">Run Optimization Model</button>
                            <a href="index.php" class="btn btn-light btn-sm text-muted">Cancel and Exit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>