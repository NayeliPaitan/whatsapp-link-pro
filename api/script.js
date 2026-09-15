// Función para copiar texto al portapapeles con ID dinámico y feedback visual
function copyToClipboard(inputId, buttonId) {
    const copyText = document.getElementById(inputId);
    if (!copyText) return;

    // Copiar usando la Clipboard API
    navigator.clipboard.writeText(copyText.value).then(() => {
        const btn = document.getElementById(buttonId);
        if (btn) {
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check text-emerald-400"></i> Copiado';
            btn.classList.add('bg-slate-600');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-slate-600');
            }, 2000);
        }
    }).catch(err => {
        console.error('Error al copiar: ', err);
    });
}

// Control de apertura / cierre de modales
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.toggle('hidden');
    }
}

// Vista previa en vivo del mensaje de WhatsApp + Contador de Caracteres
document.addEventListener('DOMContentLoaded', () => {
    const messageInput = document.getElementById('messageInput');
    const livePreview = document.getElementById('livePreview');
    const charCounter = document.getElementById('charCounter');

    if (messageInput && livePreview) {
        const updatePreview = () => {
            const text = messageInput.value.trim();
            const length = messageInput.value.length;

            if (text === '') {
                livePreview.textContent = '¡Hola! Tu mensaje aparecerá aquí...';
                livePreview.classList.add('opacity-50');
            } else {
                livePreview.textContent = text;
                livePreview.classList.remove('opacity-50');
            }

            if (charCounter) {
                charCounter.textContent = `${length} / 160`;
                if (length > 160) {
                    charCounter.classList.add('text-amber-400');
                } else {
                    charCounter.classList.remove('text-amber-400');
                }
            }
        };

        // Ejecutar al escribir y al cargar
        messageInput.addEventListener('input', updatePreview);
        updatePreview();
    }
});