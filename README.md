# TeenVitality — Cleaned & Fixed

The site's look, pages, and front-end behavior are **unchanged** — only the
backend (PHP/database) was cleaned up and fixed. All HTML/CSS/JS files were
left exactly as they were.

## How to run it (XAMPP / any PHP+MySQL server)

1. Copy this whole folder into your server's web root (e.g.
   `htdocs/teenvitality` in XAMPP).
2. Start Apache and MySQL.
3. Create the database by importing `database/schema.sql` (phpMyAdmin ->
   Import, or `mysql -u root -p < database/schema.sql`).
4. If your MySQL user/password differ from the XAMPP defaults, edit
   `includes/db_connect.php`.
5. Open `index.html` in the browser through the server
   (e.g. `http://localhost/teenvitality/index.html`) — don't just double
   click the file, since the PHP forms need a server to run.
6. Register an account on the homepage form, then log in from
   `login.html`.

