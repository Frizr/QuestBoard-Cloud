# DESIGN.md — QuestBoard UI/UX Design Guideline

## 1. Project Identity

**Project Name:** QuestBoard
**Slogan:** Level Up Your Productivity
**Concept:** RPG Gamified Task Management Web App
**Platform:** Laravel + Blade + Tailwind CSS
**Target Users:** General users who want to organize tasks, goals, routines, and responsibilities with a more engaging RPG-style experience.

QuestBoard is not a normal to-do list app. The application should feel like a modern RPG quest board where users become adventurers, tasks become quests, categories become guild sections, completed tasks give EXP, and progress is shown through levels.

---

## 2. UI/UX Main Goal

The current UI must be redesigned because it looks too generic and does not represent the game/RPG concept.

The new UI/UX must communicate:

* RPG quest board atmosphere
* Adventurer guild dashboard
* Mission/quest card system
* EXP and level progression
* Dark fantasy productivity theme
* Professional SaaS dashboard quality
* Clear, readable, responsive interface

The design must not look childish, cartoonish, or like a plain admin dashboard.

---

## 3. Design Theme

### Theme Name

**Dark Fantasy RPG Productivity Dashboard**

### Visual Keywords

* Adventurer Guild
* Quest Board
* Mission Log
* Quest Journal
* Hall of Heroes
* EXP Progression
* Level System
* Dark Fantasy
* Magical Glow
* Gold Reward
* Modern SaaS
* Card-based Interface

### Design Mood

The UI should feel like a combination of:

* RPG game mission board
* fantasy guild dashboard
* modern productivity web app
* dark SaaS admin panel

The interface should remain clean, professional, and easy to use.

---

## 4. Color Palette

Use the following color palette consistently.

```text
Main Background: #0B1020
Secondary Background: #111827
Card Background: #151B2E
Surface Background: #1E293B
Border Color: #334155

Primary Purple: #7C3AED
Purple Glow: #8B5CF6
Magic Blue: #38BDF8
Gold Accent: #FBBF24
Gold Dark: #B45309

Success Green: #22C55E
Warning Orange: #F59E0B
Danger Red: #EF4444
Info Blue: #3B82F6

Main Text: #F8FAFC
Muted Text: #94A3B8
Soft Text: #CBD5E1
```

### Color Usage

* Use dark navy as the main background.
* Use purple for primary buttons, active navigation, and magical accents.
* Use gold for rewards, EXP, level highlights, and Boss Quest elements.
* Use blue for in-progress or normal difficulty.
* Use green for completed/success states.
* Use red for overdue/danger states.
* Avoid plain white backgrounds.

---

## 5. Typography

Use two font styles:

### Heading Font

Use a fantasy-inspired or futuristic display font:

* Cinzel
* Unbounded
* Orbitron

Recommended: **Cinzel**

Use heading font for:

* QuestBoard logo text
* page titles
* hero title
* RPG section titles
* leaderboard title
* level display

### Body Font

Use a clean readable font:

* Inter
* Poppins
* Manrope

Recommended: **Inter**

Use body font for:

* paragraphs
* forms
* tables
* cards
* navigation
* buttons

### Example Font Import

