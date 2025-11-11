#!/usr/bin/env node

import { chromium } from 'playwright';
import fs from 'node:fs';
import path from 'node:path';
import { pathToFileURL } from 'node:url';

const [, , configPath] = process.argv;

if (!configPath) {
    console.error('Missing render configuration path.');
    process.exit(1);
}

const configRaw = await fs.promises.readFile(configPath, 'utf8');
const config = JSON.parse(configRaw);

if (!Array.isArray(config.jobs) || config.jobs.length === 0) {
    console.error('Render configuration must include at least one job.');
    process.exit(1);
}

const browser = await chromium.launch({
    headless: true,
});

try {
    for (const job of config.jobs) {
        const htmlPath = job.html;
        const outputPath = job.output;
        const width = Number(job.width ?? 1200);
        const height = Number(job.height ?? 630);
        const scale = Number(job.scale ?? 2);
        const waitFor = Number(job.waitFor ?? 200);
        const format = job.format === 'jpeg' ? 'jpeg' : 'png';
        const quality = Number(job.quality ?? (format === 'jpeg' ? 90 : undefined));

        if (!htmlPath || !outputPath) {
            console.warn('Skipping job because html or output path missing.');
            continue;
        }

        await fs.promises.mkdir(path.dirname(outputPath), { recursive: true });

        const page = await browser.newPage({
            viewport: {
                width,
                height,
            },
            deviceScaleFactor: scale,
        });

        const fileUrl = pathToFileURL(htmlPath).toString();
        await page.goto(fileUrl, { waitUntil: 'networkidle' });

        if (waitFor > 0) {
            await page.waitForTimeout(waitFor);
        }

        const screenshotOptions = {
            path: outputPath,
            type: format,
            animations: 'disabled',
            fullPage: false,
        };

        if (format === 'jpeg' && Number.isFinite(quality)) {
            screenshotOptions.quality = quality;
        }

        await page.screenshot(screenshotOptions);

        await page.close();
    }
} finally {
    await browser.close();
}

