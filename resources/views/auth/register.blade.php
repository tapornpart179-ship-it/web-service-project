<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>สมัครสมาชิก | NewsBit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            font-family: "DM Sans", "Leelawadee UI", sans-serif;
            color: #20352d;
            background: #f4f1e9;
            --deep: #173a30;
            --green: #315b4c;
            --lime: #d5e69a;
            --paper: #f4f1e9;
            --muted: #788078;
            --line: #e6e2d7;
            --white: #fffefa;
        }

        * { box-sizing: border-box; }
        body { min-width: 320px; min-height: 100vh; margin: 0; }
        a { color: inherit; }
        .topline { padding: 11px max(5vw, calc((100vw - 1180px) / 2)); color: #d9e1d4; background: var(--deep); font-size: 11px; letter-spacing: .1em; text-transform: uppercase; }
        .topline strong { color: var(--lime); }
        .page { display: grid; min-height: calc(100vh - 40px); place-items: center; padding: 48px 20px; }
        .register-layout { display: grid; width: min(980px, 100%); grid-template-columns: .9fr 1.1fr; overflow: hidden; border: 1px solid #e2ded2; background: var(--white); box-shadow: 0 24px 70px #1c342516; }
        .intro { position: relative; display: flex; min-height: 620px; flex-direction: column; justify-content: space-between; overflow: hidden; padding: clamp(28px, 5vw, 54px); color: #f8f5e9; background: var(--deep); }
        .intro::before, .intro::after { position: absolute; right: -115px; bottom: 45px; width: 320px; height: 320px; border: 1px solid #ffffff24; border-radius: 50%; content: ""; }
        .intro::after { right: -72px; bottom: 88px; width: 235px; height: 235px; }
        .brand { position: relative; z-index: 1; color: #f8f5e9; font-family: "Playfair Display", Georgia, serif; font-size: 29px; font-weight: 700; letter-spacing: -.06em; text-decoration: none; }
        .brand span { color: var(--lime); }
        .intro-copy { position: relative; z-index: 1; margin: auto 0; }
        .eyebrow { margin: 0 0 17px; color: var(--lime); font-size: 10px; font-weight: 700; letter-spacing: .17em; }
        .intro h1 { margin: 0 0 16px; font-family: "Playfair Display", Georgia, serif; font-size: clamp(34px, 4vw, 49px); font-weight: 600; letter-spacing: -.04em; line-height: 1.15; }
        .intro-copy > p:last-child { max-width: 330px; margin: 0; color: #d0dbd0; font-size: 14px; line-height: 1.8; }
        .intro-footer { position: relative; z-index: 1; color: #b8c8b8; font-size: 11px; letter-spacing: .08em; }
        .form-panel { padding: clamp(28px, 5vw, 54px); }
        .form-heading { margin: 8px 0 26px; }
        .form-heading p { margin: 0 0 7px; color: #718348; font-size: 11px; font-weight: 700; letter-spacing: .15em; }
        .form-heading h2 { margin: 0; color: var(--deep); font-family: "Playfair Display", Georgia, serif; font-size: 30px; font-weight: 600; }
        .field { margin: 16px 0; }
        .field label { display: block; margin-bottom: 7px; color: var(--deep); font-size: 12px; font-weight: 700; }
        .field input { width: 100%; min-height: 45px; padding: 10px 12px; border: 1px solid #d8d8cc; border-radius: 2px; outline: none; background: var(--white); color: #20352d; font: inherit; }
        .field input:focus { border-color: #84965b; box-shadow: 0 0 0 3px #84965b24; }
        .field input::placeholder { color: #a2a69b; }
        .field-error { margin: 6px 0 0; color: #a33c36; font-size: 12px; }
        .form-error { padding: 12px 14px; margin: 18px 0; border-left: 3px solid #a94a42; color: #842f2a; background: #f7e6df; font-size: 13px; }
        .submit-button { width: 100%; min-height: 46px; padding: 11px 16px; margin-top: 8px; border: 1px solid var(--deep); border-radius: 2px; color: #f8f5e9; background: var(--deep); font: inherit; font-size: 13px; font-weight: 700; transition: background .18s, transform .18s; }
        .submit-button:hover { background: var(--green); transform: translateY(-1px); }
        .login-link { margin: 22px 0 0; color: var(--muted); font-size: 13px; text-align: center; }
        .login-link a { color: var(--green); font-weight: 700; text-decoration-thickness: 1px; text-underline-offset: 3px; }
        @media (max-width: 700px) {
            .page { padding: 24px 14px; }
            .register-layout { max-width: 470px; grid-template-columns: 1fr; }
            .intro { min-height: 245px; padding: 25px; }
            .intro-copy { margin: 35px 0 20px; }
            .intro h1 { max-width: 350px; font-size: 36px; }
            .intro-copy > p:last-child { max-width: 380px; }
            .intro-footer { font-size: 10px; }
            .form-panel { padding: 27px 25px 32px; }
            .form-heading { margin-top: 0; }
        }
    </style>
</head>
<body>
    <div class="topline"><strong>NEWSBIT JOURNAL</strong> · Curiosity, collected.</div>
    <main class="page">
        <div class="register-layout">
            <section class="intro">
                <a class="brand" href="{{ url('/') }}">NEWS<span>BIT</span></a>
                <div class="intro-copy">
                    <p class="eyebrow">A LITTLE MORE PERSPECTIVE</p>
                    <h1>เริ่มต้นมุมมอง<br>ใหม่ไปด้วยกัน</h1>
                    <p>สมัครสมาชิกเพื่อร่วมอ่านและจัดการเรื่องราวที่น่าสนใจในโลกดิจิทัล</p>
                </div>
                <div class="intro-footer">INDEPENDENT STORIES · ISSUE 01 / 2026</div>
            </section>

            <section class="form-panel">
                <div class="form-heading">
                    <p>JOIN THE JOURNAL</p>
                    <h2>สร้างบัญชีใหม่</h2>
                </div>

                @if ($errors->any())
                    <div class="form-error" role="alert">
                        <p>กรุณาตรวจสอบข้อมูลที่กรอก</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="name">ชื่อที่ใช้แสดง</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="เช่น สมชาย ใจดี" autocomplete="name" required autofocus>
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">อีเมล</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required>
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">รหัสผ่าน</label>
                        <input id="password" name="password" type="password" placeholder="อย่างน้อย 8 ตัวอักษร" autocomplete="new-password" required>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="กรอกรหัสผ่านอีกครั้ง" autocomplete="new-password" required>
                    </div>

                    <button class="submit-button" type="submit">สมัครสมาชิก</button>
                </form>

                <p class="login-link">มีบัญชีอยู่แล้ว? <a href="{{ route('login') }}">เข้าสู่ระบบ</a></p>
            </section>
        </div>
    </main>
</body>
</html>
