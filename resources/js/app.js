import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


window.submit_disabled = function(element) {
    element.disabled = true
    setTimeout(() => {
        element.disabled = false
    },5000)
}
