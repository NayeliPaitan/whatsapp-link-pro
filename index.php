<?php require_once 'process.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Enlaces de WhatsApp - Nayeli Paitan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-30px) scale(1.08); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(30px) scale(0.95); }
        }
        .animate-blob-1 { animation: float-slow 12s ease-in-out infinite; }
        .animate-blob-2 { animation: float-reverse 16s ease-in-out infinite; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between font-sans selection:bg-emerald-500 selection:text-slate-950 relative overflow-x-hidden">

    <!-- FONDO -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl animate-blob-1"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl animate-blob-2"></div>
        <div class="absolute -bottom-40 left-1/3 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl animate-blob-1"></div>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen justify-between">
        <header class="border-b border-slate-800/80 bg-slate-950/70 backdrop-blur-md sticky top-0 z-50">
            <div class="container mx-auto px-4 py-3 max-w-6xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center border border-emerald-500/20">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </div>
                    <span class="font-bold text-white tracking-tight text-sm sm:text-base">Whatsapp Link Pro</span>
                </div>

                <nav class="hidden md:flex items-center gap-6 text-sm text-slate-300">
                    <a href="#inicio" class="hover:text-emerald-400 transition">Inicio</a>
                    <button onclick="toggleModal('modalDonaciones')" class="text-amber-400 hover:text-amber-300 font-medium transition flex items-center gap-1.5 bg-amber-400/10 px-3 py-1 rounded-full border border-amber-400/20">
                        <i class="fa-solid fa-mug-hot"></i> Donar
                    </button>
                    <button onclick="toggleModal('modalContacto')" class="hover:text-emerald-400 transition">Contacto</button>
                </nav>

                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 border-r border-slate-800 pr-3 mr-1 text-slate-400 text-base">
                        <a href="https://www.linkedin.com/in/nayeli-alison-paitan-ramirez/" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <a href="https://github.com/nayelipaitan" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="GitHub">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="https://www.instagram.com/blakedev.np/" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <a href="#generar" class="bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 text-xs px-4 py-2 rounded-xl font-semibold transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-user"></i> Acceder
                    </a>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8 max-w-5xl flex-grow" id="inicio">
            <div class="text-center mb-10 max-w-2xl mx-auto">
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">Generador de Enlaces de WhatsApp</h1>
                <p class="text-slate-400 mt-3 text-sm sm:text-base">Crea links directos con mensajes predeterminados y códigos QR en segundos de forma gratuita.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8" id="generar">
                <main class="lg:col-span-7 bg-slate-900/80 backdrop-blur border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    
                    <?php if ($error): ?>
                        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span><?= htmlspecialchars($error) ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="space-y-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Número de Teléfono</label>
                            <div class="flex rounded-xl overflow-hidden border border-slate-700 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500 transition bg-slate-950/60">
                                <select name="country_code" class="bg-slate-800/80 text-slate-200 px-3 py-3 border-r border-slate-700 text-xs sm:text-sm focus:outline-none">
                                    <option value="51">🇵🇪 +51 (PE)</option>
                                    <option value="52">🇲🇽 +52 (MX)</option>
                                    <option value="57">🇨🇴 +57 (CO)</option>
                                    <option value="54">🇦🇷 +54 (AR)</option>
                                    <option value="56">🇨🇱 +56 (CL)</option>
                                    <option value="34">🇪🇸 +34 (ES)</option>
                                    <option value="1">🇺🇸 +1 (US)</option>
                                </select>
                                <input type="tel" name="phone" id="phoneInput" placeholder="987654321" required
                                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                                    class="w-full bg-transparent px-4 py-3 text-slate-100 placeholder-slate-500 text-sm focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Mensaje Personalizado (Opcional)</label>
                                <span id="charCounter" class="text-[11px] text-slate-500 font-mono">0 / 160</span>
                            </div>
                            <textarea name="message" id="messageInput" rows="3" placeholder="¡Hola! Me gustaría solicitar información sobre tus servicios..."
                                class="w-full bg-slate-950/60 border border-slate-700 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition resize-none"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>

                        <!-- Vista previa en vivo -->
                        <div class="bg-slate-950/80 p-4 rounded-xl border border-slate-800">
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block mb-2">Visualización previa del chat</span>
                            <div class="flex justify-end">
                                <div class="bg-emerald-700 text-slate-100 p-3 rounded-2xl rounded-tr-none text-xs max-w-[85%] shadow-md relative">
                                    <p id="livePreview" class="break-words">¡Hola! Tu mensaje aparecerá aquí...</p>
                                    <span class="text-[9px] text-emerald-200 block text-right mt-1 opacity-70">12:00 PM <i class="fa-solid fa-check-double text-[8px] ml-0.5"></i></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-500/20 transition duration-200 flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-bolt"></i>
                            <span>Generar Enlace</span>
                        </button>
                    </form>

                    <!-- Resultado de la generación -->
                    <?php if ($generatedUrl): ?>
                        <div class="mt-8 pt-6 border-t border-slate-800 animate-fade-in space-y-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-400 flex items-center gap-2">
                                <i class="fa-solid fa-circle-check"></i> Enlace Generado Con Éxito
                            </h3>
                            
                            <div class="flex items-center gap-2">
                                <input type="text" id="generatedLink" value="<?= htmlspecialchars($generatedUrl) ?>" readonly
                                    class="w-full bg-slate-950 border border-slate-800 text-slate-300 px-3 py-2.5 rounded-lg text-xs font-mono focus:outline-none">
                                <button onclick="copyToClipboard('generatedLink', 'copyBtn')" id="copyBtn" class="bg-slate-800 hover:bg-slate-700 text-white px-4 py-2.5 rounded-lg text-xs font-medium transition flex items-center gap-1 shrink-0 border border-slate-700">
                                    <i class="fa-regular fa-copy"></i> Copiar
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center bg-slate-950/60 p-4 rounded-xl border border-slate-800">
                                <div class="sm:col-span-4 flex justify-center">
                                    <img src="<?= $qrCodeUrl ?>" alt="Código QR" class="w-28 h-28 rounded-xl bg-white p-2 shadow-inner">
                                </div>
                                <div class="sm:col-span-8 space-y-3 text-center sm:text-left">
                                    <p class="text-xs text-slate-400 leading-relaxed">
                                        <i class="fa-solid fa-circle-info text-emerald-400 mr-1"></i> Usa la cámara de tu teléfono para escanear y probar directamente en WhatsApp.
                                    </p>
                                    <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                                        <a href="<?= htmlspecialchars($generatedUrl) ?>" target="_blank" rel="noopener noreferrer" 
                                           class="bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/30 px-3 py-2 rounded-lg text-xs font-semibold transition inline-flex items-center gap-2">
                                            <i class="fa-brands fa-whatsapp"></i> Abrir en WhatsApp Web
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </main>

                <!-- Panel lateral (Historial + Guía) -->
                <aside class="lg:col-span-5 space-y-6">
                    <!-- Historial -->
                    <div class="bg-slate-900/80 backdrop-blur border border-slate-800 rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xs font-bold text-white flex items-center gap-2 uppercase tracking-wider">
                                <i class="fa-solid fa-clock-rotate-left text-slate-400"></i> Historial Reciente
                            </h2>
                            <?php if (!empty($_SESSION['history'])): ?>
                                <a href="?action=clear_history" class="text-[11px] text-slate-500 hover:text-red-400 transition flex items-center gap-1">
                                    <i class="fa-solid fa-trash"></i> Limpiar
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($_SESSION['history'])): ?>
                            <p class="text-xs text-slate-500 text-center py-6">Aún no has generado ningún enlace en esta sesión.</p>
                        <?php else: ?>
                            <div class="space-y-3">
                                <?php foreach ($_SESSION['history'] as $index => $item): ?>
                                    <div class="bg-slate-950/60 p-3 rounded-xl border border-slate-800 text-xs space-y-1.5 hover:border-slate-700 transition">
                                        <div class="flex justify-between items-center">
                                            <span class="font-bold text-emerald-400"><?= htmlspecialchars($item['phone']) ?></span>
                                            <span class="text-slate-500 text-[10px]"><?= $item['date'] ?></span>
                                        </div>
                                        <p class="text-slate-300 truncate text-[11px]"><?= htmlspecialchars($item['message']) ?></p>
                                        <div class="flex justify-between items-center pt-1 border-t border-slate-800">
                                            <input type="hidden" id="hist_<?= $index ?>" value="<?= htmlspecialchars($item['url']) ?>">
                                            <span class="text-slate-500 text-[10px] truncate max-w-[180px]"><?= htmlspecialchars($item['url']) ?></span>
                                            <div class="flex items-center gap-2">
                                                <button onclick="copyToClipboard('hist_<?= $index ?>', 'btn_hist_<?= $index ?>')" id="btn_hist_<?= $index ?>" class="text-slate-400 hover:text-white transition" title="Copiar Enlace">
                                                    <i class="fa-regular fa-copy"></i>
                                                </button>
                                                <a href="<?= htmlspecialchars($item['url']) ?>" target="_blank" class="text-slate-400 hover:text-emerald-400 transition" title="Probar Chat">
                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sección "Cómo funciona" -->
                    <div class="bg-slate-900/60 border border-slate-800 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 mb-4 text-center">¿Cómo Funciona?</h3>
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="p-2 space-y-1">
                                <div class="w-8 h-8 rounded-full bg-slate-800 text-emerald-400 flex items-center justify-center mx-auto text-xs font-bold border border-slate-700">1</div>
                                <p class="text-[11px] text-slate-300 font-semibold">Ingresa tu número</p>
                            </div>
                            <div class="p-2 space-y-1">
                                <div class="w-8 h-8 rounded-full bg-slate-800 text-emerald-400 flex items-center justify-center mx-auto text-xs font-bold border border-slate-700">2</div>
                                <p class="text-[11px] text-slate-300 font-semibold">Escribe tu mensaje</p>
                            </div>
                            <div class="p-2 space-y-1">
                                <div class="w-8 h-8 rounded-full bg-slate-800 text-emerald-400 flex items-center justify-center mx-auto text-xs font-bold border border-slate-700">3</div>
                                <p class="text-[11px] text-slate-300 font-semibold">Copia o escanea QR</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>

        <!-- DONACIONES -->
        <div id="modalDonaciones" class="hidden fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 max-w-md w-full space-y-5 shadow-2xl relative">
                <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                    <h3 class="font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-heart text-red-500 animate-pulse"></i> Apoya el Proyecto
                    </h3>
                    <button onclick="toggleModal('modalDonaciones')" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>
                
                <p class="text-xs text-slate-300 leading-relaxed text-center">
                    Si esta herramienta te sirvió para tu negocio o proyectos, puedes invitarme un café ☕ para seguir manteniéndola gratis.
                </p>

                <div class="space-y-4">
                    <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 text-center space-y-3">
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider block">Escanea para donar por Plin o Yape</span>
                        
                        <div class="bg-white p-2 rounded-xl inline-block shadow-md">
                            <img src="qr-plin.jpg" alt="QR Plin / Yape" class="w-40 h-40 object-contain">
                        </div>

                        <div class="text-xs text-slate-400 space-y-1">
                            <p class="font-semibold text-slate-200">Plin / Yape: <span class="text-emerald-400">950 595 875</span></p>
                            <p class="text-[11px] text-slate-500">A nombre de: Nayeli Paitan</p>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="https://paypal.me/NayeliPR" target="_blank" class="w-full bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-link text-amber-400"></i> Donar con PayPal / Tarjeta
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTACTO -->
        <div id="modalContacto" class="hidden fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 max-w-md w-full space-y-4">
                <div class="flex justify-between items-center border-b border-slate-800 pb-3">
                    <h3 class="font-bold text-white"><i class="fa-solid fa-envelope text-emerald-400 mr-2"></i>Contacto</h3>
                    <button onclick="toggleModal('modalContacto')" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <p class="text-xs text-slate-300">¿Tienes alguna duda o sugerencia? Escríbeme directamente:</p>
                <a href="https://wa.me/51950595875" target="_blank" class="block w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-center py-2.5 rounded-xl text-xs transition">
                    <i class="fa-brands fa-whatsapp mr-1"></i> Enviar mensaje por WhatsApp
                </a>
            </div>
        </div>

        <footer class="py-8 text-xs text-slate-500 border-t border-slate-800/80 mt-12 bg-slate-950/50">
            <div class="container mx-auto px-4 max-w-5xl flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>Generador de enlaces de WhatsApp &bull; Creado con PHP 8 & Tailwind CSS &bull; Desarrollado por 
                    <a href="https://nayelipaitan.github.io/nayeli-paitan/" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-emerald-400 underline transition font-medium">
                        Nayeli Paitan
                    </a> 👨🏻‍💻☕
                </p>
                
                <div class="flex items-center gap-4 text-slate-400 text-lg">
                    <a href="https://www.linkedin.com/in/nayeli-alison-paitan-ramirez/" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="LinkedIn">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/nayelipaitan" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="GitHub">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/blakedev.np/" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@blakedev.np" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition" title="TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <script src="script.js"></script>
</body>
</html>