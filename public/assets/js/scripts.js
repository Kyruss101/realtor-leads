document.addEventListener('DOMContentLoaded', function() {
    loadTeamList(1); // Load the first page by default
    loadStateFilter(); // Load the state filter options

    document.getElementById('createForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('../includes/create.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showMessage(data.message);
            loadTeamList(1); // Reload the first page after creation
            hideCreateForm();
        });
    });
});

function loadStateFilter() {
    fetch('../includes/read.php')
    .then(response => response.json())
    .then(data => {
        const headers = data.headers;
        const rows = data.data;
        const stateIndex = headers.indexOf('State');
        const states = [...new Set(rows.map(row => row[stateIndex]))].sort();
        const stateFilter = document.getElementById('stateFilter');
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            stateFilter.appendChild(option);
        });
    });
}

function filterData() {
    const state = document.getElementById('stateFilter').value;
    const minSales = document.getElementById('salesFilter').value;
    const minReviews = document.getElementById('reviewsFilter').value;
    loadTeamList(1, state, minSales, minReviews);
}

function loadTeamList(page, filterState = '', minSales = '', minReviews = '') {
    fetch('../includes/read.php')
    .then(response => response.json())
    .then(data => {
        const headers = data.headers;
        const rows = data.data;
        const itemsPerPage = 5; // Change the number of items per page to 5
        let filteredRows = rows;

        if (filterState || minSales || minReviews) {
            const stateIndex = headers.indexOf('State');
            const salesIndex = headers.indexOf('Last 12 Months Sales');
            const reviewsIndex = headers.indexOf('Zillow Reviews');
            
            filteredRows = rows.filter(row => {
                const stateMatch = filterState ? row[stateIndex] === filterState : true;
                const salesMatch = minSales ? parseInt(row[salesIndex]) >= parseInt(minSales) : true;
                const reviewsMatch = minReviews ? parseInt(row[reviewsIndex]) >= parseInt(minReviews) : true;
                return stateMatch && salesMatch && reviewsMatch;
            });
        }

        document.getElementById('recordCount').textContent = `Total Records: ${filteredRows.length}`;

        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedRows = filteredRows.slice(start, end);

        let table = `<div class="table-responsive"><table class="table table-bordered"><thead><tr>`;
        headers.forEach(header => {
            if (!['Facebook', 'Instagram', 'LinkedIn', 'Pinterest', 'Twitter', 'YouTube', 'Website', 'Blog'].includes(header)) {
                table += `<th>${header}</th>`;
            }
        });
        table += `<th>Actions</th></tr></thead><tbody>`;
        paginatedRows.forEach((row, index) => {
            table += `<tr id="row-${index}" data-id="${row[0]}">`;
            row.forEach((cell, cellIndex) => {
                if (headers[cellIndex] === 'Zillow Profile') {
                    table += `<td><button class="btn btn-link" onclick="window.open('${cell}', '_blank')">View Profile</button></td>`;
                } else if (!['Facebook', 'Instagram', 'LinkedIn', 'Pinterest', 'Twitter', 'YouTube', 'Website', 'Blog'].includes(headers[cellIndex])) {
                    table += `<td contenteditable="true" data-header="${headers[cellIndex]}">${cell}</td>`;
                }
            });
            table += `<td>
                <div class="btn-wrap">
                    <button class="btn btn-info btn-sm" onclick="toggleDetails(${index})">Details</button>
                    <button class="btn btn-success btn-sm" onclick="saveRow(${index})">Save</button>
                </div>
            </td></tr>`;
            table += `<tr id="details-${index}" style="display:none;"><td colspan="${headers.length + 1}">
                <table class="table table-bordered"><tbody>`;
            table += `<tr><th>Website</th><td>${row[headers.indexOf('Website')] || ''}</td><th>Blog</th><td>${row[headers.indexOf('Blog')] || ''}</td></tr>`;
            table += `<tr><th>Facebook</th><td>${row[headers.indexOf('Facebook')] || ''}</td><th>Instagram</th><td>${row[headers.indexOf('Instagram')] || ''}</td><th>LinkedIn</th><td>${row[headers.indexOf('LinkedIn')] || ''}</td></tr>`;
            table += `<tr><th>Pinterest</th><td>${row[headers.indexOf('Pinterest')] || ''}</td><th>Twitter</th><td>${row[headers.indexOf('Twitter')] || ''}</td><th>YouTube</th><td>${row[headers.indexOf('YouTube')] || ''}</td></tr>`;
            table += `</tbody></table></td></tr>`;
        });
        table += `</tbody></table></div>`;
        
        let pagination = `<nav aria-label="Page navigation"><ul class="pagination justify-content-center">`;
        const maxPagesToShow = 5;
        let startPage = Math.max(page - Math.floor(maxPagesToShow / 2), 1);
        let endPage = Math.min(startPage + maxPagesToShow - 1, totalPages);

        if (endPage - startPage < maxPagesToShow - 1) {
            startPage = Math.max(endPage - maxPagesToShow + 1, 1);
        }

        if (startPage > 1) {
            pagination += `<li class="page-item"><a class="page-link" href="#" onclick="loadTeamList(1, '${filterState}', '${minSales}', '${minReviews}')">First</a></li>`;
            pagination += `<li class="page-item"><a class="page-link" href="#" onclick="loadTeamList(${page - 1}, '${filterState}', '${minSales}', '${minReviews}')">Previous</a></li>`;
        }

        for (let i = startPage; i <= endPage; i++) {
            pagination += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" onclick="loadTeamList(${i}, '${filterState}', '${minSales}', '${minReviews}')">${i}</a></li>`;
        }

        if (endPage < totalPages) {
            pagination += `<li class="page-item"><a class="page-link" href="#" onclick="loadTeamList(${page + 1}, '${filterState}', '${minSales}', '${minReviews}')">Next</a></li>`;
            pagination += `<li class="page-item"><a class="page-link" href="#" onclick="loadTeamList(${totalPages}, '${filterState}', '${minSales}', '${minReviews}')">Last</a></li>`;
        }

        pagination += `</ul></nav>`;

        document.getElementById('teamList').innerHTML = table + pagination;
    });
}

function toggleDetails(index) {
    const detailsRow = document.getElementById(`details-${index}`);
    if (detailsRow.style.display === 'none') {
        detailsRow.style.display = '';
    } else {
        detailsRow.style.display = 'none';
    }
}

function showCreateForm() {
    document.getElementById('createForm').innerHTML = `
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    `;
    document.getElementById('createForm').style.display = 'block';
}

function hideCreateForm() {
    document.getElementById('createForm').style.display = 'none';
    document.getElementById('createForm').innerHTML = '';
}

function showMessage(message) {
    const messageDiv = document.getElementById('message');
    messageDiv.innerHTML = `<div class="alert alert-success">${message}</div>`;
    setTimeout(() => {
        messageDiv.innerHTML = '';
    }, 3000);
}

function saveRow(index) {
    const row = document.getElementById(`row-${index}`);
    const cells = row.querySelectorAll('td[contenteditable="true"]');
    const updatedData = { id: row.getAttribute('data-id') };

    cells.forEach(cell => {
        const header = cell.getAttribute('data-header');
        updatedData[header] = cell.textContent;
    });

    fetch('../includes/update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updatedData)
    })
    .then(response => response.json())
    .then(data => {
        showMessage(data.message);
        if (data.status === 'success') {
            loadTeamList(1); // Reload the first page after saving
        }
    });
}
