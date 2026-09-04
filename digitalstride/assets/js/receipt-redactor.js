/**
 * Receipt redaction editor for the Team Reimbursements portal.
 *
 * Privacy model: the chosen photo is decoded straight into a canvas in the
 * browser and is NEVER uploaded. The employee drags black boxes over
 * sensitive areas; "Add redacted receipt" flattens image + boxes into a new
 * JPEG (destroying the covered pixels) and only those flattened blobs are
 * sent with the claim. Re-encoding through canvas also drops all photo
 * metadata (EXIF / GPS).
 */
(function () {
    'use strict';

    var form = document.getElementById('ds-reimb-form');
    if (!form || typeof dsReimb === 'undefined') return;

    var fileInput = document.getElementById('ds-reimb-file');
    var dropzone  = document.getElementById('ds-reimb-dropzone');
    var chooseBtn = document.getElementById('ds-reimb-choose');
    var editor    = document.getElementById('ds-reimb-editor');
    var canvas    = document.getElementById('ds-reimb-canvas');
    var ctx       = canvas.getContext('2d');
    var pendingEl = document.getElementById('ds-reimb-pending');
    var msgEl     = document.getElementById('ds-reimb-msg');
    var submitBtn = document.getElementById('ds-reimb-submit');

    var MAX_EDGE = 2000; // cap the working resolution; receipts stay readable

    var image = null;   // current bitmap being redacted (never uploaded)
    var rects = [];     // committed redaction boxes, in canvas pixels
    var drag  = null;   // in-progress box
    var pending = [];   // [{blob, thumb}] redacted receipts awaiting submit

    // ── Loading a photo (stays on-device) ──────────────

    chooseBtn.addEventListener('click', function () { fileInput.click(); });

    dropzone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropzone.classList.add('is-drag');
    });
    dropzone.addEventListener('dragleave', function () {
        dropzone.classList.remove('is-drag');
    });
    dropzone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropzone.classList.remove('is-drag');
        if (e.dataTransfer.files && e.dataTransfer.files[0]) loadFile(e.dataTransfer.files[0]);
    });
    fileInput.addEventListener('change', function () {
        if (fileInput.files && fileInput.files[0]) loadFile(fileInput.files[0]);
    });

    function loadFile(file) {
        setMsg('');
        if (pending.length >= dsReimb.maxFiles) {
            setMsg('You can attach up to ' + dsReimb.maxFiles + ' receipts per claim.', true);
            return;
        }
        if (!/^image\//.test(file.type)) {
            setMsg('Please choose a photo (JPG, PNG, or WebP).', true);
            return;
        }

        // createImageBitmap honours EXIF orientation; fall back to <img> decode.
        var decoded;
        if (window.createImageBitmap) {
            decoded = createImageBitmap(file, { imageOrientation: 'from-image' })
                .catch(function () { return createImageBitmap(file); });
        } else {
            decoded = Promise.reject();
        }
        decoded.catch(function () {
            return new Promise(function (resolve, reject) {
                var url = URL.createObjectURL(file);
                var img = new Image();
                img.onload = function () { URL.revokeObjectURL(url); resolve(img); };
                img.onerror = function () { URL.revokeObjectURL(url); reject(); };
                img.src = url;
            });
        }).then(startEditing, function () {
            setMsg('That image could not be opened. Please try a different photo.', true);
        });
    }

    function startEditing(bmp) {
        var w = bmp.width, h = bmp.height;
        var scale = Math.min(1, MAX_EDGE / Math.max(w, h));

        canvas.width  = Math.round(w * scale);
        canvas.height = Math.round(h * scale);

        image = bmp;
        rects = [];
        drag  = null;

        editor.hidden = true; // ensure layout is settled before showing
        redraw();
        editor.hidden = false;
        editor.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function redraw(preview) {
        if (!image) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#000';
        rects.forEach(function (r) { ctx.fillRect(r.x, r.y, r.w, r.h); });
        if (preview) {
            ctx.fillStyle = 'rgba(0,0,0,0.75)';
            ctx.fillRect(preview.x, preview.y, preview.w, preview.h);
            ctx.strokeStyle = '#F36E21';
            ctx.lineWidth = Math.max(2, canvas.width / 500);
            ctx.strokeRect(preview.x, preview.y, preview.w, preview.h);
        }
    }

    // ── Drawing redaction boxes ────────────────────────

    function canvasPoint(e) {
        var box = canvas.getBoundingClientRect();
        return {
            x: (e.clientX - box.left) * (canvas.width / box.width),
            y: (e.clientY - box.top) * (canvas.height / box.height)
        };
    }

    function normRect(a, b) {
        return {
            x: Math.min(a.x, b.x),
            y: Math.min(a.y, b.y),
            w: Math.abs(a.x - b.x),
            h: Math.abs(a.y - b.y)
        };
    }

    canvas.addEventListener('pointerdown', function (e) {
        if (!image) return;
        e.preventDefault();
        canvas.setPointerCapture(e.pointerId);
        drag = { start: canvasPoint(e), end: canvasPoint(e) };
    });
    canvas.addEventListener('pointermove', function (e) {
        if (!drag) return;
        e.preventDefault();
        drag.end = canvasPoint(e);
        redraw(normRect(drag.start, drag.end));
    });
    canvas.addEventListener('pointerup', function (e) {
        if (!drag) return;
        var r = normRect(drag.start, canvasPoint(e));
        drag = null;
        // Ignore accidental taps; anything intentional becomes a solid box.
        if (r.w > 4 && r.h > 4) rects.push(r);
        redraw();
    });
    canvas.addEventListener('pointercancel', function () {
        drag = null;
        redraw();
    });

    document.getElementById('ds-reimb-undo').addEventListener('click', function () {
        rects.pop();
        redraw();
    });
    document.getElementById('ds-reimb-clear').addEventListener('click', function () {
        rects = [];
        redraw();
    });
    document.getElementById('ds-reimb-cancel').addEventListener('click', closeEditor);

    function closeEditor() {
        image = null;
        rects = [];
        drag = null;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        editor.hidden = true;
        fileInput.value = '';
    }

    // ── Flatten & queue the redacted copy ──────────────

    document.getElementById('ds-reimb-add').addEventListener('click', function () {
        if (!image) return;
        if (!rects.length && !window.confirm('You have not drawn any redaction boxes. Add this receipt as-is?')) {
            return;
        }
        redraw(); // final state: image + solid boxes, no preview outline

        var thumb = makeThumb();
        canvas.toBlob(function (blob) {
            if (!blob) {
                setMsg('Could not process the image. Please try again.', true);
                return;
            }
            if (blob.size > dsReimb.maxBytes) {
                setMsg('That image is too large even after processing. Please try a smaller photo.', true);
                return;
            }
            pending.push({ blob: blob, thumb: thumb });
            renderPending();
            closeEditor();
            setMsg('Redacted receipt added. The original photo was not uploaded.');
        }, 'image/jpeg', 0.92);
    });

    function makeThumb() {
        var t = document.createElement('canvas');
        var scale = 96 / Math.max(canvas.width, canvas.height);
        t.width  = Math.max(1, Math.round(canvas.width * scale));
        t.height = Math.max(1, Math.round(canvas.height * scale));
        t.getContext('2d').drawImage(canvas, 0, 0, t.width, t.height);
        return t.toDataURL('image/jpeg', 0.7);
    }

    function renderPending() {
        pendingEl.innerHTML = '';
        pending.forEach(function (item, i) {
            var li = document.createElement('li');
            li.className = 'ds-reimb__pending-item';

            var img = document.createElement('img');
            img.src = item.thumb;
            img.alt = 'Redacted receipt ' + (i + 1);

            var label = document.createElement('span');
            label.textContent = 'Redacted receipt ' + (i + 1) + ' (' + Math.round(item.blob.size / 1024) + ' KB)';

            var rm = document.createElement('button');
            rm.type = 'button';
            rm.className = 'ds-reimb__pending-remove';
            rm.textContent = 'Remove';
            rm.addEventListener('click', function () {
                pending.splice(i, 1);
                renderPending();
            });

            li.appendChild(img);
            li.appendChild(label);
            li.appendChild(rm);
            pendingEl.appendChild(li);
        });
    }

    // ── Submit ─────────────────────────────────────────

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        setMsg('');

        if (image) {
            setMsg('You have a photo open in the editor — add it as a redacted receipt or discard it first.', true);
            return;
        }
        if (!pending.length) {
            setMsg('Please add at least one redacted receipt.', true);
            return;
        }

        var date     = document.getElementById('ds-reimb-date').value;
        var amount   = document.getElementById('ds-reimb-amount').value.trim();
        var category = document.getElementById('ds-reimb-category').value;
        if (!date || !amount || !category) {
            setMsg('Please fill in the expense date, amount, and category.', true);
            return;
        }

        var data = new FormData();
        data.append('action', 'ds_reimb_submit');
        data.append('nonce', dsReimb.nonce);
        data.append('expense_date', date);
        data.append('amount', amount);
        data.append('category', category);
        data.append('note', document.getElementById('ds-reimb-note').value);
        pending.forEach(function (item, i) {
            data.append('receipts[]', item.blob, 'receipt-' + (i + 1) + '.jpg');
        });

        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting…';

        fetch(dsReimb.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
            .then(function (res) { return res.json(); })
            .then(function (res) {
                if (!res || !res.success) {
                    throw new Error((res && res.data && res.data.message) || 'Something went wrong. Please try again.');
                }
                pending = [];
                renderPending();
                form.reset();
                setMsg(res.data.message);
                // Refresh so the new claim shows in "Your claims" with its
                // secure receipt links.
                setTimeout(function () { window.location.reload(); }, 2500);
            })
            .catch(function (err) {
                setMsg(err.message || 'Something went wrong. Please try again.', true);
            })
            .finally(function () {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit claim';
            });
    });

    function setMsg(text, isError) {
        msgEl.textContent = text;
        msgEl.classList.toggle('is-error', !!isError);
    }
})();