```html
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

---

## 6. Global Layout Direction

The whole application should use a consistent dark RPG interface.

### Global Requirements

* Dark background on all pages.
* Card-based layout.
* Rounded cards with subtle borders.
* Soft glow effects on important elements.
* Consistent navigation.
* Responsive layout for desktop, tablet, and mobile.
* Clean spacing and visual hierarchy.
* No default Laravel Breeze plain white look.
* No generic Bootstrap-like admin panel.
* No unnecessary clutter.

### Background Style

Use a combination of:

* dark gradient background
* subtle radial glow
* faint grid pattern
* subtle stars/particles if possible with CSS
* decorative fantasy-like borders only when not disturbing readability

Example Tailwind direction:

```html
<body class="min-h-screen bg-[#0B1020] text-slate-100 antialiased">
```

---

## 7. Navigation Design

### Authenticated Navigation

Navigation items:

* Dashboard
* Quests
* Categories
* Leaderboard
* Profile
* Logout

### Navigation Style

The navbar should feel like a guild menu.

Design:

* dark translucent background
* border bottom
* active route highlight with purple/gold accent
* hover glow effect
* responsive mobile menu

### Suggested Labels

Use more RPG-like labels visually, but do not break route names.

| Current Menu | Visual Label       |
| ------------ | ------------------ |
| Dashboard    | Guild Hall         |
| Quests       | Quest Log          |
| Categories   | Guild Categories   |
| Leaderboard  | Hall of Heroes     |
| Profile      | Adventurer Profile |

---

## 8. Landing Page Design

### Goal

The landing page must immediately show that QuestBoard is an RPG-themed productivity app.

### Hero Section

Content:

```text
QuestBoard
Level Up Your Productivity
Turn your daily tasks into RPG-style quests. Complete missions, gain EXP, and level up your life.
```

CTA buttons:

* Start Your Journey
* Enter Guild Hall

Visual direction:

* large fantasy-style title
* purple glow background
* gold accent elements
* dashboard preview mockup
* quest card mockup
* dark magical background

### Landing Page Sections

1. Navbar
2. Hero section
3. Problem section
4. Solution section
5. Feature cards
6. How it works
7. Dashboard preview
8. Footer

### Problem Section

Use cards for:

* Tasks are scattered everywhere.
* Deadlines are often missed.
* To-do lists feel boring.
* Progress is hard to measure.
* Motivation is often low.

### Solution Section

Explain:

* Turn tasks into quests.
* Group quests by categories.
* Complete quests to gain EXP.
* Track deadlines and status.
* Level up through productivity.

### Feature Cards

Feature cards:

1. Create Quests
2. Gain EXP
3. Level Up
4. Track Deadlines
5. Manage Guild Categories
6. Compete in Hall of Heroes

### How It Works

Steps:

1. Create a Quest
2. Complete the Mission
3. Gain EXP
4. Level Up

---

## 9. Dashboard Design

### Page Name

Use visual heading:

```text
Guild Hall
Welcome back, Adventurer
```

### Dashboard Components

The dashboard must show:

* Current Level
* Total EXP
* EXP progress bar
* Total Quests
* Pending Quests
* In Progress Quests
* Completed Quests
* Overdue Quests
* Recent Quests
* Upcoming Deadlines

### Level Panel

Create a large hero card showing:

```text
Level 5 Adventurer
1250 EXP
Progress to next level
[==============------]
```

### Stat Cards

Use RPG-style cards:

* Total Quests
* Pending
* In Progress
* Completed
* Overdue
* Total EXP
* Current Level

Each card should have:

* icon or symbol
* number
* label
* small description
* subtle glowing border

### Recent and Upcoming Quests

Use quest cards instead of plain tables when possible.

---

## 10. Quest List Design

### Page Name

Use visual heading:

```text
Quest Log
Manage your active missions and daily objectives.
```

### Quest List Layout

Prefer card layout over plain table.

Each quest card should display:

* Quest title
* Category
* Difficulty badge
* Status badge
* Deadline
* Reward EXP
* Action buttons

### Quest Card Example

```text
[Boss Quest] Deploy Laravel to AWS
Category: Project
Deadline: 10 June 2026
Reward: 500 EXP
Status: In Progress

