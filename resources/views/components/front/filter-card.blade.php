@props(['continents', 'countries', 'request', 'sortOptions'])

<div class="filter-card">
    <div class="filter-container">
        <div class="filters">
            <div class="filter">
                <label class="filter-label" for="filter">Šalys:</label>
                <select name="filter" id="filter"
                class="filter-select">
                    <option value="all" selected>Visos</option>
                    @foreach ($continents as $continent)
                        <optgroup label="{{ $continent->continent }}">
                            @foreach ($countries as $country)
                            @if ($country->continent === $continent->continent)
                            <option value="{{ $country->id }}" @if ($request->filter && $request->filter == $country->id) selected  @endif>{{ $country->name }}</option>
                            @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        
            <div class="filter">
                <label class="filter-label" for="sort">Rikiavimas:</label>
                <select name="sort" id="sort"
                class="filter-select pr-8">
                    @foreach ($sortOptions as $key => $value)
                        <option value="{{ $key }}" @if ($request->sort && $request->sort == $key) selected  @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="filter-search">
            <input name="s" id="search" class="filter-search-input" placeholder="Ieškoti vietovės...">
        </div>            
    </div>                
</div>