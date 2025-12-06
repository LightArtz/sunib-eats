<form method="GET" action="{{ url()->current() }}">
    <div class="input-group input-group-sm">
        <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-filter text-muted"></i>
        </span>
        <select name="sort" class="form-select form-select-sm border-start-0 ps-0 shadow-none"
            onchange="this.form.submit()"
            style="cursor: pointer;">
            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
        </select>
    </div>
</form>