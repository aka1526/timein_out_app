<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกเวลาเข้า-ออกงาน</title>
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
        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            color: #212529;
        }
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
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
        .export-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="mb-0"><i class="bi bi-clock-history me-2"></i> บันทึกเวลาเข้า-ออกงาน</h2>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex gap-2">
                            <a href="{{ route('time_attendances.clock_in') }}" class="btn btn-success">
                                <i class="bi bi-box-arrow-in-right me-1"></i> ลงเวลาเข้างาน
                            </a>
                            <a href="{{ route('time_attendances.clock_out') }}" class="btn btn-warning">
                                <i class="bi bi-box-arrow-right me-1"></i> ลงเวลาออกงาน
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('time_attendances.export') }}" method="GET" class="export-form">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <label for="start_date" class="form-label small mb-0">จากวันที่</label>
                                    <input type="date" name="start_date" class="form-control form-control-sm" required>
                                </div>
                                <div class="col">
                                    <label for="end_date" class="form-label small mb-0">ถึงวันที่</label>
                                    <input type="date" name="end_date" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-auto">
                                    <label class="form-label small mb-0">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-sm d-block">
                                        <i class="bi bi-file-earmark-excel me-1"></i> ส่งออก Excel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="bi bi-hash me-1"></i> ID</th>
                                <th><i class="bi bi-person me-1"></i> พนักงาน</th>
                                <th><i class="bi bi-briefcase me-1"></i> ตำแหน่ง</th>
                                <th><i class="bi bi-calendar me-1"></i> วันที่</th>
                                <th><i class="bi bi-door-open me-1"></i> เวลาเข้า</th>
                                <th><i class="bi bi-door-closed me-1"></i> เวลาออก</th>
                                <th><i class="bi bi-info-circle me-1"></i> สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->employee->name }}</td>
                                    <td>{{ $attendance->employee->position }}</td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($attendance->time_in)
                                            <span class="text-success">{{ \Carbon\Carbon::parse($attendance->time_in)->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->time_out)
                                            <span class="text-primary">{{ \Carbon\Carbon::parse($attendance->time_out)->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->status == 'present')
                                            <span class="badge bg-success">มาปฏิบัติงาน</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $attendance->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="bi bi-inbox me-2"></i> ไม่พบข้อมูลบันทึกเวลาเข้า-ออกงาน
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        <i class="bi bi-info-circle me-1"></i>
                        แสดงข้อมูล {{ count($attendances) }} รายการ
                    </div>
                    <div>
                         <a href="/" class="btn btn-primary">
                            <i class="bi bi-house-door me-1"></i> หน้าหลัก
                        </a>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                            <i class="bi bi-people me-1"></i> จัดการพนักงาน
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
