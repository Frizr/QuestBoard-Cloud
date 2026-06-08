# QuestBoard Memory Prompt

Use this markdown as a saved continuation prompt when improving the QuestBoard Laravel project later.

## Project Context

Project name: QuestBoard

Framework:
- Laravel 13
- Blade
- Tailwind CSS
- Alpine.js from Laravel Breeze
- MySQL via Laragon

Typical project folder after cloning:

```text
QuestBoard
```

Backend features already exist and must stay working:
- Authentication
- Dashboard statistics
- Quest CRUD
- Category CRUD
- EXP system
- Level system
- Leaderboard
- CSRF protection
- Validation error display
- Old input values on forms
- Method spoofing for edit/delete forms
- Existing route names, controllers, models, and migrations

## Current UI Direction

QuestBoard should feel like a premium dark fantasy RPG productivity web app.

Target mood:
- cinematic
- adventurer guild hall
- quest board
- mission journal
- magical purple glow
- gold reward accents
- modern readable dashboard
- professional RPG interface

Avoid:
- generic admin dashboard
- normal to-do list
- plain SaaS template
- Bootstrap-looking UI
- childish cartoon game style
- official Dungeons & Dragons copyrighted art, logos, or brand assets without explicit license

## Existing Visual System

Use this palette:
- Obsidian Black: `#050816`
- Deep Midnight: `#0B1020`
- Dark Panel: `#111827`
- Elevated Card: `#172033`
- Secondary Surface: `#1E293B`
- Arcane Purple: `#6D28D9`
- Violet Glow: `#8B5CF6`
- Frost Blue: `#38BDF8`
- Royal Gold: `#FBBF24`
- Dark Gold: `#D4A017`
- Ember Bronze: `#B45309`
- Crimson Red: `#DC2626`
- Success Green: `#22C55E`
- Main Text: `#F8FAFC`
- Soft Text: `#CBD5E1`
- Muted Text: `#94A3B8`
- Border: `#334155`

Typography:
- RPG headings: Cinzel or Unbounded
- Body text: Inter

## Background Reference And Examples

Existing local background assets:
- `public/videos/questboard-bg.mp4`
- `public/videos/questboard-bg.webm`
- `public/videos/questboard-bg.svg`
- `public/images/questboard-hero.png`

Landing page background rules:
- Use video background only on the landing page hero.
- Optional use on login/register only if readability stays good.
- Do not use video background on dashboard, quest CRUD, category CRUD, profile, or leaderboard pages.
- Add a dark overlay above the video.
- Keep text readable on mobile and desktop.
- Use local files only, not external video URLs.
- Provide fallback gradient or fallback image if video is missing.

Preferred background mood:
- cinematic dark fantasy guild hall
- old wooden quest board with parchment contracts
- candle light, smoke, dust, and subtle magical particles
- arcane purple glow
- royal gold reward accents
- readable dark overlay
- premium RPG, not cartoon

Avoid background mood:
- childish cartoon tavern
- generic purple gradient
- plain SaaS abstract background
- blurry stock photo that does not show the subject
- copyrighted Dungeons & Dragons official art
- background that makes text hard to read

Example background prompts for future image/video generation:

```text
Cinematic dark fantasy adventurer guild hall interior, a large wooden quest board filled with parchment contracts and wax seals, candlelight, subtle purple arcane glow, gold coins and reward tokens, realistic premium RPG atmosphere, dark readable center space for hero text, no logos, no copyrighted characters.
```

```text
Close-up premium RPG quest board background, old oak planks, parchment mission notes, red wax seals, brass pins, faint magical purple runes, royal gold highlights, moody cinematic lighting, shallow depth, usable as website hero background, professional not cartoon.
```

```text
Dark fantasy mission journal on an obsidian desk, open leather-bound book, map fragments, feather quill, glowing violet rune circle, gold reward coins, cinematic overhead composition, high contrast, readable dark negative space for web headline.
```

```text
Adventurer guild hall at night, warm candles, distant armor silhouettes, quest contracts on a central board, smoky atmosphere, arcane violet particles, gold accent lighting, premium tabletop RPG style, realistic, no official Dungeons and Dragons branding.
```

If the user adds a new background example file, document it here with:
- file path
- intended page
- mood notes
- whether it is generated, user-made, or externally sourced
- license/attribution if external

## Current Completed Work

The app has already been redesigned from the Stitch reference files into Laravel Blade + Tailwind.

Important additions:
- Landing page cinematic video background support
- Dark fantasy dashboard
- RPG quest cards
- Mission briefing quest detail
- Quest contract create/edit forms
- Guild category cards with emblem and color picker
- Hall of Heroes leaderboard
- RPG auth pages
- Profile page redesigned
- Upload profile photo support
- Local RPG portrait template fallback
- Avatar shown in sidebar and leaderboard
- Category emblem picker

