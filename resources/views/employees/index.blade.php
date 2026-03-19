<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Kanit', sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            border: none;
            border-radius: 50px;
            padding: 8px 15px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
            border: none;
            border-radius: 50px;
            padding: 8px 15px;
            font-weight: 600;
            font-size: 0.875rem;
            color: #212529;
        }
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            border-radius: 50px;
            padding: 8px 15px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table thead th {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            border: none;
            font-weight: 600;
        }
        .table tbody tr {
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
            transform: scale(1.01);
        }
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .action-buttons .btn {
            margin: 0 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="mb-0"><i class="bi bi-people me-2"></i> จัดการพนักงาน</h2>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                         <a href="/time-attendances" class="btn btn-info">
                            <i class="bi bi-house-door me-1"></i> กลับ
                        </a>
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus me-1"></i> เพิ่มพนักงานใหม่
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('time_attendances.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-clock-history me-1"></i> บันทึกเวลาเข้า-ออกงาน
                        </a>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash me-1"></i> ID</th>
                                <th><i class="bi bi-person me-1"></i> ชื่อพนักงาน</th>
                                <th><i class="bi bi-briefcase me-1"></i> ตำแหน่ง</th>
                                <th><i class="bi bi-toggle-on me-1"></i> สถานะ</th>
                                <th><i class="bi bi-gear me-1"></i> การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>
                                        @if($employee->status == 'active')
                                            <span class="badge bg-success">ใช้งาน</span>
                                        @else
                                            <span class="badge bg-secondary">ไม่ใช้งาน</span>
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบพนักงานคนนี?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        <i class="bi bi-inbox me-2"></i> ไม่พบข้อมูลพนักงาน
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        แสดงข้อมูล {{ count($employees) }} รายการ
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
