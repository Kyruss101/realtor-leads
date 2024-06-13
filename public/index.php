<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtor Teams Management</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <div class="left-container d-flex align-items-center justify-content-between mb-3">
                <h1 class="mb-0">Realtor Teams Management</h1>
                <div class="">
                    <div id="message"></div>
                    <div class="add-new">
                        <button class="btn btn-primary" onclick="showCreateForm()">Add New Team Member</button>
                    </div>
                </div>
            </div>
            <div class="filter-container d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <label for="stateFilter">Filter by State:</label>
                    <select id="stateFilter" class="form-control state-filter ml-2" onchange="filterData()">
                        <option value="">All States</option>
                        <!-- States will be dynamically loaded here -->
                    </select>
                    <input id="salesFilter" type="text" class="min-sales form-control filter-input m-0" placeholder="Min Sales" maxlength="4" oninput="filterData()">
                    <input id="reviewsFilter" type="text" class="min-reviews form-control filter-input m-0" placeholder="Min Reviews" maxlength="4" oninput="filterData()">
                </div>
                <div class="">
                    <span id="recordCount" class="record-count"></span>
                </div>
            </div>
            <div id="createForm" class="create-form" style="display:none;">
                <!-- Form will be dynamically loaded here -->
            </div>
        </div>
        <div id="teamList" class="team-list">
            <!-- Team list will be dynamically loaded here -->
        </div>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
