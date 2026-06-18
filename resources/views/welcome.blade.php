@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('main_class', '')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bl9 : #0a2257;
    --bl7 : #1345a0;
    --bl5 : #2166e8;
    --bl4 : #4d8ef5;
    --bl3 : #7db3ff;
    --bl1 : #d0e4ff;
    --bl0 : #eef5ff;
    --sky : #e8f4fe;
    --wh  : #ffffff;
    --g1  : #f7f9fc;
    --g2  : #eaeef5;
    --g4  : #9aa5bc;
    --g6  : #5a6278;
    --g8  : #1e2740;
    --r-sm: 12px;
    --r-lg: 24px;
    --r-xl: 40px;
    --tr  : 0.25s cubic-bezier(.4, 0, .2, 1);
    --font-main: 'Sora', sans-serif;
    --font-body: 'DM Sans', sans-serif;
}

body {
    background: var(--wh);
    font-family: var(--font-body);
    color: var(--g8);
    overflow-x: hidden;
}

/* ══════════════════════════════════════════════════════════
   HERO WRAPPER
══════════════════════════════════════════════════════════ */
.hero-wrapper {
    background: var(--wh);
    position: relative;
    overflow: hidden;
    min-height: 100vh;
}

/* Background blob decorations */
.hero-wrapper::before {
    content: '';
    position: absolute;
    width: 700px; height: 700px;
    border-radius: 50%;
    background: radial-gradient(circle at center,
        rgba(33, 102, 232, 0.07) 0%,
        rgba(33, 102, 232, 0.03) 50%,
        transparent 70%);
    top: -200px; right: -150px;
    pointer-events: none;
    z-index: 0;
}

/* SVG wave top */
.hero-wave-bg {
    position: absolute;
    top: 0; left: 0; right: 0;
    pointer-events: none;
    z-index: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

/* Decorative floating circles */
.deco-blob {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
    animation: floatBlob 6s ease-in-out infinite;
}
.deco-blob--a {
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(33,102,232,0.10) 0%, transparent 70%);
    top: 8%; left: 5%;
    animation-delay: 0s;
}
.deco-blob--b {
    width: 100px; height: 100px;
    background: radial-gradient(circle, rgba(33,102,232,0.12) 0%, transparent 70%);
    top: 60%; left: 2%;
    animation-delay: 2s;
}
.deco-blob--c {
    width: 60px; height: 60px;
    border: 2px solid rgba(33,102,232,0.15);
    background: rgba(33,102,232,0.03);
    top: 30%; right: 8%;
    animation-delay: 1s;
}
.deco-blob--d {
    width: 14px; height: 14px;
    background: rgba(33,102,232,0.25);
    top: 18%; right: 20%;
    animation-delay: 3s;
}
.deco-blob--e {
    width: 10px; height: 10px;
    background: rgba(77,142,245,0.35);
    top: 70%; right: 30%;
    animation-delay: 1.5s;
}
.deco-blob--f {
    width: 8px; height: 8px;
    background: rgba(33,102,232,0.30);
    top: 45%; left: 12%;
    animation-delay: 4s;
}

@keyframes floatBlob {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-12px); }
}

/* Wave ring decorations */
.deco-ring {
    position: absolute;
    border-radius: 50%;
    border: 1.5px solid rgba(33,102,232,0.10);
    pointer-events: none;
    z-index: 0;
    animation: pulsRing 4s ease-in-out infinite;
}
.deco-ring--1 {
    width: 300px; height: 300px;
    top: -80px; right: -80px;
    animation-delay: 0s;
}
.deco-ring--2 {
    width: 200px; height: 200px;
    top: -30px; right: -30px;
    animation-delay: 0.5s;
}
.deco-ring--3 {
    width: 120px; height: 120px;
    bottom: 10%; left: -40px;
    animation-delay: 1s;
}

@keyframes pulsRing {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50%       { opacity: 1; transform: scale(1.04); }
}

/* ══════════════════════════════════════════════════════════
   HERO GRID
══════════════════════════════════════════════════════════ */
.hero {
    min-height: 80vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 3rem;
    padding: 5rem 4rem;
    max-width: 1180px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

/* ── LEFT TEXT ── */
.hero-content { position: relative; z-index: 1; }

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--bl5);
    background: var(--bl0);
    border: 1.5px solid var(--bl1);
    border-radius: 999px;
    padding: 0.38em 1.1em;
    margin-bottom: 1.4rem;
    font-family: var(--font-main);
}
.hero-eyebrow .dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--bl5);
    flex-shrink: 0;
    animation: pulseDot 2s ease-in-out infinite;
}
@keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.6; transform: scale(0.7); }
}

