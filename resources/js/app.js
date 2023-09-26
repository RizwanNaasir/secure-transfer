import './bootstrap';
// import './charts/bar-chart';
// import './charts/line-chart';
// import './filepond';
import Alpine from 'alpinejs';
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'

Alpine.plugin(AlpineFloatingUI)

window.Alpine = Alpine;

Alpine.start();
