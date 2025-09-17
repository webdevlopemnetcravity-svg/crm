<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Immigrations</title>
    <style>
        body { 
            font-family: system-ui, sans-serif; 
            background:#f1f5f9; 
            color:#111; 
            padding:40px; 
        }
        h1 { 
            margin-bottom:20px; 
            font-size:28px; 
            font-weight:700; 
        }
        a.btn, button.btn {
            display:inline-block; 
            padding:8px 14px; 
            border-radius:8px;
            text-decoration:none; 
            font-size:14px; 
            font-weight:600;
            border:none; 
            cursor:pointer;
            transition:.2s;
        }
        a.btn-primary { background:#2563eb; color:#fff; }
        a.btn-primary:hover { background:#1d4ed8; }
        button.btn-danger { background:#ef4444; color:#fff; }
        button.btn-danger:hover { background:#dc2626; }
        a.btn-edit { background:#60a5fa; color:#111; }
        a.btn-edit:hover { background:#3b82f6; color:#fff; }
        .table { width:100%; border-collapse:collapse; margin-top:20px; }
        .table th { 
            background:#e2e8f0; 
            padding:12px; 
            text-align:left; 
            font-weight:600; 
            font-size:14px; 
            text-transform:uppercase; 
        }
        .table td { 
            background:#fff; 
            padding:14px; 
            border-bottom:1px solid #ddd; 
        }
        .row-actions { display:flex; gap:8px; }
        .badge {
            display:inline-block; 
            padding:4px 10px; 
            border-radius:999px; 
            font-size:12px; 
            font-weight:600;
        }
        .badge-pending { background:#fef3c7; color:#92400e; }
        .badge-approved { background:#d1fae5; color:#065f46; }
        .badge-rejected { background:#fee2e2; color:#991b1b; }
    </style>
</head>
<body>

    <h1>Immigration List</h1>

    <p>
        <a href="{{ route('immigrations.create') }}" class="btn btn-primary">+ New Immigration</a>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Applicant</th>
                <th>Passport</th>
                <th>Visa Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dummy Data Rows -->
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>M1234567</td>
                <td>Work Visa</td>
                <td><span class="badge badge-pending">Pending</span></td>
                <td class="row-actions">
                    <a href="#" class="btn btn-edit">Edit</a>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>N7654321</td>
                <td>Student Visa</td>
                <td><span class="badge badge-approved">Approved</span></td>
                <td class="row-actions">
                    <a href="#" class="btn btn-edit">Edit</a>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Raj Patel</td>
                <td>IND998877</td>
                <td>Tourist Visa</td>
                <td><span class="badge badge-rejected">Rejected</span></td>
                <td class="row-actions">
                    <a href="#" class="btn btn-edit">Edit</a>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