.hero-title {
    font-family: var(--font-main);
    font-size: clamp(2.3rem, 4.5vw, 3.6rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.035em;
    color: var(--g8);
    margin-bottom: 1.4rem;
}

.hero-title .accent {
    position: relative;
    display: inline-block;
    color: var(--bl5);
}

/* Wavy underline for accent */
.hero-title .accent::after {
    content: '';
    position: absolute;
    left: 0; bottom: -6px;
    width: 100%; height: 6px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 120 6'%3E%3Cpath d='M0 3 Q15 0 30 3 Q45 6 60 3 Q75 0 90 3 Q105 6 120 3' stroke='%232166e8' stroke-width='2' fill='none' stroke-opacity='0.4'/%3E%3C/svg%3E");
    background-size: 60px 6px;
    background-repeat: repeat-x;
    opacity: 0.7;
}

.hero-desc {
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--g6);
    line-height: 1.8;
    max-width: 440px;
    margin-bottom: 2.2rem;
    font-weight: 400;
}

.hero-cta {
    display: flex;
    align-items: center;
    gap: 0.9rem;
    flex-wrap: wrap;
}

/* Trust badges row */
.hero-badges {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.4em 0.9em;
    border-radius: 999px;
    background: var(--bl0);
    border: 1.5px solid var(--bl1);
    font-family: var(--font-main);
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--bl7);
    letter-spacing: 0.02em;
    transition: background var(--tr), border-color var(--tr), transform var(--tr);
}
.hero-badge:hover {
    background: var(--bl1);
    border-color: var(--bl3);
    transform: translateY(-1px);
}
.hero-badge svg {
    flex-shrink: 0;
    color: var(--bl5);
}

/* ══════════════════════════════════════════════════════════
   HERO VISUAL — Right Side (Illustration)
══════════════════════════════════════════════════════════ */
.hero-visual {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

/* Main illustration card area */
.hero-illus {
    position: relative;
    width: 100%;
    max-width: 420px;
}

/* Central big illustration card */
.illus-main-card {
    background: linear-gradient(155deg, #f0f6ff 0%, #e4eeff 50%, #dbeafe 100%);
    border-radius: 32px;
    padding: 2.5rem 2rem;
    border: 1.5px solid rgba(33,102,232,0.12);
    box-shadow:
        0 20px 60px rgba(33,102,232,0.12),
        0 4px 16px rgba(33,102,232,0.06),
        inset 0 1px 0 rgba(255,255,255,0.8);
    position: relative;
    overflow: hidden;
    z-index: 2;
    animation: cardFloat 5s ease-in-out infinite;
}

@keyframes cardFloat {
    0%, 100% { transform: translateY(0px) rotate(-0.5deg); }
    50%       { transform: translateY(-8px) rotate(0.5deg); }
}

/* Wave pattern inside main card */
.illus-main-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image:
        radial-gradient(circle at 80% 20%, rgba(33,102,232,0.06) 0%, transparent 50%),
        radial-gradient(circle at 20% 80%, rgba(77,142,245,0.06) 0%, transparent 50%);
    pointer-events: none;
    border-radius: inherit;
}

/* SVG illustration inside card */
.illus-svg-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.25rem;
    position: relative;
    z-index: 1;
}

/* Person + document illustration group */
.illus-figure {
    position: relative;
    width: 160px;
    height: 160px;
    flex-shrink: 0;
}

/* Score result badge overlay */
.illus-score-badge {
    background: var(--wh);
    border-radius: 20px;
    padding: 1.1rem 1.4rem;
    border: 1.5px solid rgba(33,102,232,0.14);
    box-shadow: 0 8px 24px rgba(33,102,232,0.12);
    text-align: center;
    width: 100%;
}
.illus-score-label {
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--g4);
    margin-bottom: 0.3rem;
    font-family: var(--font-main);
}
.illus-score-number {
    font-family: var(--font-main);
    font-size: 2.8rem;
    font-weight: 800;
    letter-spacing: -0.05em;
    line-height: 1;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl5) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}
.illus-score-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.28em 0.9em;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    background: #fef9c3;
    color: #92400e;
    font-family: var(--font-main);
}
.illus-score-pill::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
}

/* Floating mini cards */
.illus-float-card {
    position: absolute;
    background: var(--wh);
    border-radius: 16px;
    border: 1.5px solid rgba(33,102,232,0.12);
    box-shadow: 0 8px 24px rgba(33,102,232,0.12);
    padding: 0.7rem 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.55rem;
    font-family: var(--font-main);
    z-index: 3;
    white-space: nowrap;
}

.illus-float-card--a {
    top: -20px;
    right: -30px;
    animation: floatA 4s ease-in-out infinite;
}
.illus-float-card--b {
    bottom: -15px;
    left: -25px;
    animation: floatB 5s ease-in-out infinite;
    animation-delay: 1s;
}

