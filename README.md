# Ayar Fish Farming — PHP website (redesigned)

## Run (XAMPP)
1. Copy this folder to `C:\xampp\htdocs\Ayar_Fish_Farming_PHP`, start Apache.
2. Open `http://localhost/Ayar_Fish_Farming_PHP/`.

## Structure
- `includes/header.php`, `footer.php` — shared layout (navigation, breadcrumbs, previous/next, related pages)
- `includes/pages.json` — page list (menu, home library, previous/next). Add a new page here + create `yourpage.php` using the same header/footer lines.
- `includes/lib.php` — contact email/phone/address settings (`$CFG`)
- `assets/` — css, js, optimized images (ASCII file names)
- `contact.php`, `sign-in.php` — forms save to `data/*.jsonl` (the folder must be writable; web access is blocked by .htaccess)
- `_original-backup/` — previous version for reference (delete before going live)

## Admin (CMS)
- Open `/admin/login.php`. The first time, you create the admin username + password (do this right after uploading).
- After login you see the normal website. Click **✏️ ဒီစာမျက်နှာကို ပြင်မည်** to edit text, headings, lists, links and images in place, then **💾 သိမ်းမည်** — visitors see the change immediately.
- Dashboard (`/admin/`): pages (create / edit / delete / reorder), categories, fish species, messages, sign-ups, uploaded images, settings, password.
- All content is stored as JSON in `data/` (must be writable). Uploaded images go to `assets/uploads/`. Back up both folders.
- Requires PHP 7.4+ (XAMPP default is fine).

## Dynamic editing (all text & images)
- Login → open any page → **✏️ ဒီစာမျက်နှာကို ပြင်မည်**. Every heading, paragraph, button, navbar and footer text is highlighted and can be edited in place; every image (logo, banner, card, gallery) can be replaced by clicking it. **💾 သိမ်းမည်** saves everything.
- Same texts/images can also be managed in `admin/index.php` → **Settings** tab.
- `fish-gallery.php` content is editable as a normal page body (`data/pages/fish-gallery.json`).

Fonts load from Google Fonts (internet needed). Content text of all original pages is unchanged.
