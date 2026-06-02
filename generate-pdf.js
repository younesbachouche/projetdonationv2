import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

(async () => {
    try {
        const browser = await puppeteer.launch({
            headless: 'new',
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        });
        
        const page = await browser.newPage();
        const htmlPath = 'file://' + path.resolve(__dirname, 'Rapport_Projet_Donation_Final.html');
        
        await page.goto(htmlPath, { waitUntil: 'networkidle2' });
        
        await page.pdf({
            path: path.resolve(__dirname, 'Rapport_Projet_Donation.pdf'),
            format: 'A4',
            margin: {
                top: '20mm',
                right: '15mm',
                bottom: '20mm',
                left: '15mm'
            },
            printBackground: true,
            scale: 1
        });
        
        await browser.close();
        console.log('✅ PDF généré avec succès : Rapport_Projet_Donation.pdf');
    } catch (error) {
        console.error('❌ Erreur lors de la génération du PDF:', error);
    }
})();
