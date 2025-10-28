import { animate, splitText, stagger} from 'animejs';

// Animasi Login Card
animate('.loginCard', {
    translateX: [-80, 0],
    opacity: [0, 1],
    duration: 800,
    easing: 'out-expo'
});

// Animasi Lottie Player
animate('.anim', {
    translateX: [80, 0],
    opacity: [0, 1],
    duration: 1200,
    delay: 200,
    easing: 'out-expo'
});

// Animasi Logo
animate('#logo', {
    translateY: [-100, 0],
    opacity: [0, 1],
    scale: [0.5, 1],
    duration: 1500,
    easing: 'out-elastic',
    delay: 300
});

// Animasi Heading
animate('#info', {
    translateY: [-50, 0],
    opacity: [0, 1],
    duration: 1000,
    delay: 600,
    easing: 'out-quad'
});

// Animasi Subtitle dengan splitText
const { chars } = splitText('#infoSub', { words: false, chars: true });
animate(chars, {
  // Property keyframes
  y: [
    { to: '1.75rem', ease: 'outExpo', duration: 600 },
    { to: 0, ease: 'outBounce', duration: 800, delay: 100 }
  ],
  x:[
    {}
  ],
  // Property specific parameters
  rotate: {
    from: '-1turn',
    delay: 0
  },
  delay: stagger(50),
  ease: 'inOutCirc',
  loopDelay: 1000,
  loop: true
});

// Animasi Flash Messages jika ada
const flashMsg = document.querySelector('.flashMsg > div');
if (flashMsg) {
    animate(flashMsg, {
        translateY: [-20, 0],
        opacity: [0, 1],
        scale: [0.95, 1],
        duration: 600,
        easing: 'out-back'
    });
}

// Animasi form inputs dengan stagger
animate('.loginCard .mb-3', {
    translateX: [-30, 0],
    opacity: [0, 1],
    delay: stagger(100, { start: 400 }),
    duration: 800,
    easing: 'out-quad'
});

// Animasi button
animate('#btnSignIn', {
    scale: [0.9, 1],
    opacity: [0, 1],
    delay: 900,
    duration: 600,
    easing: 'out-back'
});

// Animasi footer
animate('.loginCard .mt-5', {
    opacity: [0, 1],
    translateY: [20, 0],
    delay: 1200,
    duration: 800,
    easing: 'out-quad'
});

// Hover effect 
const signInBtn = document.getElementById('btnSignIn');

if (signInBtn) {
    signInBtn.addEventListener('mouseenter', function() {
        animate(this, {
            scale: 1.05,
            duration: 300,
            easing: 'out-quad'
        });
    });

    signInBtn.addEventListener('mouseleave', function() {
        animate(this, {
            scale: 1,
            duration: 300,
            easing: 'out-quad'
        });
    });
}