@keyframes floatA {
    0%, 100% { transform: translateY(0) rotate(2deg); }
    50%       { transform: translateY(-8px) rotate(-1deg); }
}
@keyframes floatB {
    0%, 100% { transform: translateY(0) rotate(-2deg); }
    50%       { transform: translateY(-6px) rotate(1deg); }
}

.float-icon {
    width: 32px; height: 32px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.float-icon--blue {
    background: linear-gradient(135deg, var(--bl5), var(--bl7));
}
.float-icon--green {
    background: linear-gradient(135deg, #16a34a, #15803d);
}
.float-icon--amber {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}
.float-icon svg {
    width: 16px; height: 16px;
    stroke: #fff; fill: none;
    stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
}

.float-text strong {
    display: block;
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--g8);
    line-height: 1;
    margin-bottom: 0.15rem;
}
.float-text span {
    font-size: 0.63rem;
    color: var(--g4);
    font-weight: 500;
}

/* Progress bars in float card */
.mini-bars {
    display: flex;
    flex-direction: column;
    gap: 4px;
    width: 80px;
}
.mini-bar-row {
    display: flex;
    align-items: center;
    gap: 5px;
}
.mini-bar-track {
    flex: 1;
    height: 4px;
    background: var(--g2);
    border-radius: 4px;
    overflow: hidden;
}
.mini-bar-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, var(--bl4), var(--bl5));
}
.mini-bar-label {
    font-size: 0.6rem;
    color: var(--g4);
    font-weight: 600;
    width: 18px;
    text-align: right;
}

/* Deco circles behind illus */
.illus-deco {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    z-index: 1;
}
.illus-deco--1 {
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(33,102,232,0.07) 0%, transparent 70%);
    top: -60px; right: -60px;
    z-index: 0;
}
.illus-deco--2 {
    width: 120px; height: 120px;
    border: 2px dashed rgba(33,102,232,0.12);
    bottom: -40px; left: -40px;
    z-index: 0;
    animation: spinSlow 20s linear infinite;
}
@keyframes spinSlow {
    to { transform: rotate(360deg); }
}
.illus-deco--3 {
    width: 50px; height: 50px;
    background: radial-gradient(circle, rgba(77,142,245,0.15) 0%, transparent 70%);
    top: 40%; right: -50px;
    z-index: 0;
}

/* ══════════════════════════════════════════════════════════
   BOTTOM WAVE DIVIDER
══════════════════════════════════════════════════════════ */
.wave-divider {
    line-height: 0;
    overflow: hidden;
    margin-top: -2px;
}
.wave-divider svg {
    display: block;
    width: 100%;
}

/* ══════════════════════════════════════════════════════════
   STEPS SECTION
══════════════════════════════════════════════════════════ */
.steps-section {
    background: var(--g1);
    padding: 5rem 2rem 5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Subtle wave bg pattern */
.steps-section::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 10% 50%, rgba(33,102,232,0.04) 0%, transparent 40%),
        radial-gradient(circle at 90% 20%, rgba(33,102,232,0.05) 0%, transparent 40%);
    pointer-events: none;
}

/* Wave top of steps section */
.steps-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, transparent, rgba(33,102,232,0.25), transparent);
}

/* Decorative dots grid */
.steps-section .dot-grid {
    position: absolute;
    top: 24px; right: 40px;
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 9px;
    opacity: 0.22;
    pointer-events: none;
}
.steps-section .dot-grid-left {
    position: absolute;
    bottom: 180px; left: 40px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 9px;
    opacity: 0.15;
    pointer-events: none;
}
.steps-section .dot-grid span,
.steps-section .dot-grid-left span {
    width: 4px; height: 4px;
    border-radius: 50%;
    background: var(--bl5);
    display: block;
}

/* Large decorative ring */
.steps-deco-ring {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    border: 1.5px solid rgba(33,102,232,0.07);
}
.steps-deco-ring--1 {
    width: 420px; height: 420px;
    bottom: -160px; left: -140px;
}
.steps-deco-ring--2 {
    width: 260px; height: 260px;
    bottom: -80px; left: -60px;
}
.steps-deco-ring--3 {
    width: 300px; height: 300px;
    top: -100px; right: -100px;
}

.section-label {
    font-family: var(--font-main);
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--bl5);
    margin-bottom: 0.6rem;
    position: relative; z-index: 1;
}

.section-title {
    font-family: var(--font-main);
    font-size: clamp(1.7rem, 4vw, 2.3rem);
    font-weight: 800;
    color: var(--g8);
    letter-spacing: -0.025em;
    margin-bottom: 0.8rem;
    position: relative; z-index: 1;
}

