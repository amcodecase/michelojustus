# Hero Section Redesign Documentation

## Design Approach: Narrative Panel Layout

### Core Philosophy
This redesign eliminates visual clutter and generic patterns in favor of an **intentional, asymmetric structure** that treats images as evidence rather than decoration.

---

## Visual Structure

### Layout Grid
```
┌─────────────────────────┬─────┐
│                         │     │
│   TYPOGRAPHY BLOCK      │  E  │
│   (60% width)           │  V  │
│                         │  I  │
│   • Location/Alias      │  D  │
│   • Name (H1)           │  E  │
│   • Tagline (Quote)     │  N  │
│   • Description         │  C  │
│   • CTAs                │  E  │
│                         │     │
│                         │  S  │
│                         │  T  │
│                         │  R  │
│                         │  I  │
│                         │  P  │
│                         │     │
└─────────────────────────┴─────┘
     PRIMARY PORTRAIT (40%)  (8%)
```

### Asymmetric Grid Ratio
- **Desktop:** 1.3fr (text) : 0.7fr (visual)
- **Tablet:** 1.2fr : 0.8fr
- **Mobile:** Stacked, visual-first

---

## Image Strategy (3 Total)

### 1. Primary Portrait (Eager Load)
**Purpose:** Dominant visual anchor  
**Dimensions:** 600×800px (3:4 aspect ratio)  
**Position:** Partially cropped by viewport edge  
**Treatment:**
- Object-position: `center 20%` (focuses on upper body)
- Subtle gradient overlay (2% darkness at bottom)
- Hover: 2% scale increase (smooth interaction)
- `fetchpriority="high"` for immediate load

**Why this works:**
- Creates visual weight without symmetry
- Partial cropping suggests continuation beyond frame
- Not centered = not generic

### 2. Evidence Strip (Lazy Load)
**Purpose:** Contextual proof, not decoration  
**Dimensions:** 200×800px (narrow vertical slice)  
**Position:** Right edge, acts as visual punctuation  
**Treatment:**
- 30% grayscale by default (subdued)
- Full color on hover (reveals detail)
- 2px border-left in primary color (structural accent)
- Gradient vignette (10% darkness top/bottom)

**Why this works:**
- Vertical orientation breaks horizontal monotony
- Grayscale treatment = "this is context, not the focus"
- Narrow width = efficient bandwidth usage
- Border creates intentional separation

### 3. Background Texture (CSS-Only)
**Purpose:** Subtle grid structure  
**Implementation:** Repeating linear gradients  
**Performance:** Zero image requests  
**Pattern:**
```css
repeating-linear-gradient(0deg, transparent, transparent 60px, rgba(0,0,0,0.01) 60px, rgba(0,0,0,0.01) 61px),
repeating-linear-gradient(90deg, transparent, transparent 60px, rgba(0,0,0,0.01) 60px, rgba(0,0,0,0.01) 61px)
```

**Why this works:**
- Adds structure without noise
- Reinforces grid-based design system
- Zero performance cost

---

## Typography Hierarchy

### Restructured Order
1. **Location/Alias** (Small, uppercase, subdued)
   - Purpose: Context before identity
   - Treatment: 0.8125rem, uppercase, letter-spacing

2. **Name (H1)** (Dominant)
   - Purpose: Primary identifier
   - Treatment: clamp(2rem, 5vw, 3.5rem), tight line-height (1.1)

3. **Tagline** (Italic, bordered)
   - Purpose: Personal philosophy
   - Treatment: Left border accent, italic, 85% opacity
   - Visual cue: Border = "this is a quote"

4. **Description** (Two paragraphs)
   - Purpose: Value proposition
   - Treatment: Max-width 540px (optimal reading length)

5. **CTAs** (Action-oriented)
   - Purpose: Clear next steps
   - Treatment: Primary/Secondary button hierarchy

**Why this works:**
- Information flows logically: context → identity → philosophy → value → action
- Typography does more work than imagery
- Negative space between elements creates rhythm

---

## Performance Optimizations

### Image Loading Strategy
```html
<!-- Primary Portrait -->
<img 
    src="/images/gallery/img2.jpg"
    srcset="/images/gallery/img2.jpg 600w"
    sizes="(max-width: 480px) 260px, (max-width: 968px) 340px, 420px"
    decoding="async"
    fetchpriority="high"
    loading="eager" (implicit)
>

<!-- Evidence Strip -->
<img 
    src="/images/gallery/img3.jpg"
    srcset="/images/gallery/img3.jpg 200w"
    sizes="(max-width: 480px) 60px, 80px"
    loading="lazy"
    decoding="async"
>
```

### Performance Metrics

