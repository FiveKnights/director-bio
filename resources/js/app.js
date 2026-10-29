import './bootstrap';
import Alpine from 'alpinejs';
import './portfolio-terminal';
import { initReveal } from './reveal';

window.Alpine = Alpine;
Alpine.start();
initReveal();