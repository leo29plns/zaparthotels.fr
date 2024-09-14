import { startStimulusApp } from '@symfony/stimulus-bundle';
import morphdom from 'morphdom';
import { headerSidePannelDispatcher } from './scripts/_commons/headerSidePannelDispatcher.js';

// Stimulus
const app = startStimulusApp();

// Turbo morph
document.addEventListener('turbo:before-render', (event) => {
    event.detail.render = (currentElement, newElement) => {
        morphdom(currentElement, newElement);
    }
});

// Header side panel
const headerSidePannel = new headerSidePannelDispatcher();

document.addEventListener('turbo:load', () => {
    // Do something...
});
