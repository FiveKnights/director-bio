@extends('layouts.app')

@section('content')
    @include('portfolio.partials.background')
    @include('portfolio.partials.header')

    <!-- MAIN CONTAINER -->
    <main class="relative z-10 max-w-7xl w-full mx-auto my-auto py-2">

        {{-- AUTH GATE (fake, client-side login sequence) --}}
        @include('portfolio.partials.login')

        {{-- PROTECTED PAGES (toggled by Alpine's isAuthenticated flag) --}}
        <div x-show="isAuthenticated">
            @include('portfolio.pages.overview')
            @include('portfolio.pages.profile')
            @include('portfolio.pages.skills')
            @include('portfolio.pages.projects')
            @include('portfolio.pages.contact')
        </div>

    </main>

    @include('portfolio.partials.project-modal')
    @include('portfolio.partials.footer')
@endsection

@push('scripts')
    <script>
        window.PORTFOLIO_DATA = @json($portfolio);
    </script>
    {{-- Must be a non-deferred script so portfolioTerminal() exists before Alpine boots --}}

@endpush
