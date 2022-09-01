@extends('FrontEnd.layouts.master_one')
@section('content')
<style>
    .grid-item { width: 250px; }
.grid-item--width2 { width: 400px; }
</style>
<!-- main section -->
<main>
    <!-- header-section -->
    <section id="header">
        <div class="container">
            <div class="header-text text-center" style="padding: 10px;">
                <h3>
                    Welcome to the {{ config('company.company_name') }} {{ $state->name }} alternative, {{ config('company.company_name') }} {{ $state->name }}
                    classifieds section.
                </h3>
                <p>
                    Your search for the {{ config('company.company_name') }} {{ $state->name }} classified website ends here
                    at {{ config('company.company_name') }} {{ $state->name }} website. To start exploring the new {{ $state->name }}
                    {{ config('company.company_name') }} classified section, select a category from below and find
                    real {{ config('company.company_name') }} {{ $state->name }} calssified advertisements posted by the
                    users of {{ $state->name }} {{ config('company.company_name') }} classifed website.
                </p>
            </div>
        </div>
    </section>

    <!-- advertise category -->
    <section class="advertise-category my-5">
        <div class="container">
            <div class="grid row">
                @foreach ($Categorys as $category)
                <div class="grid-item col-lg-3" style="margin-bottom:10px;">
                    <div class="category-box">
                        <div class="category-name">
                            <h4>{{ $category->title }}</h4>
                        </div>
                        <div class="category-city-box">
                            <div class="row">
                                <div class="category-state-name">
                                    <ul class="subcategory_list">
                                        @foreach($category->SubCategoryList as $subcategory)
                                        <li><a
                                                href="{{ route('AdCollection', $subcategory->id) }}">{{ $subcategory->title }}</a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- did you know section-->
    @include('FrontEnd.AdCategory.content')
</main>
@endsection
