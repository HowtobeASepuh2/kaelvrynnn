import './bootstrap';

import AOS from 'aos';
import 'aos/dist/aos.css';

document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 800,
        once: true,
        offset: 80,
    });
});