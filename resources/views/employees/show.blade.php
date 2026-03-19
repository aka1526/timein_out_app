<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดพนักงาน</title>
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
        .card-body {
            padding: 25px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
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
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
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
        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .detail-label {
            font-weight: 600;
            color: #2c3e50;
            width: 150px;
        }
        .detail-value {
            color: #34495e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0"><i class="bi bi-person-badge me-2"></i> รายละเอียดพนักงาน</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="profile-img">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <h4 class="mt-2 mb-0">{{ $employee->name }}</h4>
                            <p class="text-muted">{{ $employee->position }}</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="detail-label"><i class="bi bi-hash me-2"></i>รหัสพนักงาน:</td>
                                    <td class="detail-value">{{ $employee->id }}</td>
                                </tr>
                                <tr>
                                    <td class="detail-label"><i class="bi bi-person me-2"></i>ชื่อ-นามสกุล:</td>
                                    <td class="detail-value">{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <td class="detail-label"><i class="bi bi-briefcase me-2"></i>ตำแหน่ง:</td>
                                    <td class="detail-value">{{ $employee->position }}</td>
                                </tr>
                                <tr>
                                    <td class="detail-label"><i class="bi bi-toggle-on me-2"></i>สถานะ:</td>
                                    <td class="detail-value">
                                        @if($employee->status == 'active')
                                            <span class="badge bg-success">ใช้งาน</span>
                                        @else
                                            <span class="badge bg-secondary">ไม่ใช้งาน</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="detail-label"><i class="bi bi-calendar-plus me-2"></i>วันที่สร้าง:</td>
                                    <td class="detail-value">{{ \Carbon\Carbon::parse($employee->created_at)->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="detail-label"><i class="bi bi-calendar-check me-2"></i>วันที่อัปเดต:</td>
                                    <td class="detail-value">{{ \Carbon\Carbon::parse($employee->updated_at)->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div>
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary me-2">
                                    <i class="bi bi-arrow-left me-1"></i> กลับหน้ารายการ
                                </a>
                                <a href="/" class="btn btn-info">
                                    <i class="bi bi-house-door me-1"></i> หน้าหลัก
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil me-1"></i> แก้ไขข้อมูล
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
