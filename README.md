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

## What was wrong before, and what was fixed

- **Three different, conflicting databases.** `connect1.php`, `login.php`,
  and `form.php` each pointed at a different database/table structure
  (`login_db`, `teen_vitality`, `users_system`, ...), so an account created
  on one form could never log in through another. Everything now shares one
  `teenvitality` database and one `users` table (`database/schema.sql`).
- **Plain-text passwords.** The homepage registration handler
  (`connect1.php`) stored passwords as plain text, while `login.php`
  expected hashed passwords — so registering on the homepage produced
  accounts nobody could ever log into. Passwords are now hashed with
  `password_hash()` everywhere they're created, and verified with
  `password_verify()` on login.
- **SQL injection.** `connect1.php` and `contact_form.php` built SQL queries
  by directly concatenating form input. Both now use prepared statements.
- **Registration form silently dropped data.** The homepage form collects
  username, mobile number, and user ID, but the old handler only saved
  email and password. It now saves all five fields.
- **Type-mismatched prepared statement in `form.php`** (`user_id` bound as
  an integer while it's really free-text) — fixed to bind as text, matching
  the shared table.
- **Blank page after login.** `Dashboard.php` had no content, so a
  successful login led to a blank white page. It now shows a minimal
  welcome screen with a logout link.
- **Duplicated files removed.** `db_connect1.php`, `connect.php`,
  `login1.php`, `sign_in.php`, and `Register.php` were near-duplicates of
  files that were actually in use, each with slightly different (and
  incompatible) database settings — removed in favor of one shared
  `includes/db_connect.php`.
- **Five overlapping/contradicting SQL files** consolidated into one
  `database/schema.sql`.
- **10 unused "WhatsApp Image..." files** sitting loose in the project root
  moved into `images/` to declutter — nothing referenced them, so nothing
  changed on the site itself.

## One pre-existing item left as-is

On `login.html`, "Sign up here" links directly to `form.php` with a plain
link (no form data), so clicking it currently opens a blank page rather than
a signup form — `form.php` is a *form handler*, not a form. This is a
front-end/markup issue, so per your request not to change the website it
was left untouched; the homepage's registration form (which does work end
to end) is the one demoed for signups. Happy to wire up a proper signup page
for that link if you'd like it fixed too.
