import './bootstrap';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm.js';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import Zoomable from '@benbjurstrom/alpinejs-zoomable';

Alpine.plugin(Zoomable);
Alpine.plugin(Clipboard);

Livewire.start();