.section-subtitle {
    font-family: var(--font-body);
    font-size: 0.95rem;
    color: var(--g4);
    max-width: 460px;
    margin: 0 auto 3.5rem;
    line-height: 1.7;
    position: relative; z-index: 1;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    max-width: 980px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

/* Arrow connector between steps */
.steps-connector {
    position: absolute;
    top: 52px;
    left: 0; right: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    pointer-events: none;
    z-index: 0;
    max-width: 980px;
    margin: 0 auto;
}
.steps-connector-line {
    flex: 1;
    height: 1.5px;
    background: linear-gradient(90deg,
        transparent 0%,
        rgba(33,102,232,0.18) 30%,
        rgba(33,102,232,0.18) 70%,
        transparent 100%);
}

.step-card {
    background: var(--wh);
    border-radius: 20px;
    padding: 2rem 1.75rem 1.5rem;
    border: 1.5px solid var(--g2);
    box-shadow: 0 2px 16px rgba(33,102,232,0.06);
    text-align: left;
    position: relative;
    overflow: hidden;
    transition: box-shadow var(--tr), transform var(--tr), border-color var(--tr);
    z-index: 1;
    display: flex;
    flex-direction: column;
}
.step-card:hover {
    box-shadow: 0 16px 48px rgba(33,102,232,0.13);
    transform: translateY(-6px);
    border-color: rgba(33,102,232,0.18);
}

/* Top accent bar */
.step-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--bl5), var(--bl4));
    opacity: 0;
    transition: opacity var(--tr);
    border-radius: 20px 20px 0 0;
}
.step-card:hover::before { opacity: 1; }

/* Subtle gradient wash inside card */
.step-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 80px;
    background: linear-gradient(to top, rgba(238,245,255,0.5), transparent);
    pointer-events: none;
    border-radius: 0 0 20px 20px;
    opacity: 0;
    transition: opacity var(--tr);
}
.step-card:hover::after { opacity: 1; }

.step-number {
    position: absolute;
    top: 1rem; right: 1.25rem;
    font-family: var(--font-main);
    font-size: 4.5rem;
    font-weight: 900;
    color: var(--g2);
    line-height: 1;
    letter-spacing: -0.05em;
    user-select: none;
    transition: color var(--tr);
}
.step-card:hover .step-number { color: rgba(33,102,232,0.07); }

.step-icon {
    width: 54px; height: 54px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--bl9) 0%, var(--bl5) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.3rem;
    box-shadow: 0 6px 18px rgba(33,102,232,0.30);
    flex-shrink: 0;
    transition: transform var(--tr), box-shadow var(--tr);
}
.step-card:hover .step-icon {
    transform: scale(1.1) rotate(-4deg);
    box-shadow: 0 10px 28px rgba(33,102,232,0.38);
}
.step-icon svg {
    width: 22px; height: 22px;
    stroke: #fff; fill: none;
    stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
}

.step-card h3 {
    font-family: var(--font-main);
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--g8);
    margin-bottom: 0.55rem;
    letter-spacing: -0.01em;
}
.step-card p {
    font-family: var(--font-body);
    font-size: 0.875rem;
    color: var(--g6);
    line-height: 1.7;
    flex: 1;
}

/* Chip tag at bottom of each card */
.step-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    margin-top: 1.25rem;
    padding: 0.3em 0.85em;
    border-radius: 999px;
    background: var(--bl0);
    border: 1px solid var(--bl1);
    font-family: var(--font-main);
    font-size: 0.67rem;
    font-weight: 700;
    color: var(--bl7);
    letter-spacing: 0.04em;
    text-transform: uppercase;
    align-self: flex-start;
}
.step-chip::before {
    content: '';
    width: 5px; height: 5px;
    border-radius: 50%;
    background: var(--bl5);
    flex-shrink: 0;
}

/* ── Testimonial strip ── */
.steps-testimonials {
    max-width: 980px;
    margin: 3.5rem auto 0;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    position: relative; z-index: 1;
    padding-bottom: 4.5rem;
}
.testi-card {
    background: var(--wh);
    border-radius: 16px;
    padding: 1.25rem 1.4rem;
    border: 1.5px solid var(--g2);
    box-shadow: 0 2px 10px rgba(33,102,232,0.05);
    text-align: left;
    transition: box-shadow var(--tr), transform var(--tr);
}
.testi-card:hover {
    box-shadow: 0 8px 28px rgba(33,102,232,0.10);
    transform: translateY(-3px);
}
.testi-stars {
    display: flex;
    gap: 2px;
    margin-bottom: 0.7rem;
}
.testi-stars svg {
    width: 13px; height: 13px;
    fill: #f59e0b;
    stroke: none;
}
.testi-quote {
    font-family: var(--font-body);
    font-size: 0.82rem;
    color: var(--g6);
    line-height: 1.65;
    margin-bottom: 1rem;
    font-style: italic;
}
.testi-author {
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.testi-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-main);
    font-size: 0.72rem;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}
