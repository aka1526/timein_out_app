<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงเวลาเข้าเช้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Kanit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .main-container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px 30px;
            position: relative;
            overflow: hidden;
        }
        .form-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        }
        .header-icon {
            font-size: 3rem;
            color: #27ae60;
            margin-bottom: 20px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }
        .btn-submit {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            border: none;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            color: #2980b9;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="form-container">
            <div class="header-icon">
                <i class="bi bi-sunrise"></i>
            </div>
            <h1>ลงเวลาเข้าเช้า</h1>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('time_attendances.storeMorningCheckIn') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="employee_id" class="form-label">เลือกพนักงาน</label>
                    <select class="form-select" id="employee_id" name="employee_id" required>
                        <option value="">-- เลือกพนักงาน --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->position }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar3 me-2"></i>
                        <span>วันที่: {{ date('d/m/Y') }}</span>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock me-2"></i>
                        <span id="current-time">เวลา: {{ date('H:i:s') }}</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-submit">
                    <i class="bi bi-check-circle me-2"></i> บันทึกเวลาเข้าเช้า
                </button>
            </form>

            <a href="{{ route('time_attendances.index') }}" class="back-link">
                <i class="bi bi-arrow-left me-1"></i> กลับสู่หน้าหลัก
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('th-TH', { hour12: false });

        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = 'เวลา: ' + timeString;
        }
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
</body>
</html>
