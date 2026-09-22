@extends('layouts.guest')

@section('content')
<div class="relative min-h-[70vh] px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto py-16 sm:py-24">
    <!-- Ambient Radial Glows -->
    <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-emerald-500/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="relative z-10">
        <!-- Top Navigation / Breadcrumb -->
        <div class="mb-10 flex items-center gap-2 text-xs font-medium text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>
            <span>/</span>
            <span class="text-slate-300">Terms and Conditions</span>
        </div>

        <!-- Terms Header Card -->
        <div class="rounded-3xl border border-slate-800 bg-gradient-to-b from-slate-900/90 via-slate-950/90 to-slate-950 p-8 sm:p-12 shadow-2xl mb-12">
            <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-400 uppercase tracking-widest mb-4">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Legal &amp; Terms of Service
            </div>
            <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">Terms and Conditions</h1>
            <p class="text-sm sm:text-base text-emerald-400/90 font-medium mt-3 flex items-center gap-2 font-mono">
                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Last updated: September 22, 2026
            </p>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 pt-6 border-t border-slate-800/80">
                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-4">
                    <div class="text-xs font-bold uppercase tracking-wider text-emerald-400">Head Office</div>
                    <div class="text-sm font-bold text-white mt-1">Taskverge PVT LTD</div>
                    <p class="text-xs text-slate-400 mt-1">165/7 Pickerings Road, Colombo 01500, Sri Lanka</p>
                    <div class="text-xs text-slate-300 font-mono mt-2 flex items-center gap-1.5">
                        <span>Tel:</span>
                        <a href="tel:+94717285555" class="text-emerald-400 hover:text-emerald-300 transition-colors font-semibold">+94717285555</a>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-4">
                    <div class="text-xs font-bold uppercase tracking-wider text-teal-400">USA Branch Office</div>
                    <div class="text-sm font-bold text-white mt-1">Taskverge LLC</div>
                    <p class="text-xs text-slate-400 mt-1">255 Ferry Blvd, Stratford, CT 06615, United States</p>
                    <div class="text-xs text-slate-300 font-mono mt-2 flex items-center gap-1.5">
                        <span>Tel:</span>
                        <a href="tel:+12038708505" class="text-teal-400 hover:text-teal-300 transition-colors font-semibold">+12038708505</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terms Content Container -->
        <article class="rounded-3xl border border-slate-800 bg-slate-950 p-8 sm:p-12 shadow-xl space-y-8 text-slate-300 text-sm sm:text-base leading-relaxed">
            <p>Please read these terms and conditions carefully before using Our Service.</p>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Interpretation and Definitions</h2>
                
                <h3 class="text-lg sm:text-xl font-bold text-white mt-6 mb-2">Interpretation</h3>
                <p>The words whose initial letters are capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
                
                <h3 class="text-lg sm:text-xl font-bold text-white mt-6 mb-3">Definitions</h3>
                <p class="mb-4">For the purposes of these Terms and Conditions:</p>
                <ul class="space-y-3.5 list-disc pl-5 marker:text-emerald-400">
                    <li>
                        <p><strong class="text-white">Affiliate</strong> means an entity that controls, is controlled by, or is under common control with a party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Country/State</strong> refers to: Sri Lanka</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in these Terms and Conditions) refers to Taskverge PVT LTD, 165/7 Pickerings Road, Colombo 01500, Sri Lanka.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Device</strong> means any device that can access the Service such as a computer, a cell phone or a digital tablet.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Service</strong> refers to the Website.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Terms and Conditions</strong> (also referred to as &quot;Terms&quot;) means these Terms and Conditions, including any documents expressly incorporated by reference, which govern Your access to and use of the Service and form the entire agreement between You and the Company regarding the Service. These Terms and Conditions have been created with the help of the <a href="https://www.termsfeed.com/terms-conditions-generator/" target="_blank" rel="noopener noreferrer" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2 transition-colors">TermsFeed Terms and Conditions Generator</a>.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Third-Party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third party that is displayed, included, made available, or linked to through the Service.</p>
                    </li>
                    <li>
                        <p><strong class="text-white">Website</strong> refers to TaskVerge, accessible from <a href="https://taskverge.net" rel="external nofollow noopener" target="_blank" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2 transition-colors">https://taskverge.net</a></p>
                    </li>
                    <li>
                        <p><strong class="text-white">You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
                    </li>
                </ul>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Acknowledgment</h2>
                <p>These are the Terms and Conditions governing the use of this Service and the agreement between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
                <p class="mt-3">Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>
                <p class="mt-3">By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.</p>
                <p class="mt-3">You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>
                <p class="mt-3">Your access to and use of the Service is also subject to Our Privacy Policy, which describes how We collect, use, and disclose personal information. Please read Our <a href="{{ route('privacy') }}" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2 transition-colors">Privacy Policy</a> carefully before using Our Service.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Links to Other Websites</h2>
                <p>Our Service may contain links to third-party websites or services that are not owned or controlled by the Company.</p>
                <p class="mt-3">The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third-party websites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such websites or services.</p>
                <p class="mt-3">We strongly advise You to read the terms and conditions and privacy policies of any third-party websites or services that You visit.</p>

                <h3 class="text-lg sm:text-xl font-bold text-white mt-6 mb-2">Links from a Third-Party Social Media Service</h3>
                <p>The Service may display, include, make available, or link to content or services provided by a Third-Party Social Media Service. A Third-Party Social Media Service is not owned or controlled by the Company, and the Company does not endorse or assume responsibility for any Third-Party Social Media Service.</p>
                <p class="mt-3">You acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with Your access to or use of any Third-Party Social Media Service, including any content, goods, or services made available through them. Your use of any Third-Party Social Media Service is governed by that Third-Party Social Media Service's terms and privacy policies.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Termination</h2>
                <p>We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>
                <p class="mt-3">Upon termination, Your right to use the Service will cease immediately.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Limitation of Liability</h2>
                <p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of these Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven't purchased anything through the Service.</p>
                <p class="mt-3">To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of these Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
                <p class="mt-3">Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party's liability will be limited to the greatest extent permitted by law.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h2>
                <p>The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>
                <p class="mt-3">Without limiting the foregoing, neither the Company nor any of the company's provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
                <p class="mt-3">Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Governing Law</h2>
                <p>The laws of the Country/State, excluding its conflicts of law rules, shall govern these Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Disputes Resolution</h2>
                <p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">For European Union (EU) Users</h2>
                <p>If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which You are resident.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">United States Legal Compliance</h2>
                <p>You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Severability and Waiver</h2>
                
                <h3 class="text-lg sm:text-xl font-bold text-white mt-6 mb-2">Severability</h3>
                <p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>

                <h3 class="text-lg sm:text-xl font-bold text-white mt-6 mb-2">Waiver</h3>
                <p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under these Terms shall not affect a party's ability to exercise such right or require such performance at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Translation Interpretation</h2>
                <p>These Terms and Conditions may have been translated if We have made them available to You on our Service. You agree that the original English text shall prevail in the case of a dispute.</p>
            </div>

            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Changes to These Terms and Conditions</h2>
                <p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
                <p class="mt-3">By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the Service.</p>
            </div>

            <!-- Contact Section -->
            <div class="pt-6 border-t border-slate-800">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Contact Us</h2>
                <p class="mb-4">If you have any questions about these Terms and Conditions, You can contact us:</p>
                
                <ul class="space-y-3.5 list-disc pl-5 marker:text-emerald-400 mb-6">
                    <li>
                        <p>By email: <a href="mailto:help@taskverge.net" class="text-emerald-400 hover:text-emerald-300 font-medium underline underline-offset-2 transition-colors">help@taskverge.net</a></p>
                    </li>
                    <li>
                        <p>By visiting this page on our website: <a href="{{ route('home') }}#contact" class="text-emerald-400 hover:text-emerald-300 font-medium underline underline-offset-2 transition-colors">{{ url('/#contact') }}</a></p>
                    </li>
                </ul>

                <!-- Corporate Location Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <div class="rounded-2xl border border-slate-800 bg-slate-900/40 p-5">
                        <div class="inline-flex items-center gap-2 text-xs font-bold text-emerald-400 uppercase tracking-wider mb-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            Head Office (Sri Lanka)
                        </div>
                        <h4 class="text-base font-bold text-white">Taskverge PVT LTD</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">165/7 Pickerings Road, Colombo 01500, Sri Lanka</p>
                        <div class="mt-3 pt-3 border-t border-slate-800/80 flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-mono">Direct Line</span>
                            <a href="tel:+94717285555" class="text-emerald-400 hover:text-emerald-300 font-bold font-mono">+94717285555</a>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-800 bg-slate-900/40 p-5">
                        <div class="inline-flex items-center gap-2 text-xs font-bold text-teal-400 uppercase tracking-wider mb-2">
                            <span class="h-2 w-2 rounded-full bg-teal-400"></span>
                            USA Branch Office
                        </div>
                        <h4 class="text-base font-bold text-white">Taskverge LLC</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">255 Ferry Blvd, Stratford, CT 06615, United States</p>
                        <div class="mt-3 pt-3 border-t border-slate-800/80 flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-mono">Direct Line</span>
                            <a href="tel:+12038708505" class="text-teal-400 hover:text-teal-300 font-bold font-mono">+12038708505</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
