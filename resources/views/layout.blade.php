<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasury Simulator</title>
    <link rel="stylesheet" href="{{secure_asset('assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <section class="sidebar">
            <div class="header">
                <a href="#"><span class="focus">TS</span><span class="unfocus">imulator</span></a>
                
            </div>
            <div class="separator-wrapper">
                <hr class="separator" />
                <label for="minimize" class="minimize-btn">
                <input type="checkbox" id="minimize" />
                <i class="fas fa-bars"></i>
                </label>
            </div>
            <div class="navigation">
                <div class="section main-section">
                <ul class="items">
                    <li class="item">
                    <a href="/">
                        <i class="fas fa-th"></i>
                        <span class="item-text">Dashboard</span>
                        <span class="item-tooltip">Dashboard</span>
                    </a>
                    </li>
                    <li class="item">
                    <a href="/accounts">
                        <i class="fas fa-users"></i>
                        <span class="item-text">Accounts</span>
                        <span class="item-tooltip">Accounts</span>
                    </a>
                    </li>
                    <li class="item">
                    <a href="/transactions">
                        <i class="fas fa-tasks"></i>
                        <span class="item-text">Transactions</span>
                        <span class="item-tooltip">Transactions</span>
                    </a>
                    </li>
                    <li class="item">
                    <a href="/transfers">
                        <i class="fas fa-exchange-alt"></i>
                        <span class="item-text">Transfer</span>
                        <span class="item-tooltip">Transfer</span>
                    </a>
                    </li>
                </ul>
                </div>       
        </section>
        <main class="content">
            
            @yield('content')
        </main>
    </div>
</body>
</html>