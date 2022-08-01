@extends('layouts.frontend')

@section('content')

<div class="default-header-content">

    <div class="container"><h1>{{ $page->title }}</h1></div>

</div>
<div class="default-content">
    <div class="container">
        <div class="content">
			<div class="catmaincol">
                {!! $page->content !!}
            </div>
            <div class="catsidebar">
                <!-- TBD !! -->
                <ul class="category-browser"><li class="cat-item cat-item-30 first"><a href="/category/partners/" title="Partners">Partners</a></li><ul class="children">
                    <li class="cat-item cat-item-36"><a href="/category/partners/partner-organisations/" title="Partner Organisations">Partner Organisations</a></li>
                    <li class="cat-item cat-item-49"><a href="/category/partners/arts-thread-partnerships/" title="Partnerships">Partnerships</a></li>
                    </ul>

                    <li class="cat-item cat-item-31"><a href="/category/practical/" title="Practical">Practical</a></li><ul class="children">
                    <li class="cat-item cat-item-39"><a href="/category/practical/opportunities/" title="Opportunities">Opportunities</a></li>
                    <li class="cat-item cat-item-3"><a href="/category/practical/practical-guides/" title="Practical Guides">Practical Guides</a></li>	<ul class="children">
                    <li class="cat-item cat-item-40"><a href="/category/practical/practical-guides/business-start-up/" title="Business Start Up">Business Start Up</a></li>
                    <li class="cat-item cat-item-41"><a href="/category/practical/practical-guides/career-advice/" title="Career Advice">Career Advice</a></li>
                    <li class="cat-item cat-item-232"><a href="/category/practical/practical-guides/creative-careers/" title="Creative Careers">Creative Careers</a></li>
                    <li class="cat-item cat-item-42"><a href="/category/practical/practical-guides/design-keywords/" title="Design Keywords">Design Keywords</a></li>
                    <li class="cat-item cat-item-44"><a href="/category/practical/practical-guides/graduation-tips/" title="Graduation Tips">Graduation Tips</a></li>
                    <li class="cat-item cat-item-55"><a href="/category/practical/practical-guides/online-portfolios-and-promotion/" title="Online Promotion">Online Promotion</a></li>
                    <li class="cat-item cat-item-60"><a href="/category/practical/practical-guides/pre-university-tips/" title="Pre-University Tips">Pre-University Tips</a></li>
                    <li class="cat-item cat-item-246"><a href="/category/practical/practical-guides/university-survival-tips/" title="University Survival Tips">University Survival Tips</a></li>
                        </ul>

                    </ul>

                    </ul><a href="/?artsthreadfeature=49" target="_blank"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/features/81c3c31caf28a9c7dedfa248c35c6371.jpg" alt="Wix Website Builder" title="Wix Website Builder" style="width:100%; height:auto;"></a>

            </div>
        </div>
    </div>
    <div class="clear">&nbsp;</div>
    <div class="clear" style="margin-top:50px;display:block;">&nbsp;</div>
</div>

@endsection
