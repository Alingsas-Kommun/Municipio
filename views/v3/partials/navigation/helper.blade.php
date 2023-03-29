@if (!empty($breadcrumbItems) || !empty($accessibilityItems))
    <div class="nav-helper @if (isset($classList)) {{ implode(' ', $classList) }} {{ ' o-container' }} @endif">
        @includeIf('partials.navigation.breadcrumb')
        @includeIf('partials.navigation.accessibility')
    </div>
@endif
