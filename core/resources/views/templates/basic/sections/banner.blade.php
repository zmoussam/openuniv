@php
    $banner = getContent('banner.content', true);
    $bannerIcon = getContent('banner_icon.content', true);
@endphp
<section>
    {{-- <div class="banner-section-bg-img">
        <img src="{{ asset($activeTemplateTrue . 'images/banner-bg.png') }}" alt="">
    </div> --}}
    {{-- <div class="banner-ac-imgs animated"> 
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->one, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->two, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->three, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->four, '35x35') }}"" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->five, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->six, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->seven, '35x35') }}" alt=""></span>
        <span class="ac-img animated"><img src="{{ getImage('assets/images/frontend/banner_icon/' . @$bannerIcon->data_values->eight, '35x35') }}" alt=""></span>
    </div> --}}
    <div class="page-wrapper">
      <main class="main-wrapper">
        <header class="section_paidhome-header">
          <div class="padding-global">
            <div class="container-large">
              <div class="paidhome-header_component">
               <div class="padding-section-small"> 
                <div class="banner-content text-center">
                    <h1 class="banner-content__title">{{ __(@$banner->data_values->heading) }}</h1>
                    <p class="banner-content__desc" style="color: rgb(61, 61, 61)">{{ __(@$banner->data_values->description) }}</p>
                    <ul class="banner-category-list">
                        @foreach($categories->take(7) as $category)
                            <li class="item">
                                <a href="{{ route('category.products', ['slug'=>slug($category->name), 'id'=>$category->id]) }}" class="link">{{ __($category->name) }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="banner-content__buttons flex-center">    
                        <a href="{{ @$banner->data_values->first_button_url }}" class="btn btn--base">
                            {{ __(@$banner->data_values->first_button_name) }}
                        </a>
                        <a href="{{ @$banner->data_values->second_button_url }}"  class="btn btn-outline--base">
                            {{ __(@$banner->data_values->second_button_name) }}
                        </a>
                    </div>
                </div>
            </div>
                <div
                  id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c3a-03271c3a"
                  class="paidhome-header_wrapper"
                >
                  <div
                    id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c3b-03271c3a"
                    class="paidhome-header_marquee1"
                  >
                    <div
                      id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c3c-03271c3a"
                      class="paidhome-header_list"
                    >
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394693_CREATOR%20HIGHLIGHT-5.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bb_CREATOR%20HIGHLIGHT-2.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394690_CREATOR%20HIGHLIGHT-8.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a1_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946be_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      />
                    </div>
                    <div class="paidhome-header_list">
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394693_CREATOR%20HIGHLIGHT-5.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bb_CREATOR%20HIGHLIGHT-2.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394690_CREATOR%20HIGHLIGHT-8.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a1_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946be_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      />
                    </div>
                  </div>
                  <div
                    id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c48-03271c3a"
                    class="paidhome-header_marquee2"
                  >
                    <div
                      id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c49-03271c3a"
                      class="paidhome-header_list"
                    >
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bd_CREATOR%20HIGHLIGHT-1.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a5_CREATOR%20HIGHLIGHT-14.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468c_CREATOR%20HIGHLIGHT-4.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468f_CREATOR%20HIGHLIGHT-6.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394694_CREATOR%20HIGHLIGHT-10.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      />
                    </div>
                    <div class="paidhome-header_list">
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bd_CREATOR%20HIGHLIGHT-1.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a5_CREATOR%20HIGHLIGHT-14.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468c_CREATOR%20HIGHLIGHT-4.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468f_CREATOR%20HIGHLIGHT-6.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394694_CREATOR%20HIGHLIGHT-10.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      />
                    </div>
                  </div>
                  <div
                    id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c55-03271c3a"
                    class="paidhome-header_marquee3"
                  >
                    <div
                      id="w-node-_5a70e332-aef2-77d3-b039-cf3b03271c56-03271c3a"
                      class="paidhome-header_list"
                    >
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394691_CREATOR%20HIGHLIGHT-3.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bc_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bf_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394692_CREATOR%20HIGHLIGHT-13.webp"
                        loading="lazy"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a3_CREATOR%20HIGHLIGHT-11.webp"
                        loading="lazy"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      />
                    </div>
                    <div class="paidhome-header_list">
                      <img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394691_CREATOR%20HIGHLIGHT-3.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bc_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bf_CREATOR%20HIGHLIGHT.webp"
                        loading="eager"
                        alt=""
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394692_CREATOR%20HIGHLIGHT-13.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      /><img
                        src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a3_CREATOR%20HIGHLIGHT-11.webp"
                        loading="eager"
                        alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                        class="paidhome-header_image"
                      />
                    </div>
                  </div>
                  <div
                    id="w-node-_70d7c688-6457-720f-eaf8-3dc4ba79ce4e-03271c3a"
                    class="paidhome-header_top-cover"
                  ></div>
                  <div
                    id="w-node-e58c1e7a-3c6f-54d9-320c-79ab72c73b0c-03271c3a"
                    class="paidhome-header_bottom-cover"
                  ></div>
                </div>
              </div>
            </div>
          </div>
          <div class="paidhome-header_hero-carousel">
            <div class="paidhome-header_marquee1">
              <div class="paidhome-header_list">
                <img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a5_CREATOR%20HIGHLIGHT-14.webp"
                  loading="eager"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bb_CREATOR%20HIGHLIGHT-2.webp"
                  loading="eager"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a3_CREATOR%20HIGHLIGHT-11.webp"
                  loading="eager"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bf_CREATOR%20HIGHLIGHT.webp"
                  loading="eager"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a1_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a0_CREATOR%20HIGHLIGHT-2.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bd_CREATOR%20HIGHLIGHT-1.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bc_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394694_CREATOR%20HIGHLIGHT-10.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394693_CREATOR%20HIGHLIGHT-5.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394692_CREATOR%20HIGHLIGHT-13.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394691_CREATOR%20HIGHLIGHT-3.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394690_CREATOR%20HIGHLIGHT-8.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946c2_CREATOR%20HIGHLIGHT%20(2).webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946be_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468d_CREATOR%20HIGHLIGHT-1.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468c_CREATOR%20HIGHLIGHT-4.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                />
              </div>
              <div class="paidhome-header_list">
                <img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a5_CREATOR%20HIGHLIGHT-14.webp"
                  loading="eager"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bb_CREATOR%20HIGHLIGHT-2.webp"
                  loading="eager"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a3_CREATOR%20HIGHLIGHT-11.webp"
                  loading="eager"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bf_CREATOR%20HIGHLIGHT.webp"
                  loading="eager"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a1_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946a0_CREATOR%20HIGHLIGHT-2.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bd_CREATOR%20HIGHLIGHT-1.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946bc_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394694_CREATOR%20HIGHLIGHT-10.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394693_CREATOR%20HIGHLIGHT-5.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394692_CREATOR%20HIGHLIGHT-13.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394691_CREATOR%20HIGHLIGHT-3.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce394690_CREATOR%20HIGHLIGHT-8.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946c2_CREATOR%20HIGHLIGHT%20(2).webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce3946be_CREATOR%20HIGHLIGHT.webp"
                  loading="lazy"
                  alt=""
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468d_CREATOR%20HIGHLIGHT-1.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                /><img
                  src="https://assets-global.website-files.com/66171462efa71abbce3940c6/66171462efa71abbce39468c_CREATOR%20HIGHLIGHT-4.webp"
                  loading="lazy"
                  alt="Diversify your revenue, build your brand, and turn your followers into customers with Kajabi."
                  class="paidhome-header_image"
                />
              </div>
            </div>
          </div>
        </header>
      </main>
    </div>
</section>

{{-- add this for pictures animation --}}
<script
   src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=66171462efa71abbce3940c6"
   type="text/javascript"
   integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
   crossorigin="anonymous"
></script>
<script
   src="https://assets-global.website-files.com/66171462efa71abbce3940c6/js/staging-kajabi-marketing.0af4f9907.js"
   type="text/javascript"
></script>