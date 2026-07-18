@php $car = $car ?? null; @endphp
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm text-gray-600">Brand</label>
        <select name="brand_id" required class="w-full rounded-lg border-gray-300 text-sm">
            <option value="">-- Pilih Brand --</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(old('brand_id', $car?->brand_id) == $brand->id)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm text-gray-600">Kategori</label>
        <select name="category_id" required class="w-full rounded-lg border-gray-300 text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $car?->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="text-sm text-gray-600">Nama Mobil</label>
        <input type="text" name="name" required value="{{ old('name', $car?->name) }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="text-sm text-gray-600">Model/Varian</label>
        <input type="text" name="model" value="{{ old('model', $car?->model) }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
</div>

<div class="grid grid-cols-3 gap-4">
    <div>
        <label class="text-sm text-gray-600">Tahun</label>
        <input type="number" name="year" required value="{{ old('year', $car?->year) }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="text-sm text-gray-600">Harga (Rp)</label>
        <input type="number" name="price" required value="{{ old('price', $car?->price) }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="text-sm text-gray-600">Kilometer</label>
        <input type="number" name="mileage" required value="{{ old('mileage', $car?->mileage ?? 0) }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
</div>

<div class="grid grid-cols-3 gap-4">
    <div>
        <label class="text-sm text-gray-600">Transmisi</label>
        <select name="transmission" required class="w-full rounded-lg border-gray-300 text-sm">
            <option value="manual" @selected(old('transmission', $car?->transmission) === 'manual')>Manual</option>
            <option value="automatic" @selected(old('transmission', $car?->transmission) === 'automatic')>Automatic</option>
        </select>
    </div>
    <div>
        <label class="text-sm text-gray-600">Bahan Bakar</label>
        <input type="text" name="fuel_type" required value="{{ old('fuel_type', $car?->fuel_type ?? 'bensin') }}" class="w-full rounded-lg border-gray-300 text-sm">
    </div>
    <div>
        <label class="text-sm text-gray-600">Status</label>
        <select name="status" required class="w-full rounded-lg border-gray-300 text-sm">
            <option value="available" @selected(old('status', $car?->status) === 'available')>Tersedia</option>
            <option value="sold" @selected(old('status', $car?->status) === 'sold')>Terjual</option>
        </select>
    </div>
</div>

<div>
    <label class="text-sm text-gray-600">Deskripsi</label>
    <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 text-sm">{{ old('description', $car?->description) }}</textarea>
</div>

<div class="flex items-center gap-2">
    <input type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $car?->is_featured))>
    <label for="is_featured" class="text-sm text-gray-600">Tampilkan sebagai mobil unggulan di Beranda</label>
</div>

<div>
    <label class="text-sm text-gray-600">Upload Foto (bisa lebih dari satu)</label>
    <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm">
    <p class="text-xs text-gray-400 mt-1">Format jpg/jpeg/png/webp, maksimal 2MB per foto.</p>
</div>