Important files already added or changed:
- `app/Support/AvatarTemplates.php`
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Requests/ProfileUpdateRequest.php`
- `app/Models/User.php`
- `database/migrations/2026_06_08_000006_add_avatar_fields_to_users_table.php`
- `resources/views/components/avatar-portrait.blade.php`
- `resources/views/components/adventurer-avatar.blade.php`
- `resources/views/profile/edit.blade.php`
- `resources/views/profile/partials/update-profile-information-form.blade.php`
- `resources/views/layouts/navigation.blade.php`
- `resources/views/leaderboard/index.blade.php`
- `resources/css/app.css`

## Main Remaining Problem

The profile picture templates are functional but not visually premium enough.

Current issue:
- The local SVG profile portrait templates look too simple.
- They do not yet feel like high-quality RPG/DnD-style adventurer portraits.
- The profile page is clearer than before, but the avatar area should look more polished and game-like.
- Background examples should be used as mood reference for future landing/auth visual improvements.

Goal:
- Improve profile picture templates so they feel like premium tabletop RPG character portraits.
- Make the avatar selection UI feel like choosing an adventurer class portrait.
- Keep the upload photo flow working.
- Keep the fallback template flow working.

## Profile Picture Improvement Requirements

Keep these existing features:
- User can upload a profile photo.
- Uploaded photo overrides the selected template.
- User can remove uploaded photo and return to template.
- User can choose an RPG portrait template.
- Validation errors show correctly.
- Form keeps old values.
- Uploaded images are stored on the public disk.
- `php artisan storage:link` is used so uploaded images render in browser.

Improve:
- Replace or upgrade the current simple SVG templates.
- Add better RPG portrait templates such as:
  - Arcane Mage
  - Iron Paladin
  - Moon Ranger
  - Ember Rogue
  - Frost Cleric
  - Crimson Knight
  - Necromancer Scholar
  - Golden Bard
  - Shadow Assassin
  - Dragon Herald
- Make each template visually distinct.
- Add better lighting, framing, armor/robe silhouettes, class icons, and color accents.
- Make small avatar sizes still readable in sidebar and leaderboard.
- Make large profile avatar look sharp and premium.

Recommended asset approach:
- Prefer original generated artwork or self-made local assets.
- Store local avatar templates under:

```text
public/images/avatar-templates/
```

- Update `app/Support/AvatarTemplates.php` with each template key, label, class title, and asset path.
- Update `resources/views/components/adventurer-avatar.blade.php` to render uploaded image first, then selected template.
- If using external free assets, add attribution notes in a new markdown file:

```text
ATTRIBUTIONS.md
```

## Licensing Rules For RPG/DnD-Style Assets

Do not use official Dungeons & Dragons art, logos, book covers, monster art, class icons, or branded symbols unless the asset license explicitly allows it.

Safe asset types:
- Original generated art
- CC0 assets
- CC BY assets with attribution
- MIT licensed SVG/icon libraries
- Free-for-commercial-use assets with clear license page
- User-provided assets that the user confirms they are allowed to use

When searching for templates, prefer queries like:
- `free fantasy RPG avatar portraits CC0`
- `free tabletop RPG character portrait pack license`
- `fantasy adventurer portrait icons free commercial use`
- `RPG class avatar pack CC BY`
- `dark fantasy profile avatar SVG free license`
- `fantasy character portrait assets public domain`

If an asset requires attribution, document:
- Asset name
- Author
- Source URL
- License name
- License URL
- Whether modification is allowed

## UI/UX Tone Improvements Still Needed

Profile page:
- Make portrait selector look like a character/class selection panel.
- Add stronger class labels and short role descriptions.
- Make upload box feel like "Upload Adventurer Portrait", not normal file upload.
- Improve empty/fallback state.
- Add clearer text in Indonesian or English consistently.

Navigation:
- Current sidebar is better, but can feel more like a guild menu.
- Add subtle RPG separators, emblem states, and better active item treatment.
- Keep it readable and not too decorative.

Dashboard:
- Make the top status section feel more like a character status sheet.
- Improve level/rank visual treatment.
- Add more RPG language without making it confusing.

Quest list:
- Keep quest cards readable.
- Make difficulty/status/reward more visually distinct.
- Avoid table-heavy layout.

Category UI:
- Color picker and emblem selector already exist.
- Improve emblem visuals if needed.
- Avoid asking users to type hex code manually.

Leaderboard:
- Make top 3 podium more cinematic.
- Use profile avatars instead of initials.
- Do not show email.

## Implementation Constraints

Do not break:
- Route names
- Controllers
- Models
- Migrations
- Authentication
- Quest CRUD
- Category CRUD
- Dashboard variables
- EXP/level logic
- Leaderboard query
- CSRF protection
- Method spoofing
- Validation errors
- Old input handling

Use:
- Blade components
- Tailwind CSS
- Alpine.js only if already available
- Local assets only unless explicitly approved

Avoid:
- Bootstrap
- External JS libraries
- Unlicensed art
- Undefined Blade variables
- Blindly copying Stitch static HTML

## Commands To Verify After Changes

Run:

```bash
php artisan test
npm run build
php artisan view:cache
php artisan view:clear
```

If new migrations were added:

```bash
php artisan migrate
```

If avatar upload images do not show:

```bash
php artisan storage:link
```

If the storage link already exists, that is okay.

## Prompt To Continue Later

Copy this prompt into a future AI/Codex session:

```text
You are working on the Laravel project QuestBoard.

Read QUESTBOARD_MEMORY_PROMPT.md first.

Continue improving the RPG/dark fantasy UI without breaking backend logic.

Focus especially on the profile picture system:
- The current avatar templates are too simple and ugly.
- Improve them into premium RPG/tabletop fantasy adventurer portraits.
- Keep profile photo upload working.
- Keep selected template fallback working.
- Keep avatar rendering in sidebar and leaderboard.
- Do not use official Dungeons & Dragons copyrighted assets.
- Use original local assets or clearly licensed free assets only.
- If external assets are used, add ATTRIBUTIONS.md.

Also improve background direction if requested:
- Use QUESTBOARD_MEMORY_PROMPT.md background examples.
- Keep video only on landing hero, optional auth pages.
- Use local video/image assets only.
- Preserve dark overlay and readability.

After implementing, run:
- php artisan test
- npm run build
- php artisan view:cache
- php artisan view:clear

Do not start the dev server unless explicitly asked.
```
