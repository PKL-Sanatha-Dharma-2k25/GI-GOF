import {createTimeline } from 'animejs';
document.addEventListener('DOMContentLoaded', () => {
const tl = createTimeline({ defaults: { duration: 2000 } });
tl.label('start')
.add('#dashboardIcon', {
    translateX: [-80, 0],
    duration: 600,
    rotate: '1turn'
}, 'start')
.add('#dashboardText', {
    translateX: [80, 0],
    duration: 600,
    easing: 'out-expo',
}, 'start')
.add('#logoGI', {
            translateY: [-80, 0],
            opacity: [0, 1],
            duration: 700,
            easing:'out-quad',
        }, 'start')
        .add('#pendingIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 300)
        .add('#pendingText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 300)
        .add('#approvedIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 600)
        .add('#approvedText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 600)
        .add('#createIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 300)
        .add('#createText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 300)
        .add('#myIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 600)
        .add('#myText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 600)
        .add('#finishedIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 900)
        .add('#finishedText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 900)
        .add('#rejectedIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 1200)
        .add('#rejectedText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 1200)
        .add('#allIcon', {
            translateX: [-80, 0],
            opacity: [0, 1],
            duration: 600,
            rotate: '1turn'
        }, 1500)
        .add('#allText', {
            translateX: [80, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'out-expo',
        }, 1500);
    });