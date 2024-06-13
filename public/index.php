<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtor Teams Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <div class="filter-container">
                <h1 class="m-0 mb-3">Realtor Teams Management 1</h1>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <label for="searchByName" class="m-0">Search by Name:</label>
                        <input id="searchByName" type="text" class="form-control search-filter m-0" placeholder="">
                    </div>
                    <div class="">
                        <input id="salesFilter" type="text" class="min-sales form-control filter-input m-0" placeholder="Min Sales" maxlength="4" oninput="filterData()">
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <label for="stateFilter" class="m-0">Filter by State:</label>
                        <select id="stateFilter" class="form-control state-filter" onchange="filterData()">
                            <option value="">All States</option>
                            <!-- States will be dynamically loaded here -->
                        </select>
                    </div>
                    <div class="">
                        <input id="reviewsFilter" type="text" class="min-reviews form-control filter-input m-0" placeholder="Min Reviews" maxlength="4" oninput="filterData()">
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="d-flex flex-column justify-content-between h-100">
                    <div id="message"></div>
                    <div class="add-new">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showAddNewModal" onclick="showCreateForm()">Add New Team Member</button>
                    </div>
                    <div class="align-self-end">
                        <span id="recordCount" class="record-count"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="createForm" class="create-form">
            <!-- Form will be dynamically loaded here -->
        </div>
        <div id="teamList" class="team-list">
            <!-- Team list will be dynamically loaded here -->
        </div>
    </div>

    <script src="assets/js/scripts.js"></script>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
