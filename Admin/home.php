<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="AdminDashboard.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Welcome Admin</h2>
      <nav>
        <ul>
          <li><a href="#payment">Payment Information</a></li>
          <li><a href="#billing">Billing Details</a></li>
          <li><a href="#residents">Residents Information</a></li>
          <li><a href="#additional">Additional Properties</a></li>
        </ul>
      </nav>
    </aside>
    <header>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button>Search</button>
      </div>
    </header>
    <main>
      <section id="payment" class="section">
        <h2>Payment Information</h2>
        <p>View payment history, pending payments, and detailed records.</p>
      </section>
      <section id="billing" class="section">
        <h2>Billing Details</h2>
        <p>Retrieve invoices, billing history, and statements. Print invoices directly from the system.</p>
      </section>
      <section id="residents" class="section">
        <h2>Residents Information</h2>
        <p>Access comprehensive details about residents including profiles, contact details, and room assignments.</p>
      </section>
      <section id="additional" class="section">
        <h2>Additional Properties</h2>
        <p>Placeholder content for additional properties...</p>
      </section>
    </main>
    <footer>
      <p>&copy; 2024 Admin Dashboard</p>
    </footer>
  </div>
</body>
</html>