[View Quest] [Edit] [Delete]
```

### Search and Filter

Search/filter area should look polished and dark.

Fields:

* Search by title
* Filter by category
* Filter by difficulty
* Filter by status
* Sort by newest/deadline

Button:

* New Quest

---

## 11. Difficulty Badge Design

Use clear visual identity for each difficulty.

| Difficulty | Color Direction | Visual Feeling  |
| ---------- | --------------- | --------------- |
| Easy       | Green           | Light task      |
| Normal     | Blue            | Standard quest  |
| Hard       | Orange          | Challenging     |
| Epic       | Purple          | Rare/high-value |
| Boss       | Gold + Red Glow | Major mission   |

### Badge Labels

Use:

* Easy
* Normal
* Hard
* Epic
* Boss Quest

Boss Quest should look the most special.

---

## 12. Status Badge Design

| Status      | Color        | Meaning          |
| ----------- | ------------ | ---------------- |
| Pending     | Slate/Yellow | Waiting          |
| In Progress | Blue         | Currently active |
| Completed   | Green        | Finished         |
| Overdue     | Red          | Deadline missed  |

Overdue is a visual/computed state, not a database status.

---

## 13. Quest Detail Page

### Page Name

Use:

```text
Quest Briefing
```

### Layout

The quest detail page should feel like a mission briefing or quest scroll.

Sections:

* Quest title
* Quest Briefing
* Difficulty
* Reward EXP
* Deadline
* Category
* Current Status
* Completion Date
* Action buttons

### Buttons

* Edit Quest
* Back to Quest Log
* Delete Quest

---

## 14. Create/Edit Quest Form

### Visual Concept

The form should feel like creating a quest contract.

### Page Titles

Create:

```text
Create New Quest
Write a new mission for your journey.
```

Edit:

```text
Edit Quest
Update your mission details.
```

### Form Fields

* Title
* Description
* Category
* Difficulty
* Status
* Deadline

### Form Design

* dark input background
* clear labels
* focused state with purple border
* helper text when needed
* polished submit button

### Button Text

* Create Quest
* Update Quest

---

## 15. Category Page Design

### Page Name

Use:

```text
Guild Categories
Organize your quests into meaningful guild sections.
```

### Category Cards

Each category card should display:

* category name
* category color indicator
* action buttons
* quest count if available

Example categories:

* Work
* Study
* Personal
* Health
* Finance
* Project
* Gaming
* Hobby
* Home
* Other

### Empty State

Use:

```text
Your guild has no categories yet. Create your first category to organize your quests.
```

---

## 16. Leaderboard Page Design

### Page Name

Use:

```text
Hall of Heroes
```

### Purpose

Leaderboard should feel like ranking adventurers by productivity.

### Data Display

Show:

* Rank
* Adventurer Name
* Level
* Total EXP
* Completed Quests

Do not show email or sensitive user data.

### Top 3 Style

Highlight top 3:

* Rank 1: Gold Champion
* Rank 2: Silver Elite
* Rank 3: Bronze Hero

Use special cards or highlighted rows for top 3.

---

## 17. Authentication Pages

### Login Page

Use title:

```text
Enter the Guild Hall
```

Subtitle:

```text
Continue your journey and manage your quests.
```

### Register Page

Use title:

```text
Begin Your Adventure
```

Subtitle:

```text
Create your adventurer account and start leveling up your productivity.
```

### Auth Form Style

* centered card
* dark glassmorphism style
* purple/gold accent
* clear inputs
* polished CTA button
* link back to landing page

Avoid default Laravel Breeze white card appearance.

---

## 18. Empty State Copywriting

Use RPG-themed empty state messages.

Examples:

```text
No quests found in your log.
Your quest board is empty.
Begin your journey by creating your first quest.
Your guild has no categories yet.
No heroes have entered the hall yet.
```

---

## 19. Button Design

### Primary Button

Use for main actions:

* Start Journey
* Create Quest
* Update Quest
* Save Category

Style:

* purple background
* light text
* hover glow
* rounded corners

### Secondary Button

Use for navigation/back actions:

* dark surface
* border
* muted text
* hover border purple

### Danger Button

Use for delete:

* red background or red border
* clear warning feeling

### Gold Button

Use only for special RPG CTA:

* Start Your Journey
* Boss Quest
* EXP reward action

---

## 20. UX Rules

The redesigned UI must follow these UX rules:

1. Keep important information visible.
2. Make status and difficulty easy to understand.
3. Avoid too much decoration that reduces readability.
4. Use consistent spacing.
5. Use consistent component styles.
6. Make forms easy to fill.
7. Make action buttons clear.
8. Make responsive layout work properly.
9. Use RPG naming carefully without confusing users.
10. Keep the application professional.

---

## 21. Technical UI Requirements

The UI will be implemented in Laravel Blade and Tailwind CSS.

### Do

* Use Tailwind CSS utility classes.
* Keep existing Blade variables.
* Keep existing routes.
* Keep existing controller logic.
* Keep existing authentication logic.
* Add reusable Blade components or partials if useful.
* Make layout responsive.
* Improve all pages consistently.

### Do Not

* Do not remove backend logic.
* Do not rename routes unless necessary.
* Do not change database structure.
* Do not break authentication.
* Do not break CRUD.
* Do not break dashboard statistics.
* Do not break EXP/level logic.
* Do not show sensitive user data on leaderboard.
* Do not use plain Bootstrap/admin template look.
* Do not use childish cartoon game style.

---

## 22. Files to Redesign

Redesign these files if they exist:

```text
resources/views/welcome.blade.php
resources/views/dashboard.blade.php
resources/views/layouts/app.blade.php
resources/views/navigation.blade.php
resources/views/categories/index.blade.php
resources/views/categories/create.blade.php
resources/views/categories/edit.blade.php
resources/views/quests/index.blade.php
resources/views/quests/create.blade.php
resources/views/quests/edit.blade.php
resources/views/quests/show.blade.php
resources/views/leaderboard.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/profile/edit.blade.php
```

Also update or create Blade components if useful:

```text
resources/views/components/quest-card.blade.php
resources/views/components/stat-card.blade.php
resources/views/components/difficulty-badge.blade.php
resources/views/components/status-badge.blade.php
resources/views/components/primary-button.blade.php
resources/views/components/secondary-button.blade.php
```

---

## 23. Final Design Expectation

After the redesign, QuestBoard should look like:

* A serious RPG-inspired productivity app.
* A modern SaaS dashboard with fantasy identity.
* A quest management system, not a normal to-do list.
* A polished project suitable for college cloud deployment presentation.
* A web application that visually supports the concept: complete quests, gain EXP, and level up productivity.
