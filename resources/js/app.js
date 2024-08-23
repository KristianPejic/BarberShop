import './bootstrap';

import Alpine from 'alpinejs';

import {  Offcanvas, Ripple, Input, initTWE } from "tw-elements";

initTWE({ Offcanvas, Ripple, Input }, { allowReinits: true });

window.Alpine = Alpine;

Alpine.start();

