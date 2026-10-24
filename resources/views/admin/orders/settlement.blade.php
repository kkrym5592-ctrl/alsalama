<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AL SALAMA - التسويات</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #0b0b0d;
            --panel: #151518;
            --panel-2: #1d1d21;
            --red: #e63946;
            --red-hover: #c92e3a;
            --text: #f5f5f5;
            --muted: #a1a1aa;
            --border: #333338;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
            padding: 24px 14px;
        }

        .settlement-container {
            width: 100%;
            max-width: 650px;
            margin: 25px auto;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--red);
            border-radius: 14px;
            font-size: 21px;
        }

        .brand h1 {
            font-size: 21px;
            font-weight: 800;
            margin: 0 0 5px;
        }

        .brand p {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--panel-2);
            color: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 11px 14px;
            text-decoration: none;
            white-space: nowrap;
        }

        .back-btn:hover {
            background: #29292e;
            color: white;
        }

        .settlement-card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #351316, #1b1113);
            border-bottom: 1px solid #482126;
            padding: 23px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 800;
            margin: 0 0 8px;
        }

        .card-header p {
            color: #c7a5a8;
            margin: 0;
            font-size: 13px;
        }

        .card-body {
            padding: 24px;
        }

        .form-label {
            display: block;
            color: #eeeeef;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-control {
            background: #101013;
            border: 1px solid var(--border);
            color: white;
            border-radius: 10px;
            padding: 13px 14px;
            min-height: 48px;
        }

        .form-control:focus {
            background: #101013;
            color: white;
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgb(230 57 70 / 15%);
        }

        .form-control::placeholder {
            color: #777780;
        }

        input[type="number"] {
            direction: ltr;
            text-align: right;
        }

        .form-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 7px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-save {
            flex: 1;
            background: var(--red);
            color: white;
            border: 0;
            border-radius: 11px;
            padding: 14px;
            font-weight: 800;
            min-height: 50px;
        }

        .btn-save:hover {
            background: var(--red-hover);
            color: white;
        }

        .btn-cancel {
            background: #27272b;
            color: white;
            border: 1px solid var(--border);
            border-radius: 11px;
            padding: 14px 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #333338;
            color: white;
        }

        .alert {
            border-radius: 10px;
        }

        .alert-danger {
            background: #351316;
            border-color: #64252c;
            color: #ffb8bf;
        }

        @media (max-width: 480px) {
            body {
                padding: 12px;
            }

            .settlement-container {
                margin: 12px auto;
            }

            .brand h1 {
                font-size: 17px;
            }

            .brand-icon {
                width: 42px;
                height: 42px;
            }

            .card-header,
            .card-body {
                padding: 18px;
            }

            .back-btn {
                padding: 10px;
                font-size: 13px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel {
                min-height: 48px;
            }
        }
    </style>
</head>

<body>

<div class="settlement-container">

    <div class="top-bar">
        <div class="brand">
            <div class="brand-icon">
                <i class="fas fa-scale-balanced"></i>
            </div>

            <div>
                <h1>AL SALAMA</h1>
                <p>إدارة تسويات الطلبات</p>
            </div>
        </div>

        <a href="{{ route('admin.orders.create') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i>
            رجوع
        </a>
    </div>

    <div class="settlement-card">

        <div class="card-header">
            <h2>
                <i class="fas fa-receipt ms-2"></i>
                تسوية جديدة
            </h2>
            <p>أدخل بيانات التسوية ثم اضغط حفظ.</p>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>راجع البيانات التالية:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form
                action="{{ route('admin.orders.settlements.store') }}"
                method="POST"
            >
                @csrf

                <div class="mb-4">
                    <label for="settlement_name" class="form-label">
                        اسم التسوية
                    </label>

                    <input
                        type="text"
                        name="settlement_name"
                        id="settlement_name"
                        class="form-control"
                        placeholder="اكتب اسم التسوية"
                        value="{{ old('settlement_name') }}"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="settlement_weight" class="form-label">
                        الوزن
                    </label>

                    <input
                        type="text"
                        name="settlement_weight"
                        id="settlement_weight"
                        class="form-control"
                        placeholder="0.00"
                        value="{{ old('settlement_weight') }}"
                        min="0"
                        step="0.001"
                        required
                    >

                    <div class="form-text">
                        أدخل الوزن حسب وحدة القياس التي تستخدمها.
                    </div>
                </div>

                <div class="mb-4">
                    <label for="settlement_price" class="form-label">
                        السعر
                    </label>

                    <input
                        type="text"
                        name="settlement_price"
                        id="settlement_price"
                        class="form-control"
                        placeholder="0.00"
                        value="{{ old('settlement_price') }}"
                        min="0"
                        step="0.01"
                        required
                    >

                    <div class="form-text">
                        أدخل قيمة التسوية بالجنيه المصري.
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save ms-2"></i>
                        حفظ التسوية
                    </button>

                    <a
                        href="{{ route('admin.orders.create') }}"
                        class="btn-cancel"
                    >
                        إلغاء
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

</body>
</html>