.testi-avatar--a { background: linear-gradient(135deg, var(--bl5), var(--bl9)); }
.testi-avatar--b { background: linear-gradient(135deg, #16a34a, #15803d); }
.testi-avatar--c { background: linear-gradient(135deg, #7c3aed, #4c1d95); }
.testi-name {
    font-family: var(--font-main);
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--g8);
    display: block;
    line-height: 1;
    margin-bottom: 0.15rem;
}
.testi-role {
    font-size: 0.68rem;
    color: var(--g4);
    font-weight: 500;
}
    color: var(--g6);
    line-height: 1.7;
}

/* ══════════════════════════════════════════════════════════
   CTA BANNER
══════════════════════════════════════════════════════════ */
.cta-section {
    padding: 5rem 2rem;
    background: var(--wh);
    position: relative;
    overflow: hidden;
}

/* Background wave decoration */
.cta-section::before {
    content: '';
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(33,102,232,0.04) 0%, transparent 70%);
    bottom: -200px; right: -100px;
    pointer-events: none;
}

.cta-banner {
    max-width: 960px;
    margin: 0 auto;
    background: linear-gradient(135deg, var(--bl5) 0%, var(--bl7) 55%, var(--bl9) 100%);
    border-radius: 36px;
    padding: 5rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Wavy circles inside banner */
.cta-banner::before {
    content: '';
    position: absolute;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    top: -200px; right: -150px;
    pointer-events: none;
}
.cta-banner::after {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    bottom: -100px; left: -80px;
    pointer-events: none;
}

/* Wave lines inside banner */
.cta-wave-lines {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    overflow: hidden;
    pointer-events: none;
    border-radius: inherit;
}
.cta-wave-lines svg {
    position: absolute;
    opacity: 0.07;
}

.cta-banner h2 {
    font-family: var(--font-main);
    font-size: clamp(1.7rem, 4vw, 2.5rem);
    font-weight: 800;
    color: var(--wh);
    letter-spacing: -0.025em;
    margin-bottom: 1.1rem;
    position: relative; z-index: 1;
    line-height: 1.15;
}
.cta-banner p {
    font-family: var(--font-body);
    font-size: 0.96rem;
    color: rgba(255,255,255,0.72);
    max-width: 460px;
    margin: 0 auto 2.2rem;
    line-height: 1.75;
    position: relative; z-index: 1;
}

/* ══════════════════════════════════════════════════════════
   BUTTONS
══════════════════════════════════════════════════════════ */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0 1.75em;
    border-radius: 999px;
    font-family: var(--font-main);
    font-size: 0.88rem;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: none;
    white-space: nowrap;
    transition: background var(--tr), box-shadow var(--tr), transform var(--tr);
    background: linear-gradient(135deg, var(--bl5), var(--bl7));
    color: var(--wh);
    box-shadow: 0 4px 14px rgba(33,102,232,0.38);
    height: 46px;
    letter-spacing: 0.01em;
}
.btn:hover {
    background: linear-gradient(135deg, var(--bl4), var(--bl5));
    box-shadow: 0 6px 20px rgba(33,102,232,0.48);
    transform: translateY(-2px);
    color: var(--wh);
}
.btn:active { transform: translateY(0); }

.btn-outline {
    background: transparent;
    color: var(--g6);
    border: 1.5px solid var(--g2);
    box-shadow: none;
    height: 46px;
}
.btn-outline:hover {
    background: var(--g1);
    border-color: var(--bl1);
    color: var(--bl7);
    box-shadow: none;
    transform: translateY(-1px);
}

.btn-cta-white {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0 2em;
    border-radius: 999px;
    font-family: var(--font-main);
    font-size: 0.95rem;
    font-weight: 700;
    text-decoration: none;
    background: var(--wh);
    color: var(--bl7);
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 24px rgba(0,0,0,0.20);
    transition: background var(--tr), box-shadow var(--tr), color var(--tr), transform var(--tr);
    position: relative;
    z-index: 1;
    height: 50px;
    letter-spacing: 0.01em;
}
.btn-cta-white:hover {
    background: var(--bl0);
    color: var(--bl9);
    box-shadow: 0 10px 32px rgba(0,0,0,0.25);
    transform: translateY(-2px);
}
.btn-cta-white:active { transform: translateY(0); }
.btn-cta-white svg {
    width: 16px; height: 16px;
    stroke: currentColor; fill: none;
    stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    transition: transform var(--tr);
}
.btn-cta-white:hover svg { transform: translateX(4px); }

/* ══════════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════════ */
@media (max-width: 768px) {
    .hero {
        grid-template-columns: 1fr;
        min-height: auto;
        padding: 3rem 1.5rem 2.5rem;
        text-align: center;
        gap: 2.5rem;
    }
    .hero-content { order: 1; }
    .hero-visual  { order: 2; }
    .hero-desc    { max-width: 100%; margin-left: auto; margin-right: auto; }
    .hero-cta     { justify-content: center; }
    .hero-badges  { justify-content: center; }
    .illus-main-card { max-width: 320px; margin: 0 auto; }
    .illus-float-card--a { right: -10px; }
    .illus-float-card--b { left: -10px; }

    .steps-section { padding: 3.5rem 1.25rem 3.5rem; }
    .steps-grid    { grid-template-columns: 1fr; }
    .steps-grid::before { display: none; }
    .steps-testimonials { grid-template-columns: 1fr; padding-bottom: 3rem; }
    .steps-deco-ring { display: none; }

    .cta-section { padding: 3rem 1.25rem; }
    .cta-banner  { padding: 3.5rem 1.75rem; border-radius: var(--r-xl); }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .hero { padding: 4rem 2.5rem; gap: 2.5rem; }
    .steps-grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
@endsection

@section('content')

{{-- ═══════════════════════════════════════
     HERO
════════════════════════════════════════ --}}
<div class="hero-wrapper">

    {{-- Decorative floating blobs --}}
    <div class="deco-blob deco-blob--a"></div>
    <div class="deco-blob deco-blob--b"></div>
    <div class="deco-blob deco-blob--c"></div>
    <div class="deco-blob deco-blob--d"></div>
    <div class="deco-blob deco-blob--e"></div>
    <div class="deco-blob deco-blob--f"></div>
    <div class="deco-ring deco-ring--1"></div>
    <div class="deco-ring deco-ring--2"></div>
    <div class="deco-ring deco-ring--3"></div>

    <section class="hero">

        {{-- KIRI: teks --}}
        <div class="hero-content">
            <div class="hero-eyebrow">
                <span class="dot"></span>
                Burnout Assessment Tool (BAT)
            </div>

            <h1 class="hero-title">
                Cek Tingkat Risiko<br>
                <span class="accent">Burnout</span><br>
                Akademikmu
            </h1>

            <p class="hero-desc">
                Kenali tanda-tanda burnout akademik lebih awal agar kamu lebih peka terhadap kondisi diri sendiri selama menjalani perkuliahan. Hasil yang ditampilkan hanya sebagai gambaran awal kondisi yang kamu alami.
            </p>

            <div class="hero-cta">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn">Ke Dashboard Saya</a>
                @else
                    <a href="{{ route('register') }}" class="btn">Mulai Tes Sekarang</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                @endauth
            </div>

            {{-- Decorative trust badges --}}
            <div class="hero-badges">
                <div class="hero-badge">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                        <path d="M10 1.5L12.39 6.26L17.61 7.03L13.81 10.74L14.78 15.97L10 13.27L5.22 15.97L6.19 10.74L2.39 7.03L7.61 6.26L10 1.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" fill="none"/>
                    </svg>
                    Tervalidasi Klinis
                </div>
                <div class="hero-badge">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                        <path d="M10 2C10 2 4 5 4 10.5C4 13.5 6.5 16 10 18C13.5 16 16 13.5 16 10.5C16 5 10 2 10 2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" fill="none"/>
                        <polyline points="7.5,10.5 9.5,12.5 13,8.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Aman & Privat
                </div>
                <div class="hero-badge">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15">
                        <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6"/>
                        <polyline points="10,6 10,10 13,12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Hasil Instan
                </div>
            </div>
        </div>

        {{-- KANAN: ilustrasi SVG --}}
        <div class="hero-visual">
            <div class="hero-illus">
                <div class="illus-deco illus-deco--1"></div>
                <div class="illus-deco illus-deco--2"></div>
                <div class="illus-deco illus-deco--3"></div>

                {{-- Floating mini card A: chart bars --}}
                <div class="illus-float-card illus-float-card--a">
                    <div class="float-icon float-icon--blue">
                        <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <div>
                        <div class="mini-bars">
                            <div class="mini-bar-row">
                                <div class="mini-bar-track"><div class="mini-bar-fill" style="width:72%"></div></div>
                                <span class="mini-bar-label">72</span>
                            </div>
                            <div class="mini-bar-row">
                                <div class="mini-bar-track"><div class="mini-bar-fill" style="width:45%;background:linear-gradient(90deg,#7db3ff,#4d8ef5)"></div></div>
                                <span class="mini-bar-label">45</span>
                            </div>
                            <div class="mini-bar-row">
                                <div class="mini-bar-track"><div class="mini-bar-fill" style="width:88%"></div></div>
                                <span class="mini-bar-label">88</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main card --}}
                <div class="illus-main-card">
                    <div class="illus-svg-wrap">

                        {{-- SVG Illustration: person with clipboard + brain icon --}}
                        <div class="illus-figure">
                            <svg viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                                <!-- Background circle -->
                                <circle cx="80" cy="80" r="72" fill="rgba(33,102,232,0.07)" />
                                <circle cx="80" cy="80" r="55" fill="rgba(33,102,232,0.05)" />

                                <!-- Person body -->
                                <ellipse cx="80" cy="120" rx="28" ry="16" fill="rgba(33,102,232,0.12)" />
                                <rect x="60" y="80" width="40" height="42" rx="12" fill="#d0e4ff" />
                                <rect x="63" y="83" width="34" height="36" rx="10" fill="#e8f4ff" />

                                <!-- Shirt detail lines -->
                                <line x1="80" y1="88" x2="80" y2="112" stroke="rgba(33,102,232,0.2)" stroke-width="1.5" stroke-linecap="round"/>

                                <!-- Head -->
                                <circle cx="80" cy="62" r="18" fill="#fddcb5" />
                                <!-- Hair -->
                                <path d="M64 58 Q68 44 80 44 Q92 44 96 58 Q92 52 80 54 Q68 52 64 58Z" fill="#6b4226" />
                                <!-- Eyes -->
                                <circle cx="74" cy="62" r="2.5" fill="#3c2a1a" />
                                <circle cx="86" cy="62" r="2.5" fill="#3c2a1a" />
                                <circle cx="75" cy="61" r="0.8" fill="#fff" />
                                <circle cx="87" cy="61" r="0.8" fill="#fff" />
                                <!-- Smile -->
                                <path d="M75 68 Q80 72 85 68" stroke="#c4855a" stroke-width="1.5" fill="none" stroke-linecap="round"/>

                                <!-- Left arm holding clipboard -->
                                <rect x="38" y="82" width="26" height="6" rx="3" fill="#d0e4ff" />
                                <!-- Right arm -->
                                <rect x="96" y="82" width="22" height="6" rx="3" fill="#d0e4ff" />

                                <!-- Clipboard -->
                                <rect x="34" y="70" width="28" height="36" rx="4" fill="#f0f6ff" stroke="rgba(33,102,232,0.25)" stroke-width="1.5"/>
                                <rect x="42" y="66" width="12" height="8" rx="2" fill="rgba(33,102,232,0.3)" />
                                <!-- Clipboard lines -->
                                <line x1="40" y1="82" x2="56" y2="82" stroke="rgba(33,102,232,0.3)" stroke-width="1.5" stroke-linecap="round"/>
                                <line x1="40" y1="88" x2="56" y2="88" stroke="rgba(33,102,232,0.3)" stroke-width="1.5" stroke-linecap="round"/>
                                <line x1="40" y1="94" x2="52" y2="94" stroke="rgba(33,102,232,0.3)" stroke-width="1.5" stroke-linecap="round"/>

                                <!-- Checkmark on clipboard -->
                                <circle cx="44" cy="82" r="0" fill="none"/>
                                <polyline points="39,100 42,104 50,96" stroke="#2166e8" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>

                                <!-- Brain icon (top right) -->
                                <circle cx="118" cy="46" r="18" fill="rgba(33,102,232,0.10)" />
                                <path d="M110 46 Q110 38 118 38 Q126 38 126 46 Q126 50 122 52 L122 56 L114 56 L114 52 Q110 50 110 46Z" fill="rgba(33,102,232,0.25)" stroke="rgba(33,102,232,0.5)" stroke-width="1.2" stroke-linejoin="round"/>
                                <path d="M114 44 Q116 41 118 43 Q120 41 122 44" stroke="rgba(33,102,232,0.6)" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                                <line x1="118" y1="43" x2="118" y2="52" stroke="rgba(33,102,232,0.5)" stroke-width="1.2" stroke-linecap="round"/>

                                <!-- Star / sparkle decoration -->
                                <g transform="translate(130,100)">
                                    <line x1="0" y1="-6" x2="0" y2="6" stroke="rgba(33,102,232,0.4)" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="-6" y1="0" x2="6" y2="0" stroke="rgba(33,102,232,0.4)" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="-4" y1="-4" x2="4" y2="4" stroke="rgba(33,102,232,0.25)" stroke-width="1" stroke-linecap="round"/>
                                    <line x1="4" y1="-4" x2="-4" y2="4" stroke="rgba(33,102,232,0.25)" stroke-width="1" stroke-linecap="round"/>
                                </g>

                                <!-- Small sparkle 2 -->
                                <g transform="translate(30,40)">
                                    <line x1="0" y1="-4" x2="0" y2="4" stroke="rgba(33,102,232,0.3)" stroke-width="1.2" stroke-linecap="round"/>
                                    <line x1="-4" y1="0" x2="4" y2="0" stroke="rgba(33,102,232,0.3)" stroke-width="1.2" stroke-linecap="round"/>
                                </g>

                                <!-- Dots decoration -->
                                <circle cx="26" cy="76" r="3" fill="rgba(33,102,232,0.15)" />
                                <circle cx="134" cy="76" r="3" fill="rgba(77,142,245,0.2)" />
                                <circle cx="100" cy="30" r="4" fill="rgba(33,102,232,0.12)" />
                            </svg>
                        </div>

                        {{-- Score result --}}
                        <div class="illus-score-badge">
                            <div class="illus-score-label">Skor Burnout Anda</div>
                            <div class="illus-score-number">87</div>
                            <span class="illus-score-pill">Tingkat Sedang</span>
                        </div>

                    </div>
                </div>

                {{-- Floating mini card B: analisis selesai --}}
                <div class="illus-float-card illus-float-card--b">
                    <div class="float-icon float-icon--green">
                        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 1 0 20A10 10 0 0 1 12 2z"/><polyline points="9 12 11 14 15 10"/></svg>
                    </div>
                    <div class="float-text">
                        <strong>Analisis Selesai!</strong>
                        <span>Skor kamu sudah siap</span>
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- Wave divider --}}
    <div class="wave-divider">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg" height="60">
            <path d="M0 0 C240 60 480 60 720 30 C960 0 1200 0 1440 60 L1440 60 L0 60 Z" fill="#f7f9fc"/>
        </svg>
    </div>
