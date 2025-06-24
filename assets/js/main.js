// --- Fichier: assets/js/main.js ---
/**
 * Fichier JavaScript principal pour le thème InnovLaTuque.
 * Version: 2.0.0 (Révisé)
 * Description: Gère l'interactivité du site avec une structure modulaire,
 * robuste et facile à déboguer.
 */
document.addEventListener('DOMContentLoaded', () => {

    // =========================================================================
    // APP STATE & CONFIGURATION
    // =========================================================================
    const config = {
        apiKey: window.wpData?.apiKey || "",
        lang: localStorage.getItem('lang') || 'fr',
        translations: JSON.parse(window.wpData?.translations || '{}')
    };

    // =========================================================================
    // UI MODULES (IIFE Pattern)
    // Chaque module est isolé pour éviter les conflits de variables.
    // =========================================================================

    /**
     * Gère le changement de langue et la mise à jour des textes.
     */
    const LanguageModule = (() => {
        function switchLanguage(lang) {
            config.lang = lang;
            localStorage.setItem('lang', lang);
            document.documentElement.lang = lang === 'fr' ? 'fr-CA' : 'en-US';
            
            const langData = config.translations[lang] || {};

            document.querySelectorAll('[data-lang]').forEach(el => {
                const key = el.dataset.lang;
                if (langData[key]) el.innerHTML = langData[key];
            });

            document.querySelectorAll('[data-lang-placeholder]').forEach(el => {
                const key = el.dataset.langPlaceholder;
                if (langData[key]) el.placeholder = langData[key];
            });

            document.querySelectorAll('[data-lang-switcher]').forEach(el => {
                el.textContent = langData.langSwitcher || (lang === 'fr' ? 'EN' : 'FR');
            });
        }

        function init() {
            document.querySelectorAll('[data-lang-switcher]').forEach(switcher => {
                switcher.addEventListener('click', () => switchLanguage(config.lang === 'fr' ? 'en' : 'fr'));
            });
            switchLanguage(config.lang); // Applique la langue au chargement
        }

        return { init };
    })();

    /**
     * Gère le menu de navigation mobile.
     */
    const MobileMenuModule = (() => {
        const menuButton = document.getElementById('mobile-menu-button');
        const closeButton = document.getElementById('mobile-menu-close-button');
        const menuPanel = document.getElementById('mobile-menu-panel');
        const menuOverlay = document.getElementById('mobile-menu-overlay');

        function openMenu() {
            if (!menuPanel || !menuOverlay) return;
            menuPanel.classList.add('is-open');
            menuOverlay.classList.remove('hidden');
        }

        function closeMenu() {
            if (!menuPanel || !menuOverlay) return;
            menuPanel.classList.remove('is-open');
            menuOverlay.classList.add('hidden');
        }

        function init() {
            if (!menuButton) return;
            menuButton.addEventListener('click', openMenu);
            closeButton?.addEventListener('click', closeMenu);
            menuOverlay?.addEventListener('click', closeMenu);
            menuPanel?.querySelectorAll('a, button').forEach(link => link.addEventListener('click', closeMenu));
        }
        return { init };
    })();

    /**
     * Gère la fenêtre modale pour la proposition de projet.
     */
    const ModalModule = (() => {
        const projectModal = document.getElementById('project-modal');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const cancelModalBtn = document.getElementById('cancel-modal-btn');

        function open() {
            if (!projectModal) return;
            projectModal.classList.remove('opacity-0', 'pointer-events-none');
            projectModal.querySelector('.modal-container')?.classList.remove('scale-95');
        }

        function close() {
            if (!projectModal) return;
            projectModal.classList.add('opacity-0', 'pointer-events-none');
            projectModal.querySelector('.modal-container')?.classList.add('scale-95');
        }

        function init() {
            document.querySelectorAll('.js-open-modal').forEach(btn => btn.addEventListener('click', open));
            closeModalBtn?.addEventListener('click', close);
            cancelModalBtn?.addEventListener('click', close);
            projectModal?.addEventListener('click', (e) => {
                if (e.target === projectModal) close();
            });
        }
        return { init };
    })();

    /**
     * Gère les animations au défilement (Animate On Scroll).
     */
    const AnimationModule = (() => {
        function init() {
            if (!('IntersectionObserver' in window)) return;
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.aos-animate').forEach(el => observer.observe(el));
        }
        return { init };
    })();

    /**
     * Gère toute la logique liée à l'API Gemini.
     */
    const GeminiModule = (() => {
        // Elements for Idea Generator
        const genBtn = document.getElementById('generate-ideas-btn');
        const keywordsIn = document.getElementById('idea-keywords');
        const resultsDiv = document.getElementById('idea-results');
        const spinnerIdeas = document.getElementById('loading-spinner-ideas');
        
        // Elements for Project Assistant
        const imprBtn = document.getElementById('improve-desc-btn');
        const ideaIn = document.getElementById('project-idea-input');
        const imprCont = document.getElementById('improved-desc-container');
        const ideaOut = document.getElementById('project-idea-output');
        const spinnerModal = document.getElementById('loading-spinner-modal');

        async function callGemini(prompt) {
            if (!config.apiKey) {
                console.error("Gemini API Key is missing.");
                throw new Error("La clé API n'est pas configurée.");
            }
            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${config.apiKey}`;
            const payload = { contents: [{ role: "user", parts: [{ text: prompt }] }] };
            const response = await fetch(apiUrl, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
            
            if (!response.ok) {
                console.error("API Error Response:", await response.text());
                throw new Error("Erreur de communication avec le service d'IA.");
            }
            const result = await response.json();
            if (result.candidates?.[0]?.content?.parts?.[0]?.text) {
                return result.candidates[0].content.parts[0].text;
            }
            console.error("Unexpected API response structure:", result);
            throw new Error("La réponse de l'IA est dans un format inattendu.");
        }

        function setupIdeaGenerator() {
            if (!genBtn) return;
            genBtn.addEventListener('click', async () => {
                if (!keywordsIn.value.trim()) {
                    resultsDiv.innerHTML = `<p class="text-red-500 text-center">${config.translations[config.lang].errorEnterKeyword}</p>`;
                    return;
                }
                spinnerIdeas.classList.remove('hidden');
                genBtn.disabled = true;
                resultsDiv.innerHTML = `<p class="text-center text-slate-500">Recherche d'idées en cours...</p>`;
                try {
                    const prompt = config.translations[config.lang].geminiIdeaPrompt.replace('{keywords}', keywordsIn.value);
                    const generatedText = await callGemini(prompt);
                    let htmlContent = generatedText
                        .replace(/### (.*)/g, '<div class="bg-white p-6 rounded-lg shadow border border-slate-200"><h3 class="text-xl font-bold text-slate-800 mb-2">$1</h3>')
                        .replace(/\*\*(.*?):\*\* (.*)/g, '<p class="text-slate-600"><strong class="font-semibold text-slate-700">$1:</strong> $2</p>')
                        .replace(/\n\n/g, '</div>').replace(/\n/g, '<br>');
                    if ((htmlContent.match(/<div/g) || []).length > (htmlContent.match(/<\/div>/g) || []).length) htmlContent += '</div>';
                    resultsDiv.innerHTML = htmlContent;
                } catch (error) {
                    resultsDiv.innerHTML = `<p class="text-red-500 text-center">${error.message}</p>`;
                } finally {
                    spinnerIdeas.classList.add('hidden');
                    genBtn.disabled = false;
                }
            });
        }

        function setupProjectAssistant() {
            if (!imprBtn) return;
            imprBtn.addEventListener('click', async () => {
                if (!ideaIn.value.trim()) {
                    ideaOut.innerHTML = `<p class="text-red-500">${config.translations[config.lang].errorDescribeIdea}</p>`;
                    imprCont.classList.remove('hidden');
                    return;
                }
                spinnerModal.classList.remove('hidden');
                imprBtn.disabled = true;
                imprCont.classList.remove('hidden');
                ideaOut.innerHTML = `<p class="text-center text-slate-500">Amélioration en cours...</p>`;
                try {
                    const prompt = config.translations[config.lang].geminiImprovePrompt.replace('{idea}', ideaIn.value);
                    ideaOut.innerText = await callGemini(prompt);
                } catch (error) {
                    ideaOut.innerHTML = `<p class="text-red-500">${error.message}</p>`;
                } finally {
                    spinnerModal.classList.add('hidden');
                    imprBtn.disabled = false;
                }
            });
        }

        function init() {
            setupIdeaGenerator();
            setupProjectAssistant();
        }
        return { init };
    })();

    // =========================================================================
    // INITIALIZE ALL MODULES
    // =========================================================================
    LanguageModule.init();
    MobileMenuModule.init();
    ModalModule.init();
    AnimationModule.init();
    GeminiModule.init();
});
