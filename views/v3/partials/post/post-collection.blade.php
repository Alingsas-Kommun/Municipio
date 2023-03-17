@if ($posts)
    @collection([
        'unbox' => true,
        'classList' => ['o-grid']
    ])
        @foreach ($posts as $post)
            @php
                echo '<pre>' . print_r($post, true) . '</pre>';
            @endphp
            @collection__item([
                'link' => $post->permalink,
                'classList' => [$gridColumnClass]
            ])
                @group(['direction' => 'horizontal', 'classList' => ['o-grid', 'u-padding--0']])
                @if ($displayFeaturedImage)
                    @image([
                        'src' => $post->thumbnail['src'],
                        'alt' => $post->thumbnail['alt'],
                        'placeholderIconSize' => 'sm',
                        'placeholderIcon' => 'image',
                        'placeholderText' => '',
                        'classList' => ['o-grid-4@sm', 'o-grid-12', 'u-height--100']
                    ])
                    @endimage
                    @group(['direction' => 'vertical', 'classList' => ['o-grid-8@sm', 'o-grid-12']])
                    @else
                        @group(['direction' => 'vertical', 'classList' => ['o-grid-12']])
                        @endif
                        @typography([
                            'element' => 'h3',
                            'classList' => ['c-collection__content__title']
                        ])
                            {{ $post->postTitle }}
                        @endtypography
                        @if ($post->termsUnlinked)
                            @typography([
                                'element' => 'p',
                                'variant' => 'meta',
                                'classList' => ['c-collection__content__terms']
                            ])
                                {{ $post->termsUnlinked }}
                            @endtypography
                        @endif
                        @if ($post->meta)
                            @typography([
                                'element' => 'p',
                                'variant' => 'meta',
                                'classList' => ['c-collection__content__meta']
                            ])
                                {{ $post->meta }}
                            @endtypography
                        @endif
                        @if ($post->displayReadingTime)
                            @typography([
                                'element' => 'p',
                                'variant' => 'meta',
                                'classList' => ['c-collection__content__reading-time']
                            ])
                                {{ $post->readingTime }}
                            @endtypography
                        @endif
                        @typography([
                            'element' => 'p',
                            'classList' => ['c-collection__content__excerpt']
                        ])
                            {{ $post->excerptShort }}
                        @endtypography
                    @endgroup
                @endgroup
            @endcollection__item
        @endforeach
    @endcollection
@endif
