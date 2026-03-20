<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกเวลาปฏิบัติงาน</title>
        <link type="image/png" sizes="16x16" rel="icon" href="./icons8-time-machine-16.png">
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
            border-left: 4px solid #3498db;
        }

        .export-form .form-label {
            color: #2c3e50;
            font-size: 0.9rem;
        }

        .export-form .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .export-form .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .export-form .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .export-form .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Mobile responsive styles */
        @media (max-width: 768px) {
            body {
                padding: 10px 0;
            }

            .container {
                padding: 0 10px;
            }

            .card {
                margin-bottom: 15px;
            }

            .card-header {
                padding: 15px;
            }

            .card-header h2 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 15px;
            }

            .btn {
                font-size: 0.9rem;
                padding: 8px 12px;
                margin-bottom: 5px;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th {
                font-size: 0.8rem;
                padding: 8px 5px;
            }

            .table tbody td {
                padding: 8px 5px;
            }

            .badge {
                font-size: 0.75rem;
                padding: 3px 6px;
            }

            .export-form {
                padding: 10px;
            }

            .d-flex justify-content-between {
                flex-direction: column;
                gap: 10px;
            }

            .d-flex justify-content-between > div {
                width: 100%;
            }

            .d-flex justify-content-between a {
                width: 100%;
                margin-bottom: 5px;
            }

            .navigation-menu .btn {
                font-size: 0.8rem;
                padding: 10px 5px;
                border-radius: 20px;
            }

            .navigation-menu .btn i {
                display: block;
                margin: 0 auto 5px;
                font-size: 1rem;
            }
        }

        /* Extra small devices (phones, 320px and down) */
        @media (max-width: 320px) {
            .navigation-menu .btn {
                font-size: 0.7rem;
                padding: 8px 4px;
            }

            .navigation-menu .btn i {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="mb-0"><i class="bi bi-clock-history me-2"></i> บันทึกเวลาปฏิบัติงาน</h2>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('time_attendances.morning_check_in') }}" class="btn btn-success flex-fill">
                                <i class="bi bi-sunrise me-1"></i> ลงเวลาเข้าเช้า
                            </a>
                            <a href="{{ route('time_attendances.afternoon_check_in') }}" class="btn btn-warning flex-fill">
                                <i class="bi bi-sun me-1"></i> ลงเวลาเข้าบ่าย
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="export-form p-3 rounded bg-light">
                            <form action="{{ route('time_attendances.export') }}" method="GET">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label for="start_date" class="form-label fw-bold">จากวันที่</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_date" class="form-label fw-bold">ถึงวันที่</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-file-earmark-excel me-2"></i> ส่งออก Excel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                <th><i class="bi bi-clock me-1"></i> เวลา</th>
                                <th><i class="bi bi-tag me-1"></i> ประเภท</th>
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
                                        @if($attendance->status == 'morning')
                                            <span class="badge bg-success">เข้าเช้า</span>
                                        @elseif($attendance->status == 'afternoon')
                                            <span class="badge bg-danger">เข้าบ่าย</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $attendance->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">ลงเวลาแล้ว</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">
                                        <i class="bi bi-inbox me-2"></i> ไม่พบข้อมูลบันทึกเวลาปฏิบัติงาน
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="navigation-menu mt-4">
                    <div class="row g-2">
                        <div class="col-12 text-center mb-2">
                            <div class="text-muted small">
                                <i class="bi bi-info-circle me-1"></i>
                                แสดงข้อมูล {{ count($attendances) }} รายการ
                            </div>
                        </div>
                        <div class="col-6">
                            <a href="/" class="btn btn-warning w-100">
                                <i class="bi bi-house-door me-1"></i> หน้าหลัก
                            </a>
                        </div>

                        <div class="col-6">
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-people me-1"></i> จัดการพนักงาน
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
