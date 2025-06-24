<?php // --- Fichier: template-parts/section-idea-generator.php --- ?>
<section id="idea-generator" class="py-20 bg-slate-100">
    <div class="container mx-auto px-6 aos-animate">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900"><span data-lang="ideaGenTitle">Boîte à Idées</span> <span class="text-emerald-600" data-lang="ideaGenTitleHighlight">Innovantes</span> ✨</h2>
            <p class="mt-4 text-lg text-slate-600 max-w-3xl mx-auto" data-lang="ideaGenSubtitle">En panne d'inspiration ? Entrez un secteur et laissez notre IA vous proposer des concepts de projets pour La Tuque.</p>
        </div>
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-slate-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="text" id="idea-keywords" placeholder="Ex: Tourisme durable..." data-lang-placeholder="ideaGenPlaceholder" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none transition">
                <button id="generate-ideas-btn" class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition duration-300 shadow w-full sm:w-auto flex items-center justify-center shrink-0"><span class="btn-text" data-lang="ideaGenBtn">Générer des idées</span><svg id="loading-spinner-ideas" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></button>
            </div>
            <div id="idea-results" class="mt-8 space-y-4"></div>
        </div>
    </div>
</section>