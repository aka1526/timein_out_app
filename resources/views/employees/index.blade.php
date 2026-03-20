<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการพนักงาน</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            min-width: 35px;
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

            .action-buttons .btn {
                padding: 5px 8px;
                font-size: 0.8rem;
                min-width: 30px;
            }

            .navigation-menu .btn {
                font-size: 0.8rem;
                padding: 12px 8px;
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navigation-menu .btn i {
                margin-right: 5px;
                font-size: 1rem;
            }

            .navigation-menu .btn.active {
                box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
                transform: scale(1.02);
            }
        }

        /* Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) and (max-width: 992px) {
            .navigation-menu .btn {
                font-size: 0.9rem;
                padding: 10px 15px;
            }

            .action-buttons .btn {
                min-width: 40px;
            }
        }

        /* Extra small devices (phones, 320px and down) */
        @media (max-width: 320px) {
            .navigation-menu .btn {
                font-size: 0.7rem;
                padding: 10px 5px;
            }

            .navigation-menu .btn i {
                font-size: 0.9rem;
                margin-right: 3px;
            }

            .action-buttons .btn {
                padding: 4px 6px;
                font-size: 0.7rem;
                min-width: 25px;
            }
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

                <div class="navigation-menu mb-4">
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <a href="/" class="btn btn-info flex-fill">
                                    <i class="bi bi-house-door me-1"></i> <span class="d-sm-inline">หน้าหลัก</span>
                                </a>


                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <a href="{{ route('employees.create') }}" class="btn btn-primary w-100">
                                <i class="bi bi-person-plus me-1"></i> เพิ่มพนักงานใหม่
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="d-none d-md-table-cell"><i class="bi bi-hash me-1"></i> ID</th>
                                <th><i class="bi bi-person me-1"></i> ชื่อพนักงาน</th>
                                <th class="d-none d-md-table-cell"><i class="bi bi-briefcase me-1"></i> ตำแหน่ง</th>
                                <th><i class="bi bi-toggle-on me-1"></i> สถานะ</th>
                                <th><i class="bi bi-gear me-1"></i> การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td class="d-none d-md-table-cell">{{ $employee->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>{{ $employee->name }}</span>
                                            <small class="text-muted d-md-none">{{ $employee->position }}</small>
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">{{ $employee->position }}</td>
                                    <td>
                                        @if($employee->status == 'active')
                                            <span class="badge bg-success">ใช้งาน</span>
                                        @else
                                            <span class="badge bg-secondary">ไม่ใช้งาน</span>
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm" title="ดูรายละเอียด">
                                            <i class="bi bi-eye"></i>
                                            <span class="d-none d-lg-inline ms-1">ดู</span>
                                        </a>
                                        <button onclick="confirmEdit('{{ $employee->id }}')" class="btn btn-warning btn-sm" title="แก้ไข">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-lg-inline ms-1">แก้ไข</span>
                                        </button>
                                        <button onclick="confirmDelete('{{ $employee->id }}')" class="btn btn-danger btn-sm" title="ลบ">
                                            <i class="bi bi-trash"></i>
                                            <span class="d-none d-lg-inline ms-1">ลบ</span>
                                        </button>
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
    <script>
        function confirmEdit(employeeId) {
            const password = prompt('กรุณากรอกรหัสผ่านเพื่อแก้ไขข้อมูลพนักงาน:');
            if (password === '7749') {
                window.location.href = `/employees/${employeeId}/edit`;
            } else if (password !== null) {
                alert('รหัสผ่านไม่ถูกต้อง!');
            }
        }

        function confirmDelete(employeeId) {
            const password = prompt('กรุณากรอกรหัสผ่านเพื่อลบข้อมูลพนักงาน:');
            if (password === '7749') {
                if (confirm('คุณแน่ใจหรือไม่ที่จะลบพนักงานคนนี?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/employees/${employeeId}`;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            } else if (password !== null) {
                alert('รหัสผ่านไม่ถูกต้อง!');
            }
        }
    </script>
</body>
</html>
