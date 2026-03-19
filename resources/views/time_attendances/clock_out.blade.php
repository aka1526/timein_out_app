<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงเวลาออกงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        }
        .card-header {
            background: linear-gradient(135deg, #2c3e50 0%, #e74c3c 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .btn-warning {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
        }
        .btn-secondary {
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
        }
        .select2-container--default .select2-selection--single {
            height: 40px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
            padding-left: 15px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0"><i class="bi bi-box-arrow-right me-2"></i> ลงเวลาออกงาน</h3>
                    </div>
                    <div class="card-body p-4">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-4 p-3 bg-light rounded">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-1">วันที่</h5>
                                    <p class="mb-0 fs-5" id="current-date">{{ date('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-1">เวลา</h5>
                                    <p class="mb-0 fs-5" id="current-time">{{ date('H:i:s') }}</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('time_attendances.updateClockOut') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="employee_id" class="form-label fw-bold">เลือกพนักงาน</label>
                                <select class="form-select" id="employee_id" name="employee_id" required>
                                    <option value="">-- เลือกพนักงาน --</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->position }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('time_attendances.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-1"></i> ยกเลิก
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-box-arrow-right me-1"></i> ลงเวลาออกงาน
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employee_id').select2({
                placeholder: '-- เลือกพนักงาน --',
                allowClear: true,
                language: {
                    noResults: function() {
                        return 'ไม่พบข้อมูล';
                    },
                    searching: function() {
                        return 'กำลังค้นหา...';
                    }
                }
            });

            // Update current time
            function updateTime() {
                const now = new Date();
                const date = now.toLocaleDateString('th-TH', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                const time = now.toLocaleTimeString('th-TH', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                $('#current-date').text(date);
                $('#current-time').text(time);
            }

            // Update time immediately and then every second
            updateTime();
            setInterval(updateTime, 1000);
        });
    </script>
</body>
</html>
