<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงเวลาปฏิบัติงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

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
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
        }

        .header-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 40px 30px;
            margin-bottom: 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-box::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.9);
        }

        h1 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        h2 {
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .time-slots {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin: 25px 0;
            position: relative;
        }

        .time-slots::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--secondary-color);
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .time-slot {
            display: flex;
            align-items: center;
            margin: 15px 0;
            font-size: 1.2rem;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .time-slot:hover {
            transform: translateX(5px);
            background-color: #e9ecef;
        }

        .time-slot i {
            margin-right: 15px;
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        .note-box {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
            border-left: 5px solid var(--warning-color);
            padding: 25px;
            margin: 25px 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            position: relative;
        }

        .note-box::before {
            content: "\f06a";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--warning-color);
            font-size: 1.5rem;
            opacity: 0.7;
        }

        h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 1.5rem;
        }

        h4 {
            color: var(--warning-color);
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .action-buttons {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-check {
            font-size: 1.3rem;
            font-weight: 600;
            padding: 15px 40px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            z-index: 2;
            cursor: pointer !important;
        }

        .btn-check::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.2);
            transition: all 0.5s ease;
            z-index: 1;
        }

        .btn-check:hover::before {
            left: 100%;
        }

        .btn-check:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(0,0,0,0.3);
        }

        .btn-check-in {
            background: linear-gradient(135deg, var(--success-color) 0%, #2ecc71 100%);
            border: none;
            color: white;
        }

        .btn-check-out {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c0392b 100%);
            border: none;
            color: white;
        }

        .btn-check i {
            margin-right: 10px;
        }

        .secondary-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-secondary-action {
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .current-time {
            text-align: center;
            margin: 20px 0;
            font-size: 1.2rem;
            color: var(--primary-color);
            font-weight: 500;
        }

        .current-time span {
            background: white;
            padding: 8px 15px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="header-box">
            <div class="header-content">

                <h1>ลงเวลาปฏิบัติงาน</h1>
                <h2>สำหรับเจ้าหน้าที่ ปฏิบัติงานที่บ้านพัก</h2>
            </div>
        </div>

        <div class="current-time">
            <span><i class="bi bi-calendar3"></i> {{ date('d/m/Y') }} | <i class="bi bi-clock"></i> {{ date('H:i:s') }}</span>
        </div>

        <div class="time-slots">
            <h3><i class="bi bi-person-badge"></i> เรียน เจ้าหน้าที่ กวอ. ทุกท่าน</h3>
            <p>เมื่อพร้อมปฏิบัติราชการตามรอบเวลา</p>

            <div class="time-slot">
                <i class="bi bi-sunrise"></i>
                <strong>ตามรอบเวลา 07.30 - 15.30 น.</strong>
            </div>
            <div class="time-slot">
                <i class="bi bi-sun"></i>
                <strong>ตามรอบเวลา 08.30 - 16.30 น.</strong>
            </div>
            <div class="time-slot">
                <i class="bi bi-sunset"></i>
                <strong>ตามรอบเวลา 09.30 - 17.30 น.</strong>
            </div>
        </div>



        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="action-buttons">
            <button onclick="window.location.href='{{ route('time_attendances.clock_in') }}'" style="background: linear-gradient(135deg, var(--success-color) 0%, #2ecc71 100%); border: none; color: white; font-size: 1.3rem; font-weight: 600; padding: 15px 40px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;">
                <i class="bi bi-box-arrow-in-right"></i> CHECK IN
            </button>
            <button onclick="window.location.href='{{ route('time_attendances.clock_out') }}'" style="background: linear-gradient(135deg, var(--danger-color) 0%, #c0392b 100%); border: none; color: white; font-size: 1.3rem; font-weight: 600; padding: 15px 40px; border-radius: 50px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; margin-left: 20px;">
                <i class="bi bi-box-arrow-right"></i> CHECK OUT
            </button>
        </div>

        <div class="secondary-buttons">
            <a href="{{ route('time_attendances.index') }}" class="btn btn-outline-secondary btn-secondary-action">
                <i class="bi bi-list-ul"></i> ดูประวัติการลงเวลา
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-primary btn-secondary-action">
                <i class="bi bi-people"></i> จัดการข้อมูลพนักงาน
            </a>
        </div>
         <div class="note-box">
            <h4><i class="bi bi-exclamation-triangle"></i> หมายเหตุ</h4>
            <p>ขอให้เจ้าหน้าที่ กวอ. ทุกท่าน ลงเวลาปฏิบัติราชการแต่ละรอบไม่เกินเวลาที่กำหนด</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update time every second
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('th-TH', { hour12: false });
            const dateString = now.toLocaleDateString('th-TH', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            }).replace(/\//g, '/');

            const timeElement = document.querySelector('.current-time span');
            if (timeElement) {
                timeElement.innerHTML = '<i class="bi bi-calendar3"></i> ' + dateString + ' | <i class="bi bi-clock"></i> ' + timeString;
            }
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>
</html>