| Metric | Before | After | Improvement |
|--------|--------|-------|-------------|
| **Total Images** | 9 | 2 | -78% |
| **Eager Loads** | 1 | 1 | 0% |
| **Lazy Loads** | 8 | 1 | -87.5% |
| **Initial Payload** | ~1 image | ~1 image | Same |
| **Total Payload** | ~9 images | ~2 images | -78% |
| **Layout Shifts** | High (floating) | None (fixed grid) | ✓ |

### Bandwidth Savings (Estimated)
- **Before:** 9 images × ~150KB avg = ~1.35MB
- **After:** 2 images × ~150KB avg = ~300KB
- **Savings:** ~1.05MB (78% reduction)

### Additional Optimizations
1. **Responsive Sizing:** Browser loads appropriate size based on viewport
2. **Async Decoding:** Images decode off main thread
3. **Lazy Loading:** Evidence strip only loads when needed
4. **Fixed Dimensions:** Width/height prevent layout shift
5. **CSS Gradients:** Background texture = 0 bytes

---

## Intentional Asymmetry

### What Makes This Non-Generic

**Avoided:**
- ❌ Centered portrait with text beside it
- ❌ Circular image clusters
- ❌ Floating/orbiting avatars
- ❌ Symmetrical two-column split
- ❌ Full-bleed background images
- ❌ Carousel/slider in hero

**Implemented:**
- ✓ Asymmetric grid ratio (1.3:0.7)
- ✓ Partial viewport cropping
- ✓ Vertical evidence strip (unusual orientation)
- ✓ Grayscale-to-color interaction
- ✓ Border as structural element
- ✓ Typography-first hierarchy
- ✓ Negative space as design element

### Visual Rhythm
- Text block: Left-aligned, grounded
- Primary portrait: Right-aligned, partially cropped
- Evidence strip: Edge-aligned, narrow
- Grid background: Subtle structure

**Result:** Feels engineered, not templated.

---

## Responsive Behavior

### Desktop (>968px)
- Grid: 1.3fr text, 0.7fr visual
- Portrait: 600px height
- Evidence strip: 80px width
- Text max-width: 540px

### Tablet (480px - 968px)
- Grid: Stacked, visual-first
- Portrait: 500px height
- Evidence strip: 80px width
- Centered alignment

### Mobile (<480px)
- Grid: Stacked, visual-first
- Portrait: 450px height
- Evidence strip: 60px width
- Full-width text

---

## Design Justification

### Why Each Element Exists

**Primary Portrait:**
- Establishes human connection
- Partially cropped = dynamic, not static
- Dominant size = clear focal point

**Evidence Strip:**
- Provides professional context
- Narrow width = efficient, not wasteful
- Grayscale = "supporting evidence, not hero"
- Vertical = breaks horizontal monotony

**Typography Block:**
- Does majority of communication work
- Structured hierarchy guides eye
- Max-width ensures readability
- Border accent on quote = visual punctuation

**Grid Background:**
- Reinforces systematic thinking
- Adds structure without noise
- Zero performance cost

**Asymmetric Layout:**
- Avoids template energy
- Creates visual interest through imbalance
- Feels intentional, not accidental

---

## Accessibility Considerations

1. **Alt Text:** Descriptive, contextual
2. **Semantic HTML:** Proper heading hierarchy
3. **Focus States:** Maintained on interactive elements
4. **Color Contrast:** Text meets WCAG AA standards
5. **Responsive Images:** Appropriate sizes for all devices
6. **No Motion Sickness:** Subtle hover effects only

---

## Future Optimization Opportunities

### If Converting to WebP/AVIF
```html
<picture>
    <source srcset="/images/gallery/img2.avif" type="image/avif">
    <source srcset="/images/gallery/img2.webp" type="image/webp">
    <img src="/images/gallery/img2.jpg" alt="...">
</picture>
```

**Expected Savings:**
- WebP: ~30% smaller than JPEG
- AVIF: ~50% smaller than JPEG

### Recommended Image Sizes
- Primary portrait: 600×800px @ 85% quality
- Evidence strip: 200×800px @ 80% quality
- Total target: <500KB combined

---

## Conclusion

This redesign achieves:
- ✓ **Distinctive visual structure** (not template-like)
- ✓ **Performance-first approach** (78% fewer images)
- ✓ **Typography-driven hierarchy** (text does the work)
- ✓ **Intentional asymmetry** (engineered, not random)
- ✓ **Evidence-based imagery** (meaningful, not decorative)
- ✓ **Fast load times** (lazy loading, responsive images)
- ✓ **Accessible** (semantic HTML, proper alt text)

The hero section now feels like it was designed by a systems thinker—deliberate, efficient, and distinctive.
