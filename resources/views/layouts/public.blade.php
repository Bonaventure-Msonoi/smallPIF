<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        :root {
            --bg: #f6f4ef;
            --surface: #ffffff;
            --text: #121614;
            --muted: #5b645f;
            --accent: #1f6b4d;
            --accent-hover: #18553d;
            --border: #d9d5c9;
            --ring: rgba(31, 107, 77, 0.25);
            --danger: #b42318;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: radial-gradient(1200px 600px at 15% -10%, rgba(31,107,77,0.12), transparent 60%),
                        radial-gradient(900px 500px at 85% 10%, rgba(210,158,38,0.10), transparent 55%),
                        var(--bg);
            color: var(--text);
        }
        .wrap { max-width: 980px; margin: 0 auto; padding: 28px 18px 56px; }
        .topbar { display:flex; align-items:center; justify-content:space-between; gap: 16px; margin-bottom: 18px; }
        .brand { font-weight: 600; letter-spacing: -0.02em; }
        .topbar a { color: var(--muted); text-decoration: none; font-size: 14px; }
        .topbar a:hover { color: var(--text); }
        .grid { display:grid; grid-template-columns: 1.05fr 0.95fr; gap: 18px; align-items:start; }
        @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(18, 22, 20, 0.06);
            overflow: hidden;
        }
        .card-hd { padding: 18px 18px 10px; border-bottom: 1px solid rgba(0,0,0,0.05); }
        h1 { margin: 0; font-size: 18px; font-weight: 600; letter-spacing: -0.02em; }
        .lede { margin: 6px 0 0; color: var(--muted); font-size: 14px; }
        .card-bd { padding: 18px; }
        .hint { font-size: 12px; color: var(--muted); margin-top: 6px; }
        .alert {
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 12px;
            border: 1px solid rgba(0,0,0,0.06);
            background: rgba(31,107,77,0.08);
            color: #154e38;
        }
        .alert-error {
            background: rgba(180,35,24,0.08);
            color: #7a1a12;
            border-color: rgba(180,35,24,0.18);
        }
        .row { display:grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        @media (max-width: 540px) { .row { grid-template-columns: 1fr; } }
        label { display:block; font-size: 12px; font-weight: 600; color: var(--muted); margin: 0 0 6px; }
        input, select, textarea {
            width: 100%;
            border: 1px solid var(--border);
            background: #fbfbf9;
            padding: 10px 11px;
            border-radius: 10px;
            font: inherit;
            font-size: 14px;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: rgba(31, 107, 77, 0.55);
            box-shadow: 0 0 0 4px var(--ring);
            background: #ffffff;
        }
        textarea { min-height: 84px; resize: vertical; }
        .field { margin-bottom: 12px; }
        .error { font-size: 12px; color: var(--danger); margin-top: 6px; }
        .btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap: 8px;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }
        .btn:hover { background: var(--accent-hover); }
        .btn-secondary {
            background: transparent;
            border-color: var(--border);
            color: var(--text);
        }
        .btn-secondary:hover { background: rgba(0,0,0,0.03); }
        .aside { padding: 18px; }
        .aside h2 { margin: 0 0 8px; font-size: 14px; font-weight: 700; color: var(--text); }
        .aside ul { margin: 0; padding-left: 18px; color: var(--muted); font-size: 13px; }
        .aside li { margin: 6px 0; }
        .footer-note { margin-top: 10px; font-size: 12px; color: var(--muted); }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div class="brand">{{ config('app.name', 'PIF') }}</div>
            <div>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" style="background:none;border:none;padding:0;margin:0;color:var(--muted);font:inherit;font-size:14px;cursor:pointer;">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Staff login</a>
                @endauth
            </div>
        </div>

        <div class="grid">
            <div>
                @yield('content')
            </div>
            <div class="card">
                <div class="aside">
                    <h2>Quick tips</h2>
                    <ul>
                        <li>Fill all required fields exactly as per ID details.</li>
                        <li><b>Amount</b> must be a number (e.g. 2500.00).</li>
                        <li>Use <b>Fund Name</b> consistently (spelling matters for reporting).</li>
                        <li>If you make a mistake, submit again and add a note.</li>
                    </ul>
                    <div class="footer-note">
                        Admin exports are available to logged-in staff at <code>/admin/export</code>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