</div>

{{-- ═══════════════════════════════════════
     3 LANGKAH
════════════════════════════════════════ --}}
<section class="steps-section">
    {{-- Dots decorations --}}
    <div class="dot-grid">
        @for($i = 0; $i < 30; $i++)
            <span></span>
        @endfor
    </div>
    <div class="dot-grid-left">
        @for($i = 0; $i < 16; $i++)
            <span></span>
        @endfor
    </div>

    {{-- Ring decorations --}}
    <div class="steps-deco-ring steps-deco-ring--1"></div>
    <div class="steps-deco-ring steps-deco-ring--2"></div>
    <div class="steps-deco-ring steps-deco-ring--3"></div>

    <p class="section-label">Cara Kerja</p>
    <h2 class="section-title">3 Langkah Mudah</h2>
    <p class="section-subtitle">Proses sederhana untuk memahami kesehatan mental akademik Anda</p>

    <div class="steps-grid">
        <div class="step-card">
            <span class="step-number">01</span>
            <div class="step-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
            </div>
            <h3>Isi Kuesioner</h3>
            <p>Jawab serangkaian pertanyaan mengenai rutinitas akademik, tingkat stres, dan kelelahan Anda secara jujur.</p>
            <span class="step-chip">~5 Menit</span>
        </div>

        <div class="step-card">
            <span class="step-number">02</span>
            <div class="step-icon">
                <svg viewBox="0 0 24 24">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6"  y1="20" x2="6"  y2="14"/>
                </svg>
            </div>
            <h3>Lihat Hasil</h3>
            <p>Dapatkan analisis instan mengenai tingkat burnout Anda melalui parameter yang tervalidasi secara klinis.</p>
            <span class="step-chip">Hasil Instan</span>
        </div>

        <div class="step-card">
            <span class="step-number">03</span>
            <div class="step-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
            </div>
            <h3>Download Laporan</h3>
            <p>Simpan hasil deteksi dalam format PDF untuk referensi pribadi atau diskusi dengan ahli profesional.</p>
            <span class="step-chip">Format PDF</span>
        </div>
    </div>

</section>

{{-- ═══════════════════════════════════════
     CTA BANNER
════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="cta-banner">
        <div class="cta-wave-lines">
            <svg width="100%" height="100%" viewBox="0 0 960 280" preserveAspectRatio="xMidYMid slice">
                <path d="M-60 200 Q240 100 540 200 Q780 280 1020 160" stroke="white" stroke-width="2" fill="none"/>
                <path d="M-60 240 Q240 140 540 240 Q780 320 1020 200" stroke="white" stroke-width="2" fill="none"/>
                <path d="M-60 160 Q200 80 480 160 Q720 240 1000 120" stroke="white" stroke-width="1.5" fill="none"/>
            </svg>
        </div>

        <h2>Siap Mengetahui Kondisi<br>Akademikmu?</h2>
        <p>
            Hanya butuh 5 menit untuk mendapatkan gambaran kesehatan mental akademik
            Anda. Jangan biarkan stres menghambat masa depanmu.
        </p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn-cta-white">
                Ke Dashboard
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-cta-white">
                Mulai Tes Sekarang
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        @endauth
    </div>
</section>

@endsection