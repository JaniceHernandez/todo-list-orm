<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TODO List')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --violet: #9b59b6;
            --violet-dark: #8e44ad;
            --purple: #6c3483;
            --purple-light: #c77dff;
            --soft-bg: #f8f4fc;
            --white: #ffffff;
            --slate: #64748b;
            --border: #e2e0db;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --radius: 4px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--soft-bg);
            color: var(--purple);
            font-size: 14px;
            line-height: 1.6;
        }
        .topbar {
            background: linear-gradient(135deg, var(--violet), var(--purple));
            border-bottom: 3px solid var(--violet-dark);
            margin-bottom: 30px;
        }
        .topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
        }
        .brand {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        .brand span { color: var(--purple-light); }
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 2px 16px rgba(106,13,173,.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .card-header {
            background: linear-gradient(120deg, var(--violet), var(--purple));
            color: white;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header h3 {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 600;
        }
        .card-header h3 i { margin-right: 8px; }
        .card-body { padding: 20px; }
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }
        table thead th {
            background: #f4f0fa;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--slate);
            padding: 12px 16px;
            border-bottom: 2px solid var(--border);
        }
        table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f0ede7;
            vertical-align: middle;
        }
        table tbody tr:hover td { background: #faf7ff; }
        .priority-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            font-family: 'DM Mono', monospace;
        }
        .priority-urgent-and-important { background: #f8d7da; color: #721c24; }
        .priority-important-but-not-urgent { background: #fff3cd; color: #856404; }
        .priority-urgent-but-not-important { background: #d1ecf1; color: #0c5460; }
        .priority-not-urgent-or-important { background: #d4edda; color: #155724; }
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 600;
            font-family: 'DM Mono', monospace;
            text-transform: uppercase;
        }
        .status-todo { background: #f8d7da; color: #721c24; }
        .status-in-progress { background: #cfe2ff; color: #004085; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-submitted { background: #e9ecef; color: #495057;}
        .nav-tabs { border-bottom: 1px solid var(--border); margin-bottom: 24px; }
        .nav-tabs > li.active > a {
            background: var(--white);
            border: 1px solid var(--border);
            border-bottom-color: transparent;
            color: var(--violet);
            font-weight: 600;
        }
        .nav-tabs > li > a {
            color: var(--slate);
            font-size: 13px;
            padding: 10px 20px;
        }
        .btn-primary {
            background: var(--violet);
            border-color: var(--violet-dark);
        }
        .btn-primary:hover { background: var(--violet-dark); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .alert {
            border-left: 4px solid;
            border-radius: var(--radius);
        }
        .alert-success { border-color: var(--success); background: #f0fdf4; }
        .alert-danger { border-color: var(--danger); background: #fef2f2; }
        .card-footer {
            background: #faf9f6;
            border-top: 1px solid var(--border);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pagination > .active > a { background: var(--violet); border-color: var(--violet); }
        .clickable-task {
            cursor: pointer;
            color: var(--violet);
            text-decoration: none;
        }
        .clickable-task:hover {
            text-decoration: underline;
            color: var(--violet-dark);
        }
        .filter-section {
            background: #faf7ff;
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            border: 1px solid var(--border);
        }
        .modal-content {
            border-radius: var(--radius);
        }
        .modal-header {
            background: linear-gradient(120deg, var(--violet), var(--purple));
            color: white;
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .modal-header .close {
            color: white;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="topbar-inner">
            <a href="{{ route('tasks.index', ['status' => 'todo']) }}" class="brand">Todo<span> List</span></a>

        </div>
    </div>

    <div class="container" style="max-width: 1200px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        function showDescription(taskName, description) {
            $('#modalTaskName').text(taskName);
            $('#modalDescription').text(description || 'No description provided.');
            $('#descriptionModal').modal('show');
        }
    </script>

    @stack('scripts')
</body>
</html>
