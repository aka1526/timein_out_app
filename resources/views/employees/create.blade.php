<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มพนักงานใหม่</title>
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
        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0"><i class="bi bi-person-plus me-2"></i> เพิ่มพนักงานใหม่</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('employees.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="กรอกชื่อ-นามสกุลพนักงาน" required>
                                </div>
                                @error('name')
                                    <div class="text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">ตำแหน่ง</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                                    <select class="form-select" id="position" name="position" required>
                                        <option value="">-- เลือกตำแหน่ง --</option>
                                        <option value="ข้าราชการ">ข้าราชการ</option>
                                        <option value="พนักงานจ้างเหมา">พนักงานจ้างเหมา</option>
                                        <option value="พนักงานราชการ">พนักงานราชการ</option>
                                    </select>
                                </div>
                                @error('position')
                                    <div class="text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">สถานะ</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active">ใช้งาน</option>
                                        <option value="inactive">ไม่ใช้งาน</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-1"></i> ยกเลิก
                                </a>
                                <a href="/" class="btn btn-info">
                                    <i class="bi bi-house-door me-1"></i> หน้าหลัก
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
