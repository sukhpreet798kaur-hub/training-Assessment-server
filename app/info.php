<?php
$env     = getenv('APP_ENV') ?: 'not set';
$appName = getenv('APP_NAME') ?: 'DevOps Demo App';
$dbHost  = getenv('DB_HOST') ?: 'unknown';

$mysqli = @new mysqli(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD'),
    getenv('DB_NAME')
);

$dbStatus = $mysqli && !$mysqli->connect_errno ? 'CONNECTED' : 'NOT CONNECTED';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($appName); ?> - Info</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    body {
      background: #f5f7fb;
      color: #222;
      line-height: 1.6;
    }
    header {
      background: #1f2933;
      color: #fff;
      padding: 16px 24px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    header h1 {
      font-size: 1.5rem;
      margin-bottom: 8px;
    }
    nav a {
      color: #e5e7eb;
      text-decoration: none;
      margin-right: 12px;
      font-size: 0.95rem;
    }
    nav a:hover {
      text-decoration: underline;
    }
    main {
      max-width: 900px;
      margin: 24px auto;
      background: #ffffff;
      padding: 24px 28px;
      border-radius: 8px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    }
    h2 {
      margin-top: 16px;
      margin-bottom: 8px;
      font-size: 1.25rem;
      color: #111827;
    }
    h3 {
      margin-top: 16px;
      margin-bottom: 8px;
      font-size: 1.1rem;
      color: #111827;
    }
    ul {
      margin-left: 20px;
      margin-top: 8px;
      margin-bottom: 12px;
    }
    li {
      margin-bottom: 4px;
    }
    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    .badge-ok {
      background: #dcfce7;
      color: #166534;
      border: 1px solid #86efac;
    }
    .badge-fail {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }
    .env-grid {
      display: grid;
      grid-template-columns: 160px 1fr;
      gap: 6px 16px;
      margin-top: 8px;
      margin-bottom: 12px;
      font-size: 0.95rem;
    }
    .env-label {
      font-weight: 600;
      color: #374151;
    }
    .env-value {
      font-family: "Fira Code", Menlo, Consolas, monospace;
      color: #111827;
    }
  </style>
</head>
<body>
  <header>
    <h1><?php echo htmlspecialchars($appName); ?> - Application Information</h1>
    <nav>
      <a href="/index.html">Home</a>
      <a href="/about.html">About</a>
      <a href="/contact.html">Contact</a>
      <a href="/info.php">App Info</a>
    </nav>
  </header>
  <main>
    <h2>Environment</h2>
    <div class="env-grid">
      <div class="env-label">APP_ENV</div>
      <div class="env-value"><?php echo htmlspecialchars($env); ?></div>

      <div class="env-label">APP_NAME</div>
      <div class="env-value"><?php echo htmlspecialchars($appName); ?></div>

      <div class="env-label">DB_HOST</div>
      <div class="env-value"><?php echo htmlspecialchars($dbHost); ?></div>
    </div>

    <h2>Database</h2>
    <p>
      Connection status:
      <?php if ($dbStatus === 'CONNECTED'): ?>
        <span class="badge badge-ok">CONNECTED</span>
      <?php else: ?>
        <span class="badge badge-fail">NOT CONNECTED</span>
      <?php endif; ?>
    </p>

    <?php if ($dbStatus === 'CONNECTED'): ?>
      <h3>Sample Users</h3>
      <ul>
      <?php
        $result = $mysqli->query('SELECT name, email FROM users ORDER BY id LIMIT 5');
        if ($result) {
          while ($row = $result->fetch_assoc()) {
            echo '<li>' . htmlspecialchars($row['name']) . ' (' . htmlspecialchars($row['email']) . ')</li>';
          }
        } else {
          echo '<li>No users found or query failed.</li>';
        }
      ?>
      </ul>
    <?php endif; ?>
  </main>
</body>
</html>
