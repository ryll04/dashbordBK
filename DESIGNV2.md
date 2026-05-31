# Design System V2 — "Bouquet Elegance"

> Philosophy: Soft luxury. Keep the warm neutral palette, add depth through layered shadows, subtle glass effects, and smooth micro-interactions. No neon, no dark mode — just refined warmth.

---

## 1. Elevation & Shadows

Replace flat surfaces with layered depth.

| Token | Value | Usage |
|---|---|---|
| `--shadow-sm` | `0 1px 3px rgba(0,0,0,0.06)` | Inputs, small cards |
| `--shadow-md` | `0 4px 12px rgba(0,0,0,0.08)` | Default card |
| `--shadow-lg` | `0 8px 30px rgba(0,0,0,0.12)` | Sidebar, topbar |
| `--shadow-xl` | `0 20px 60px rgba(0,0,0,0.15)` | Modals |
| `--shadow-glow` | `0 0 0 3px rgba(230,0,35,0.15)` | Focus ring (replaces hard outline) |

## 2. Sidebar — Glass & Depth

- Background: `rgba(255,255,255,0.85)` + `backdrop-filter: blur(12px)` (glassmorphism)
- `box-shadow: var(--shadow-lg)` on right edge
- Nav items: rounded `12px` pill, transparent default, `var(--color-surface-soft)` on hover, `var(--color-primary)` left border + light tint on active
- Smooth `transition: all 0.2s ease` on nav items
- Brand logo area: subtle gradient background `linear-gradient(135deg, var(--color-primary), #c4597a)` with white text

## 3. Topbar — Floating

- `background: rgba(255,255,255,0.9)` + `backdrop-filter: blur(8px)`
- `box-shadow: 0 1px 8px rgba(0,0,0,0.04)` (very subtle)
- User avatar: circular 36px with soft border
- Page title: `text-heading-lg` with `-0.5px` letter-spacing

## 4. Cards — Lifted & Rounded

- Default: `border-radius: 16px`, `box-shadow: var(--shadow-md)`, `border: 1px solid var(--color-hairline-soft)`
- Hover (interactive cards only): `box-shadow: var(--shadow-lg)`, `transform: translateY(-2px)`, `transition: 0.25s ease`
- `.card-stat`: left accent border `3px solid var(--color-primary)`, icon in a soft circle badge

## 5. Buttons — Polished

- `border-radius: 12px` (from 16px — tighter)
- `box-shadow: 0 2px 8px rgba(230,0,35,0.2)` on `.btn-primary`
- Hover: darken + lift `transform: translateY(-1px)`, deeper shadow
- Active: press down `transform: translateY(0)`
- `.btn-secondary`: glass style `background: rgba(255,255,255,0.7)`, `border: 1px solid var(--color-hairline)`

## 6. Inputs — Refined

- `border-radius: 12px`
- `box-shadow: var(--shadow-sm)` by default
- Focus: `--shadow-glow` (red tinted ring)
- Transition: `0.2s ease` on border + shadow

## 7. Animations — Subtle Micro-interactions

| Animation | Keyframes | Usage |
|---|---|---|
| `fade-in` | `opacity: 0 → 1, translateY(8px → 0)` | Page content entry |
| `slide-in-left` | `translateX(-16px → 0)` | Sidebar nav items (staggered) |
| `scale-in` | `scale(0.95 → 1), opacity: 0 → 1` | Modals, cards |
| `pulse-soft` | `opacity: 1 → 0.7 → 1` | Loading states |

- All animations: `0.3s ease` duration, `forwards` fill
- Content body: `animation: fade-in 0.4s ease`

## 8. Tables — Clean & Spaced

- Row hover: `background: var(--color-surface-soft)`
- Header: `font-size: 13px`, `text-transform: uppercase`, `letter-spacing: 0.5px`, `color: var(--color-mute)`
- Cell padding: `14px 16px`
- Alternating rows: subtle `var(--color-surface-soft)` on even

## 9. Alerts — Rounded with Icon Gap

- `border-radius: 12px`, `border-left: 4px solid` (green for success, red for error)
- Padding: `14px 20px`
- `box-shadow: var(--shadow-sm)`

## 10. Scrollbar — Slim Custom

- `width: 6px`, `track: transparent`, `thumb: var(--color-stone)`, `border-radius: 3px`

## 11. Typography Refinements

- `.text-heading-lg`: `letter-spacing: -0.5px`
- `.text-caption`: `letter-spacing: 0.3px`
- Sidebar nav: `font-size: 14px`, `font-weight: 500` (from 600 — less heavy)
- Brand name: `font-weight: 800`, `letter-spacing: -0.5px`

## 12. Color Accents (no palette change)

- Use `var(--color-primary)` only for: CTA buttons, active nav indicator, stat accent borders, links
- Use `var(--color-primary)` at `opacity: 0.08` for: tinted backgrounds (active nav, hover states)
- Success: keep `--color-success-pale` / `--color-success-deep`
- Add: `--color-primary-light: rgba(230,0,35,0.08)` for tinted backgrounds
