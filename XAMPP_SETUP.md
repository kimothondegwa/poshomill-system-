# XAMPP Setup Guide for Posho Mill

## Quick Start (No Hosts File Editing)

### Access via direct URL:
```
http://localhost/posho%20mili%20project/posho_mill_laravel/public/
```

Just restart Apache and go to this URL - it should work immediately!

---

## Better Setup (With Hosts File - Recommended)

### What This Does:
- Access your app via `http://poshomill.local` (easier to remember)
- Professional setup for Laravel development

### Prerequisites:
✅ Apache VirtualHost configured (DONE)
✅ .htaccess file created (DONE)

### Step 1: Edit Hosts File (Admin Required)

**Windows 10/11:**
1. Right-click **Notepad** → **Run as administrator**
2. File → **Open**
3. Navigate to: `C:\Windows\System32\drivers\etc\hosts`
4. Add at the end:
```
127.0.0.1       poshomill.local
127.0.0.1       www.poshomill.local
```
5. **Save** (Ctrl + S)
6. Close Notepad

---

### Step 2: Restart Apache

**In XAMPP Control Panel:**
1. Find **Apache**
2. Click **Stop** button
3. Wait 2-3 seconds
4. Click **Start** button
5. Wait for green indicator

---

### Step 3: Access Your App

Open your browser and go to:
```
http://poshomill.local
```

You should see the Laravel login page!

---

## Troubleshooting

### Still seeing "Not Found"?

**Try these steps:**

1. **Clear browser cache**
   - Ctrl + Shift + Delete
   - Clear all cache
   - Close and reopen browser

2. **Flush DNS**
   ```bash
   ipconfig /flushdns
   ```

3. **Check Apache is running**
   - XAMPP Control Panel
   - Apache should have green indicator
   - Check error log: `C:\xampp\apache\logs\error.log`

4. **Try the direct URL instead**
   ```
   http://localhost/posho%20mili%20project/posho_mill_laravel/public/
   ```

---

## File Locations

| Item | Location |
|------|----------|
| Apache Logs | `C:\xampp\apache\logs\error.log` |
| Laravel Logs | `C:\xampp\htdocs\posho mili project\posho_mill_laravel\storage\logs\laravel.log` |
| VirtualHost Config | `C:\xampp\apache\conf\extra\httpd-vhosts.conf` |
| Public Folder | `C:\xampp\htdocs\posho mili project\posho_mill_laravel\public\` |

---

## Next Steps

Once it loads, you'll see the login page.

**Default credentials** (if set up):
- Username: admin
- Password: Check .env file or database

---

## Laravel Environment Check

If you still have issues, run this in command prompt:

```bash
cd C:\xampp\htdocs\posho mili project\posho_mill_laravel
php artisan config:cache
php artisan route:cache
```

Then try refreshing the browser.

---

## Support

If you get errors:
1. Check Apache error log: `C:\xampp\apache\logs\error.log`
2. Check Laravel log: `storage\logs\laravel.log`
3. Share the error and I'll help fix it!

---

**Happy coding! 🚀**
