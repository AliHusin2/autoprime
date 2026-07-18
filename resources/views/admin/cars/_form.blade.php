@php $car = $car ?? null; @endphp

<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;">

    {{-- ── LEFT: Main Fields ── --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Identity --}}
        <div class="adm-card" style="padding:24px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f5f5f7;">Identitas Kendaraan</div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div>
                    <label class="adm-label">Brand</label>
                    <select name="brand_id" required class="adm-input adm-select">
                        <option value="">Pilih Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @selected(old('brand_id', $car?->brand_id) == $brand->id)>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="adm-label">Kategori</label>
                    <select name="category_id" required class="adm-input adm-select">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $car?->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="adm-label">Nama Mobil</label>
                    <input type="text" name="name" required value="{{ old('name', $car?->name) }}" class="adm-input" placeholder="cth. Toyota">
                </div>
                <div>
                    <label class="adm-label">Model / Varian</label>
                    <input type="text" name="model" value="{{ old('model', $car?->model) }}" class="adm-input" placeholder="cth. GR Sport 4x4">
                </div>
            </div>
        </div>

        {{-- Specs --}}
        <div class="adm-card" style="padding:24px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f5f5f7;">Spesifikasi</div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
                <div>
                    <label class="adm-label">Tahun</label>
                    <input type="number" name="year" required value="{{ old('year', $car?->year ?? date('Y')) }}" class="adm-input" min="1990" max="{{ date('Y') + 1 }}" placeholder="{{ date('Y') }}">
                </div>
                <div>
                    <label class="adm-label">Harga (Rp)</label>
                    <input type="number" name="price" required value="{{ old('price', $car?->price) }}" class="adm-input" placeholder="500000000">
                </div>
                <div>
                    <label class="adm-label">Kilometer</label>
                    <input type="number" name="mileage" required value="{{ old('mileage', $car?->mileage ?? 0) }}" class="adm-input" placeholder="0">
                </div>
                <div>
                    <label class="adm-label">Transmisi</label>
                    <select name="transmission" required class="adm-input adm-select">
                        <option value="manual" @selected(old('transmission', $car?->transmission) === 'manual')>Manual</option>
                        <option value="automatic" @selected(old('transmission', $car?->transmission) === 'automatic')>Automatic</option>
                    </select>
                </div>
                <div>
                    <label class="adm-label">Bahan Bakar</label>
                    <input type="text" name="fuel_type" required value="{{ old('fuel_type', $car?->fuel_type ?? 'bensin') }}" class="adm-input" placeholder="bensin / diesel / listrik">
                </div>
                <div>
                    <label class="adm-label">Status</label>
                    <select name="status" required class="adm-input adm-select">
                        <option value="available" @selected(old('status', $car?->status ?? 'available') === 'available')>Tersedia</option>
                        <option value="sold" @selected(old('status', $car?->status) === 'sold')>Terjual</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="adm-card" style="padding:24px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:18px;padding-bottom:12px;border-bottom:1px solid #f5f5f7;">Deskripsi</div>
            <textarea name="description" rows="4" class="adm-input adm-textarea" placeholder="Tuliskan deskripsi singkat kondisi, fitur unggulan, atau catatan penting tentang kendaraan ini...">{{ old('description', $car?->description) }}</textarea>
        </div>

    </div>

    {{-- ── RIGHT: Sidebar ── --}}
    <div style="display:flex;flex-direction:column;gap:20px;position:sticky;top:80px;">

        {{-- Featured toggle --}}
        <div class="adm-card" style="padding:20px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:14px;">Tampilan Beranda</div>
            <label style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div x-data="{ on: {{ old('is_featured', $car?->is_featured ?? false) ? 'true' : 'false' }} }"
                     @click="on = !on"
                     style="position:relative;width:44px;height:24px;border-radius:12px;transition:background 0.2s;cursor:pointer;"
                     :style="on ? 'background:#f59e0b' : 'background:#d2d2d7'">
                    <input type="checkbox" name="is_featured" value="1" :checked="on" style="display:none;">
                    <div style="position:absolute;top:2px;width:20px;height:20px;border-radius:50%;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.2);transition:left 0.2s;"
                         :style="on ? 'left:22px' : 'left:2px'"></div>
                </div>
                <div>
                    <div style="font-size:13px;font-weight:600;color:#1d1d1f;">Mobil Unggulan</div>
                    <div style="font-size:11px;color:#6e6e73;">Tampilkan di halaman Beranda</div>
                </div>
            </label>
        </div>

        {{-- Photo upload --}}
        <div class="adm-card" style="padding:20px;">
            <div style="font-size:13px;font-weight:700;color:#1d1d1f;margin-bottom:14px;">Upload Foto</div>

            <div class="upload-zone" id="upload-zone" onclick="document.getElementById('img-input').click()">
                <input type="file" id="img-input" name="images[]" multiple accept="image/jpeg,image/png,image/webp" onchange="previewImages(this)">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#b0b0b8" stroke-width="1.5" style="margin:0 auto 10px;display:block;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <div style="font-size:13px;font-weight:600;color:#6e6e73;">Klik untuk pilih foto</div>
                <div style="font-size:11px;color:#b0b0b8;margin-top:4px;">JPG, PNG, WebP — maks 2 MB per file</div>
            </div>

            <div class="img-preview-grid" id="img-preview"></div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="adm-btn adm-btn-primary" style="height:44px;font-size:14px;width:100%;justify-content:center;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
            Simpan Kendaraan
        </button>

    </div>
</div>

<script>
function previewImages(input) {
    const preview = document.getElementById('img-preview');
    preview.innerHTML = '';
    Array.from(input.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const wrap = document.createElement('div');
            wrap.className = 'img-preview-item';
            wrap.innerHTML = `<img src="${e.target.result}" alt="preview"><button type="button" class="img-preview-del" onclick="this.parentElement.remove()">×</button>`;
            preview.appendChild(wrap);
        };
        reader.readAsDataURL(file);
    });
}

// Drag-drop
const zone = document.getElementById('upload-zone');
if (zone) {
    zone.addEventListener('dragover', e => { e.preventDefault(); zone.style.borderColor = '#f59e0b'; zone.style.background = 'rgba(245,158,11,0.05)'; });
    zone.addEventListener('dragleave', () => { zone.style.borderColor = '#d2d2d7'; zone.style.background = ''; });
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.style.borderColor = '#d2d2d7'; zone.style.background = '';
        const input = document.getElementById('img-input');
        input.files = e.dataTransfer.files;
        previewImages(input);
    });
}
</script>
