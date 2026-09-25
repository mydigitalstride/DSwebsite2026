/**
 * Proposal & RFP/RFQ templates — library filters, live fill-in fields,
 * print / Word / copy. See inc/proposal-templates.php.
 */
(function () {
    'use strict';

    var STORE_FIELDS = 'ds_pt_fields';   // shared across templates
    var STORE_CHECKS = 'ds_pt_checks_';  // + slug

    function load(key, fallback) {
        try { return JSON.parse(localStorage.getItem(key)) || fallback; } catch (e) { return fallback; }
    }
    function save(key, value) {
        try { localStorage.setItem(key, JSON.stringify(value)); } catch (e) {}
    }

    // ── Library filters ─────────────────────────────
    document.querySelectorAll('[data-pt-library]').forEach(function (lib) {
        var buttons = lib.querySelectorAll('[data-pt-filter]');
        var cards   = lib.querySelectorAll('.ds-pt-card');
        var empty   = lib.querySelector('.ds-pt-library__empty');

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var want = btn.getAttribute('data-pt-filter');
                var shown = 0;
                buttons.forEach(function (b) {
                    var on = b === btn;
                    b.classList.toggle('is-active', on);
                    b.setAttribute('aria-pressed', on ? 'true' : 'false');
                });
                cards.forEach(function (card) {
                    var match = !want || card.getAttribute('data-industry') === want;
                    card.hidden = !match;
                    if (match) shown++;
                });
                if (empty) empty.hidden = shown > 0;
            });
        });
    });

    // ── Single template ─────────────────────────────
    var root = document.querySelector('[data-pt]');
    if (!root) return;

    var slug   = root.getAttribute('data-pt-slug');
    var doc    = root.querySelector('[data-pt-doc]');
    var status = root.querySelector('[data-pt-status]');
    var inputs = root.querySelectorAll('[data-pt-field]');
    var values = load(STORE_FIELDS, {});

    function say(msg) {
        if (!status) return;
        status.textContent = msg;
        clearTimeout(say.t);
        say.t = setTimeout(function () { status.textContent = ''; }, 4000);
    }

    function applyField(key) {
        var v = (values[key] || '').trim();
        doc.querySelectorAll('.ds-pt__token[data-token="' + key + '"]').forEach(function (el) {
            el.textContent = v || el.getAttribute('data-label');
            el.classList.toggle('is-filled', !!v);
        });
    }

    inputs.forEach(function (input) {
        var key = input.getAttribute('data-pt-field');
        if (values[key]) input.value = values[key];
        applyField(key);
        input.addEventListener('input', function () {
            values[key] = input.value;
            save(STORE_FIELDS, values);
            applyField(key);
        });
    });

    // Keep the long details form out of the way on phones until asked for.
    var fieldsPanel = root.querySelector('[data-pt-fields]');
    if (fieldsPanel && window.innerWidth <= 1024) fieldsPanel.open = false;

    // Writing tips on/off (on screen only — never exported).
    var tips = root.querySelector('[data-pt-tips]');
    if (tips) {
        tips.addEventListener('change', function () {
            root.classList.toggle('is-tips-hidden', !tips.checked);
        });
    }

    // Checklist progress persists per template.
    var checks = load(STORE_CHECKS + slug, {});
    root.querySelectorAll('[data-pt-check]').forEach(function (box) {
        var i = box.getAttribute('data-pt-check');
        box.checked = !!checks[i];
        box.addEventListener('change', function () {
            checks[i] = box.checked;
            save(STORE_CHECKS + slug, checks);
        });
    });

    /**
     * A clean copy of the document for export: no tips, tokens replaced by
     * their text, hand-fill brackets highlighted with inline styles that
     * survive in Word and Google Docs.
     */
    function exportHTML() {
        var clone = doc.cloneNode(true);
        clone.querySelectorAll('[data-pt-tip]').forEach(function (el) { el.remove(); });
        clone.querySelectorAll('.ds-pt__token').forEach(function (el) {
            var filled = el.classList.contains('is-filled');
            var span = document.createElement('span');
            span.textContent = filled ? el.textContent : '[' + el.textContent + ']';
            if (!filled) span.setAttribute('style', 'background:#fff200;');
            el.replaceWith(span);
        });
        clone.querySelectorAll('mark.ds-pt__fill').forEach(function (el) {
            var span = document.createElement('span');
            span.textContent = el.textContent;
            span.setAttribute('style', 'background:#fff200;');
            el.replaceWith(span);
        });
        clone.querySelectorAll('.ds-pt__table').forEach(function (wrap) { wrap.replaceWith(wrap.firstElementChild); });
        clone.querySelectorAll('table').forEach(function (t) {
            t.setAttribute('border', '1');
            t.setAttribute('cellpadding', '6');
            t.setAttribute('style', 'border-collapse:collapse;width:100%;');
        });
        clone.querySelectorAll('[class], [id], [data-pt-doc], [aria-label]').forEach(function (el) {
            el.removeAttribute('class');
            el.removeAttribute('id');
            el.removeAttribute('data-pt-doc');
            el.removeAttribute('aria-label');
        });
        var title = document.querySelector('.ds-pt-hero__title');
        return '<h1>' + (title ? title.textContent.trim() : '') + '</h1>' + clone.innerHTML;
    }

    function download(filename, content, type) {
        var blob = new Blob([content], { type: type });
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        setTimeout(function () { URL.revokeObjectURL(a.href); a.remove(); }, 0);
    }

    var actions = {
        print: function () { window.print(); },

        // Word opens HTML saved with a .doc extension and keeps headings,
        // lists, tables and highlights. Users can "Save as .docx" from Word.
        word: function () {
            var html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">' +
                '<head><meta charset="utf-8"><title>' + slug + '</title>' +
                '<style>body{font-family:Calibri,Arial,sans-serif;font-size:11pt;line-height:1.4;}' +
                'h1{font-size:20pt;}h2{font-size:14pt;margin-top:18pt;border-bottom:1px solid #999;}h4{font-size:11pt;}' +
                'td,th{border:1px solid #999;padding:4pt;vertical-align:top;}th{background:#eee;}</style></head>' +
                '<body>' + exportHTML() + '</body></html>';
            download(slug + '.doc', '﻿' + html, 'application/msword');
            say('Downloaded ' + slug + '.doc — open it in Word or Google Docs.');
        },

        // Rich copy keeps headings and tables when pasted into Google Docs / Word.
        copy: function () {
            var html = exportHTML();
            var tmp = document.createElement('div');
            tmp.innerHTML = html;
            var text = tmp.innerText || tmp.textContent;

            if (navigator.clipboard && window.ClipboardItem) {
                navigator.clipboard.write([new ClipboardItem({
                    'text/html': new Blob([html], { type: 'text/html' }),
                    'text/plain': new Blob([text], { type: 'text/plain' })
                })]).then(function () { say('Copied — paste into a blank Google Doc or Word file.'); },
                          function () { fallbackCopy(tmp); });
            } else {
                fallbackCopy(tmp);
            }
        },

        clear: function () {
            inputs.forEach(function (input) {
                input.value = '';
                delete values[input.getAttribute('data-pt-field')];
                applyField(input.getAttribute('data-pt-field'));
            });
            save(STORE_FIELDS, values);
            say('Your details were cleared.');
        }
    };

    function fallbackCopy(node) {
        node.style.position = 'fixed';
        node.style.left = '-9999px';
        document.body.appendChild(node);
        var range = document.createRange();
        range.selectNodeContents(node);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
        var ok = false;
        try { ok = document.execCommand('copy'); } catch (e) {}
        sel.removeAllRanges();
        node.remove();
        say(ok ? 'Copied — paste into a blank Google Doc or Word file.' : 'Copy failed — use Download for Word instead.');
    }

    root.querySelectorAll('[data-pt-action]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var fn = actions[btn.getAttribute('data-pt-action')];
            if (fn) fn();
            if (window.dataLayer) {
                window.dataLayer.push({ event: 'proposal_template_' + btn.getAttribute('data-pt-action'), template: slug });
            }
        });
    });
})();
